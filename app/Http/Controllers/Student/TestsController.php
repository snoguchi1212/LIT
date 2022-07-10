<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;
use App\Models\Test;
use App\Models\Score;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Template\Template;
use App\Services\TestService;

use function Psy\debug;

class TestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:students');

        $this->middleware(function($request, $next) {
            $id = $request->route()->parameter('test');
            if(!is_null($id)) {
                $testsStudentId = Test::findOrFail($id)->student_id;
                $testId = (int)$testsStudentId;
                $studentId = Auth::id();

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
        $tests = TestService::groupedByTest($studentId);


        return view('student.tests.index',
        compact('tests'));

    }

    public function indexOrderedBySubject()
    {

        $studentId = Auth::id();
        $subjects = TestService::groupedBySubject($studentId);

        return view('student.tests.index-ordered-by-subject',
        compact('subjects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects =  Subject::select('id', 'name')->get();

        return view('student.tests.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {

        // #TODO:validationをかける https://zenn.dev/kiwatchi1991/articles/6046224a23c3eee0fbeb

        // #HACK:もう少し綺麗に書けそう
        try{
            DB::transaction(function () use($request){

                $test = Test::create([
                    'student_id' => Auth::id(),
                    'title' => $request->title[0],
                ]);

                $i = 0;
                $tempRequest = [];

                foreach ($request->all() as $val) {

                    $tempRequest['test_id'] = $test->id;

                    if (!(isset($request->name[$i]))) {
                        $i++;
                        continue;
                    }
                    $tempRequest['name'] = $request->name[$i];

                    if (!(isset($request->score[$i]))) {
                        $i++;
                        continue;
                    }
                    $tempRequest['score'] = $request->score[$i];

                    if (!(isset($request->subject_id[$i]))) {
                        $i++;
                        continue;
                    }
                    $tempRequest['subject_id'] = $request->subject_id[$i];

                    if (isset($request->school_ranking[$i])) {
                        $tempRequest['school_ranking'] = $request->school_ranking[$i];
                    }
                    if (isset($request->school_people[$i])) {
                        $tempRequest['school_people'] = $request->school_people[$i];
                    }
                    if (isset($request->national_ranking[$i])) {
                        $tempRequest['national_ranking'] = $request->national_ranking[$i];
                    }
                    if (isset($request->national_people[$i])) {
                        $tempRequest['national_people'] = $request->national_people[$i];
                    }
                    if (isset($request->deviation_value[$i])) {
                        $tempRequest['deviation_value'] = $request->deviation_value[$i];
                    }
                    if (isset($request->average_score[$i])) {
                        $tempRequest['average_score'] = $request->average_score[$i];
                    }

                    if(isset($tempRequest)) {
                        DB::table('scores')->insert($tempRequest);
                        $tempRequest = [];
                    }
                    $i++;
                }

            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }


        return redirect()
        ->route('student.tests.index')
        ->with([
            'message' => '点数を登録しました。',
            'status' => 'info',
        ]);
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

        $subjects =  Subject::select('id', 'name')->get();

        $test = Test::find($id);
        $scores = Test::find($id)->scores;

        // dd($test, $scores);
        // データの取得ができた
        // #viewの編集
        return view('student.tests.edit',
        compact('subjects', 'test', 'scores'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
    {
        // テスト(tests)は更新
        // 点数(scores)は削除して追加

        //HACK:もう少し綺麗に書ける

        try{
            DB::transaction(function () use($request){

                $test = Test::where('id', $request->test);
                $test->update([
                    'title' => $request->title[0],
                ]);
                $test = Test::where('id', $request->test);

                // dd($test->first()->id);

                Score::where('test_id', $test->first()->id)->delete();

                $i = 0;
                $tempRequest = [];

                foreach ($request->all() as $val) {

                    $tempRequest['test_id'] = $test->first()->id;

                    if (!(isset($request->name[$i]))) {
                        $i++;
                        continue;
                    }
                    $tempRequest['name'] = $request->name[$i];

                    if (!(isset($request->score[$i]))) {
                        $i++;
                        continue;
                    }
                    $tempRequest['score'] = $request->score[$i];

                    if (!(isset($request->subject_id[$i]))) {
                        $i++;
                        continue;
                    }
                    $tempRequest['subject_id'] = $request->subject_id[$i];

                    if (isset($request->school_ranking[$i])) {
                        $tempRequest['school_ranking'] = $request->school_ranking[$i];
                    }
                    if (isset($request->school_people[$i])) {
                        $tempRequest['school_people'] = $request->school_people[$i];
                    }
                    if (isset($request->national_ranking[$i])) {
                        $tempRequest['national_ranking'] = $request->national_ranking[$i];
                    }
                    if (isset($request->national_people[$i])) {
                        $tempRequest['national_people'] = $request->national_people[$i];
                    }
                    if (isset($request->deviation_value[$i])) {
                        $tempRequest['deviation_value'] = $request->deviation_value[$i];
                    }
                    if (isset($request->average_score[$i])) {
                        $tempRequest['average_score'] = $request->average_score[$i];
                    }

                    if(isset($tempRequest)) {
                        DB::table('scores')->insert($tempRequest);
                        $tempRequest = [];
                    }
                    $i++;
                }

            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }


        return redirect()
        ->route('student.tests.index')
        ->with([
            'message' => '点数を編集しました。',
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
        //
    }
}
