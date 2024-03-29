<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'dateofbirth' => 'required|date',
            'phone' => 'required|regex:/(01)[0-9]{9}',
            'gender' => 'required|in:male, female, other',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'role' => 'required'
        ];
    }


}
