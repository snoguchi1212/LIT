<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
    public function store(Request $request)
    {
        $request->validate([
            'sex' => ['required', 'integer', 'digits_between:0,3'],
            'family_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'family_name_kana' => ['required', 'string', 'max:255'],
            'first_name_kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


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
        ->with(['message', '新規講師を登録しました。',
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
