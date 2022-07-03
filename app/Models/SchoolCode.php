<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCode extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'school_code',
        'name',
        'prefecture_code',
        'kind_of_school',
    ];


}
