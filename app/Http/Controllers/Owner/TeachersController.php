<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Illuminate\Pagination\LengthAwarePaginator;

class TeachersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    public function index()
    {
        $teachers = Teacher::select('id', 'family_name', 'first_name', 'family_name_kana', 'first_name_kana')->get();

        return view('owner.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('owner.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        // TODO:requestへの切り出し

        Teacher::create([
            'sex' => $request->sex,
            'family_name' => $request->family_name,
            'first_name' => $request->first_name,
            'family_name_kana' => $request->family_name_kana,
            'first_name_kana' => $request->first_name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
        ->route('owner.teachers.index')
        ->with(['message' => '新規講師を登録しました。',
            'status' => 'info',
        ]);
    }

    public function createFromCSV()
    {
        return view('owner.teachers.create-from-csv');
    }

    public function storeFromCSV(Request $request)
    {
        $row = array([

        ]);

        //失敗時のエラー
        if(!$request->hasFile('csv') || !$request->file('csv')->isValid())
        {
            return redirect()
            ->route('owner.teachers.createFromCSV')
            ->with([
                    'message' => '正しいファイルを選択してください',
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
            ->route('owner.teachers.createFromCSV')
            ->with([
                    'message' => 'csvファイルの形式が正しくありません',
                    'status' => 'alert',
                ]);
        }

        // TMPファイル削除
        unlink($tmpPath);

        // 登録処理
        $count = 0;
        foreach($dataList as $row){
            Teacher::insert([
                'family_name' => $row[0],
                'first_name' => $row[1],
                'family_name_kana' => $row[2],
                'first_name_kana' => $row[3],
                'sex' => $row[4],
                'email' => $row[5],
                'password' => $row[6],
            ]);
            $count++;
        }

        return redirect()
        ->route('owner.teachers.index')
        ->with([
                'message' => $count.'件の新規講師を登録しました。',
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
        $teacher = Teacher::findOrFail($id);

        return view('owner.teachers.show', compact('teacher'));
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
        $teacher = Teacher::findOrFail($id);

        return view('owner.teachers.edit', compact('teacher'));
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
        $teacher = Teacher::findOrFail($id);

        $teacher->sex = $request->sex;
        $teacher->family_name = $request->family_name;
        $teacher->first_name = $request->first_name;
        $teacher->family_name_kana = $request->family_name_kana;
        $teacher->first_name_kana = $request->first_name_kana;
        // TODO:パスワードを変更できないようにする
        // $teacher->password = Hash::make($request->password);
        $teacher->save();

        return redirect()
        ->route('owner.teachers.index')
        ->with([
            'message' => '講師情報を更新しました。',
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
        Teacher::findOrFail($id)->delete();

        return redirect()
        ->route('owner.teachers.index')
        ->with([
            'message' => '講師情報を削除しました。',
            'status' => 'alert',
        ]);
    }

    public function restore($id)
    {
        Teacher::onlyTrashed()->where('id', $id)->restore();

        return redirect()
        ->route('owner.teachers.index')
        ->with([
            'message' => '講師情報を復元しました。',
            'status' => 'info',
        ]);
    }

    public function leavedTeachersIndex()
    {
        $leavedTeachers = Teacher::onlyTrashed()->select('id', 'family_name', 'first_name', 'family_name_kana', 'first_name_kana', 'deleted_at')->get();

        return view('owner.leaved-teachers', compact('leavedTeachers'));
    }

    public function leavedTeachersDestroy($id)
    {
        Teacher::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()
        ->route('owner.leaved-teachers.index');

    }
}
