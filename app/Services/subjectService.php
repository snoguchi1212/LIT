<?php

namespace App\Services;

class SubjectService
{
    public static function interruptID(int $subjectId): str
    {
        $subject =  Subject::where('id', $subjectId)->select('name')->get();

        return $subject;
    }
}
