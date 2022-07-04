<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Score;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'title',
    ];

    public function score(){
        return $this->hasMany(Score::class, 'test_id');
    }
}
