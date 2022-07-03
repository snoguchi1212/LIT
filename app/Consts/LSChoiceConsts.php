<?php

namespace App\Consts;

// usersで使う定数
class LSChoiceConsts
{
    public const NO_DATA = 0;
    public const Literature = 1;
    public const Science = 2;

    public const LS_CHOICE_LIST = [
        self::NO_DATA => '無回答',
        self::Literature => '理',
        self::Science => '文',
    ];
};
