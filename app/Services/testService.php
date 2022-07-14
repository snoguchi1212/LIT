<?php

namespace App\Services;

use App\Models\Test;
use App\Models\Score;
use App\Models\Subject;
use App\Services\SubjectService;

/**
 *
 */
class TestService
{
    /**
    * tests->scores->subject
    */
    public static function groupedByTest(int $studentId): object
    {

        $query = Test::with(['scores' => function($q){
            $q->orderBy('subject_id');
        }, 'scores.subject:id,name'])
        ->where('student_id', $studentId)
        ->orderBy('start_date', 'desc');

        $tests = $query->get();

        return $tests;
    }

    /**
    * subject->scores->test
    */
    public static function groupedBySubject(int $studentId) : object
    {

        $query = Subject::with(['scores' => function($q)use($studentId){
            $q->leftJoin('tests', 'scores.test_id', '=', 'tests.id')
                ->where('student_id', '=', $studentId)
                ->orderBy('start_date', 'desc');
        },'scores.test:id,title']);

        $subjects=$query->get();

        return $subjects;

    }

}
