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
        $e_students = Student::select('id', 'family_name', 'first_name', 'family_name_kana', 'first_name_kana', 'grade')->get();

        return view('owner.students.index', compact('e_students'));
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
    public function store(Request $request)
    {
        $request->validate([
            'grade' => ['required', 'integer', 'digits_between:1,7'],
            'family_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'family_name_kana' => ['required', 'string', 'max:255'],
            'first_name_kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = Student::create([
            'grade' => $request->grade,
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
        //
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

        $student->family_name = $request->family_name;
        $student->first_name = $request->first_name;
        $student->family_name_kana = $request->family_name_kana;
        $student->first_name_kana = $request->first_name_kana;
        // TODO:パスワードを変更できないようにする
        $student->password = Hash::make($request->password);
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
}
