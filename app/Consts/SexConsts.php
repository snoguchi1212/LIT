<?php

namespace App\Consts;

// usersで使う定数
class SexConsts
{
    public const NO_DATA = 0;
    public const MALE = 1;
    public const FEMALE = 2;

    public const SEX_LIST = [
        self::NO_DATA => '無回答',
        self::MALE => '男',
        self::FEMALE => '女',
    ];
};
