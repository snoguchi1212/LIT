<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Services\StudentService;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    public function index(Request $request)
    {

        $students = StudentService::getGradeStudents(null);

        $count = 15; // 一ページに表示されるデータの最大数

        $studentsPaginate = new LengthAwarePaginator(
            $students->forPage($request->page ?? 1, $count),
            $students->count(),
            $count,
            $request->page ?? 1,
        );

        $studentsPaginate->withPath('/owner/students');

        return view('owner.students.index', ['students' => $studentsPaginate]);
    }

    public function create()
    {
        return view('owner.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        Student::create([
            'grade' => $request->grade,
            'sex' => $request->sex,
            'ls_choice' => $request->ls_choice,
            'family_name' => $request->family_name,
            'first_name' => $request->first_name,
            'family_name_kana' => $request->family_name_kana,
            'first_name_kana' => $request->first_name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
        ->route('owner.students.index')
        ->with(['message', '新規生徒を登録しました。',
            'status' => 'info',
        ]);
    }

    public function createFromCSV()
    {
        return view('owner.students.create-from-csv');
    }

    public function storeFromCSV(Request $request)
    {
        $row = array([

        ]);

        //失敗時のエラー
        if(!$request->hasFile('csv') || !$request->file('csv')->isValid())
        {
            return redirect()
            ->route('owner.students.createFromCSV')
            ->with([
                    'message', '正しいファイルを選択してください',
                    'status' => 'alert',
                ]);
        }

        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
        $request->file('csv')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;

        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $interpreter->unstrict();

        // XXX:WINDOWSだとこれで動かないかのような記述があった
        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        $config->setFromCharset(NULL)
            ->setToCharset("UTF-8")
            ->setIgnoreHeaderLine(true);

        $lexer = new Lexer($config);
        $dataList = [];

        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            $dataList[] = $row;
        });

        try {
            $lexer->parse($tmpPath, $interpreter);
        } catch (StrictViolationException $e) {
            return redirect()
            ->route('owner.students.createFromCSV')
            ->with([
                    'message', 'csvファイルの形式が正しくありません',
                    'status' => 'alert',
                ]);
        }

        // TMPファイル削除
        unlink($tmpPath);

        // 登録処理
        $count = 0;
        foreach($dataList as $row){
            Student::insert([
                'family_name' => $row[0],
                'first_name' => $row[1],
                'family_name_kana' => $row[2],
                'first_name_kana' => $row[3],
                'sex' => $row[4],
                'email' => $row[5],
                'password' => $row[6],
                'grade' => $row[7],
                'ls_choice' => $row[8],
                'school_code' => $row[9],
            ]);
            $count++;
        }

        return redirect()
        ->route('owner.students.index')
        ->with([
                'message', $count.'件の新規生徒を登録しました。',
                'status' => 'info',
            ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('owner.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student = Student::findOrFail($id);

        return view('owner.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $student = Student::findOrFail($id);

        $student->grade = $request->grade;
        $student->sex = $request->sex;
        $student->ls_choice = $request->ls_choice;
        $student->family_name = $request->family_name;
        $student->first_name = $request->first_name;
        $student->family_name_kana = $request->family_name_kana;
        $student->first_name_kana = $request->first_name_kana;
        // TODO:パスワードを変更できないようにする
        // $student->password = Hash::make($request->password);
        $student->save();

        return redirect()
        ->route('owner.students.index')
        ->with([
            'message' => '生徒情報を更新しました。',
            'status' => 'info',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return redirect()
        ->route('owner.students.index')
        ->with([
            'message' => '生徒情報を削除しました。',
            'status' => 'alert',
        ]);
    }

    public function leavedStudentsIndex()
    {
        $leavedStudents = Student::onlyTrashed()->select('id', 'family_name', 'first_name', 'family_name_kana', 'first_name_kana', 'grade', 'deleted_at')->get();

        return view('owner.leaved-students', compact('leavedStudents'));
    }

    public function leavedStudentsDestroy($id)
    {
        Student::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()
        ->route('owner.leaved-students.index');

    }

    // コントローラーの1メソッドとして実装
    public function postCSV()
    {
        // コールバック関数に１行ずつ書き込んでいく処理を記述
        $callback = function () {
            // 出力バッファをopen
            $stream = fopen('php://output', 'w');
            // 文字コードをShift-JISに変換
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
            // ヘッダー行
            fputcsv($stream, [
                'ID',
                '姓',
                '名',
                'セイ',
                'メイ',
                'テスト名',
                '教科名',
                '教科',
                '点数',
                '平均点',
                '校内順位',
                '校内人数',
            ]);
            // データ
            // $students = Student::orderByRaw('grade asc', 'family_name_kana asc', 'first_name_kana asc');
            $students = Student::orderBy('grade', 'asc')
                ->orderBy('family_name_kana', 'asc')
                ->orderBy('first_name_kana', 'asc');
            // ２行目以降の出力
            // cursor()メソッドで１レコードずつストリームに流す処理を実現できる。
            foreach ($students->cursor() as $student) {
                $tests = $student->tests();
                foreach($tests->cursor() as $test) {
                    $scores = $test->scores();
                    foreach($scores->cursor() as $score) {
                        fputcsv($stream, [
                            $student->id,
                            $student->family_name,
                            $student->first_name,
                            $student->family_name_kana,
                            $student->first_name_kana,
                            $test->title,
                            $score->name,
                            $score->subject()->first()->name,
                            $score->score,
                            $score->average_score,
                            $score->school_ranking,
                            $score->school_people,
                        ]);
                    }
                }
            }

        fclose($stream);
        };

        // 保存するファイル名
        $filename = sprintf('scores-%s.csv', date('Ymd'));

        // ファイルダウンロードさせるために、ヘッダー出力を調整
        $header = [
            'Content-Type' => 'application/octet-stream',
        ];

        return response()->streamDownload($callback, $filename, $header);
        // ->redirect()
        // ->route('owner.leaved-students.index');
    }
}
