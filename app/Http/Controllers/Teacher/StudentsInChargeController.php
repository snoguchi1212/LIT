<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;
use App\Services\StudentService;
use Illuminate\Support\Facades\Auth;
use App\Services\TestService;


class StudentsInChargeController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:teachers');


        $this->middleware(function($request, $next) {
            $studentId = $request->route()->parameter('student');
            if(!is_null($studentId)) {
                // 担当している生徒だったら

                if(!Teacher::findOrFail(Auth::id())->students()->where('student_id', $studentId)->exists()) {
                    abort(404);
                }
            };
            return $next($request);
        });
    }

    function index()
    {
        $teacher = Teacher::findOrFail(Auth::id());
        $students = $teacher->students()->get();

        $subjects =  Subject::select('id', 'name')->get();

        return view('teacher.in-charge.index',
        compact('teacher', 'subjects'));
    }

    function show($studentId)
    {

        $student = Student::findOrFail($studentId);
        $tests = TestService::groupedByTest($studentId);

        return view('teacher.in-charge.show',
            compact('student', 'tests'));
    }

    function showOrderBySubject($studentId)
    {

        $student = Student::findOrFail($studentId);

        $subjects = TestService::groupedBySubject($studentId);

        return view('teacher.in-charge.show-order-by-subject',
            compact('student', 'subjects'));
    }

}
