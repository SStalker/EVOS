<?php

namespace EVOS\Http\Requests;

use EVOS\Http\Requests\Request;

class QuestionRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required',
            'answerA' => 'required',
            'answerB' => 'required',
            'answerC' => '',
            'answerD' => '',
            'countdown' => 'integer|between:10,90'
        ];
    }
}
