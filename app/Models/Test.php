<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Score;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'title',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'id');
    }

    public function scores(){
        return $this->hasMany(Score::class, 'test_id');
    }
}
