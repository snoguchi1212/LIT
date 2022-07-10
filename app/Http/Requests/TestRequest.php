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
            'score.*' => ['required', 'integer', 'nullable'],
            'school_ranking.*' => ['integer', 'nullable'],
            'school_people.*' => ['integer', 'nullable'],
            'national_ranking.*' => ['integer', 'nullable'],
            'deviation_value.*' => ['numeric', new FirstDecimalRule, 'nullable'],
            'average_score.*' => ['numeric', new FirstDecimalRule, 'nullable'],
        ];
    }
}
