<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;
use App\Models\Subject;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'test_id',
        'subject_id',
        'score',
        'school_ranking',
        'school_people',
        'national_ranking',
        'national_people',
        'deviation_value',
        'average_score',
    ];

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
