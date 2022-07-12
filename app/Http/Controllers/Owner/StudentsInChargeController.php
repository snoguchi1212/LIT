<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class StudentsInChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    function index($id)
    {

        $teacher = Teacher::findOrFail($id);
        $students = $teacher->students();

        return view('owner.teachers.in-charge.index',
        compact('teacher'));
    }
}
