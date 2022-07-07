<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FirstDecimalRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$value < 0) {
            return false;
        }

        if (!(preg_match('/((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)/', $value))) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // TODO:Langファサードを利用する
        return ('入力できる値は, 0〜999の小数点第1位までです。');
    }
}
