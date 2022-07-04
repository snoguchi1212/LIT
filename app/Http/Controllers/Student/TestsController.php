<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:students');

        $this->middleware(function($request, $next) {
            $id = $request->route()->parameter('test');
            if(!is_null($id)) {
                $testsStudentId = Test::findOrFail($id)->student->id;
                $studentId = (int)$testsStudentId;
                $testId = Auth::id();
                if($studentId !== $testId){
                    abort(404);
                }
            }
            return $next($request);
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentId = Auth::id();
        $tests = Test::where('student_id', $studentId)->get();

        $studentTests = [];
        foreach ($tests as $test) {
            $scores = Score::where('test_id', $test->id)->get();
            $studentTest = [
                'test' => $test,
                'scores' => $scores,
            ];
            array_push($studentTests, $studentTest);
        }

        return view('student.tests.index',
        compact('studentTests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('student.tests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
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
        $tests = Test::where('id', $id)->get();
        $scores = Test::find($id)->scores;

        return view('student.tests.create',
        compact('scores'));

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
