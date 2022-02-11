<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class RegistrationRequest extends FormRequest
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
            'fullname'  => 'required|string|max:32',
            'email'     => 'required|string|email|max:100|unique:auth.users',
            'username'  => 'required|string|max:12|unique:account.users',
            'password'  => 'required|string|confirmed|min:6',
            'gender'    => 'required',
            'dob'       => 'required|date',
            'introduction'      => 'required',
            'self_description'  => 'required',
            'id_city'   => 'required|integer'
        ];
    }
}
