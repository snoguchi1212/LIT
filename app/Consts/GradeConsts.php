<?php

namespace App\Consts;

// usersで使う定数
class GradeConsts
{
    public const JH_1 = 1;
    public const JH_2 = 2;
    public const JH_3 = 3;
    public const H_1 = 4;
    public const H_2 = 5;
    public const H_3 = 6;
    public const H_4 = 7;

    public const GRADE_LIST = [
        self::JH_1 => '中1',
        self::JH_2 => '中2',
        self::JH_3 => '中3',
        self::H_1 => '高1',
        self::H_2 => '高2',
        self::H_3 => '高3',
        self::H_4 => '既卒',
    ];
}
