<?php

namespace EVOS\Http\Requests;

use EVOS\Http\Requests\Request;

class QuizRequest extends Request
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
            'title' => 'required|min:3',
            'category_id' => 'required|numeric'
        ];
    }
}
