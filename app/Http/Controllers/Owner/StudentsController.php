<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    public function index()
    {
        $students = Student::select('id', 'family_name', 'first_name', 'family_name_kana', 'first_name_kana', 'grade')->get();

        return view('owner.students.index', compact('students'));
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
        // $students = Student::orderBy('id', 'desc');

        // foreach($students->cursor() as $student){
        //     $tests = $student->tests()->first();
        //     foreach($tests->cursor() as $test){
        //         $scores = $test->scores();
        //         foreach($scores->cursor() as $score){
        //             dd();
        //         }
        //     }
        // }


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
        $filename = sprintf('scores-%s.txt', date('Ymd'));

        // ファイルダウンロードさせるために、ヘッダー出力を調整
        $header = [
            'Content-Type' => 'application/octet-stream',
        ];

        return response()->streamDownload($callback, $filename, $header);
        // ->redirect()
        // ->route('owner.leaved-students.index');
    }
}
