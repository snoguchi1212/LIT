<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Score;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:students');


        $this->middleware(function($request, $next) {
            $id = $request->route()->parameter('test');
            // dd($id); これで, testのidはとれてる
            if(!is_null($id)) {
                $testsStudentId = Test::findOrFail($id)->student_id;
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
            $studentScores = [];
            foreach ($scores as $score) {
// HACK:モデル操作
// TODO:並び替えを行う
                $subject =  Subject::where('id', $score->subject_id)->select('name')->get();

                $tempScore = [
                    'name' => $score->name,
                    'subject' => $subject[0]->name,
                    'score' => $score->score,
                    'average_score' => $score->score,
                    'deviation_value' => $score->deviation_value,
                    'school_ranking' => $score->school_ranking,
                    'school_people' => $score->school_people,
                    'national_ranking' => $score->national_ranking,
                    'national_people' => $score->national_people,
                ];
                array_push($studentScores, $tempScore);
            };
            $studentScores = [
                'test' => $test,
                'scores' => $studentScores,
            ];

            array_push($studentTests, $studentScores);
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

        $test = Test::find($id);
        $scores = Test::find($id)->scores;

        // dd($test, $scores);
        // データの取得ができた
        // #viewの編集
        return view('student.tests.edit',
        compact('test', 'scores'));

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
