<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrefectureCode extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'prefecture_code',
        'name',
    ];
}
