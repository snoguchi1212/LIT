<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

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
        'deviation_value',
        'average_score',
    ];

    public function test(){
        return $this->belongsTo(Test::class);
    }

}
