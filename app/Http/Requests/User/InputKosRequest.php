<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class InputKosRequest extends FormRequest
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
            'name'  => 'required|string|max:100',
            'description'     => '',
            'price'  => 'required|numeric',
            'image'  => '',
            'user_id'    => '',
            'province_id'       => 'required|integer',
            'city_id'      => 'required|integer',
        ];
    }
}
