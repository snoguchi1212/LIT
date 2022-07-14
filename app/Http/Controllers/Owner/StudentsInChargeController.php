<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;
use App\Services\StudentService;

class StudentsInChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    function index($id)
    {
        // TODO:並び替え
        $teacher = Teacher::findOrFail($id);
        $students = $teacher->students();

        $subjects =  Subject::select('id', 'name')->get();

        return view('owner.teachers.in-charge.index',
        compact('teacher', 'subjects'));
    }

    function edit($teacher, $gradeId = null)
    {
        $teacher = Teacher::findOrFail($teacher);
        $students = StudentService::getGradeStudents($gradeId);

        // foreach($students as $student){
        //     dd($student->family_name);
        // }

        $subjects =  Subject::select('id', 'name')->get();

        return view('owner.teachers.in-charge.edit',
        compact('teacher', 'gradeId', 'students', 'subjects'));

    }

    function destory()
    {

    }

    function upsert(Request $request)
    {
        // これで登録することはできる→既存のデータは登録しないようにしたい
        // $teacher = Teacher::findOrFail($request->query('teacher'));
        // $teacher->students()->attach([$request->student => ['subject_id' => $request->subject]]);

        $teacher = Teacher::findOrFail($request->query('teacher'));

        // dd($request->query('teacher'), $request->student, $request->subject);

        $count = Teacher::whereHas('students', function ($q) use ($request) {
            $q->where('student_teacher.teacher_id', $request->query('teacher'))
                ->where('student_teacher.student_id', $request->student)
                ->where('student_teacher.subject_id', $request->subject);
        })->count();
        if($count < 1){
            $teacher->students()->attach([$request->student => ['subject_id' => $request->subject]]);
        }

        // TODO:withをつけるようにする
        return redirect()
        ->route('owner.teachers.studentsInCharge.index', compact('teacher'));
        // ->with(['message', '新規講師を登録しました。',
        //     'status' => 'info',
        // ]);
    }
}
