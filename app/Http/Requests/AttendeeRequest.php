<?php

namespace EVOS\Http\Requests;

use EVOS\Http\Requests\Request;

class AttendeeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'sesssion_token' => 'required',
            'quiz_id' => 'required'
        ];
    }
}
