<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Collection;

class StudentService
{
    /**
     *  学年idを入力して,　その学年の生徒を返す
     */
    public static function getGradeStudents(?int $gradeId): Collection
    {
        if(is_null($gradeId)){
            $students = Student::orderby('grade')->orderby('family_name')->orderby('first_name')->get();
        } else {
            $students =  Student::where('grade', $gradeId)->orderby('family_name')->orderby('first_name')->get();
        }
        return $students;
    }
}
