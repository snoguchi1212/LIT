<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Score;
use App\Models\StudentTeacher;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort_order',
    ];

    public function scores(){
        return $this->hasMany(Score::class);
    }

    public function studentTeacher(){
        return $this->hasMany(StudentTeacher::class);
    }

}
