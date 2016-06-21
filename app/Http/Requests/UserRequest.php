<?php

namespace EVOS\Http\Requests;

use Auth;
use EVOS\Http\Requests\Request;

class UserRequest extends Request
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
        $uniqueRule = $this->route()->users != null ? $this->route()->users->id . ',id' : '';
        return [
            // copied from AuthController
            'name' => 'required|max:255|unique:users,name,' . $uniqueRule,
            'email' => 'required|email|max:255|unique:users,email,' . $uniqueRule
        ];
    }
}
