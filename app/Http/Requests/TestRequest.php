<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FirstDecimalRule;

class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name.*' => ['required', 'string', 'max:16'],
            'test_id.*' => ['required', 'integer'],
            'subject_id.*' => ['required', 'integer'],
            'score.*' => ['required', 'integer'],
            'school_ranking.*' => ['integer'],
            'school_people.*' => ['integer'],
            'national_ranking.*' => ['integer'],
            'deviation_value.*' => ['numeric', new FirstDecimalRule],
            'average_score.*' => ['numeric', new FirstDecimalRule],
        ];
    }
}
