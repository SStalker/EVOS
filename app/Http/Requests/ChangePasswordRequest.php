<?php

namespace EVOS\Http\Requests;

use EVOS\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
            'current_password' => 'required|min:4',
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required|min:4'
        ];
    }
}
