<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'class_id' => 'required|numeric',
            'gender' => 'required|string',
            'phone' => 'required|string|max:255',
            'dateofbirth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'profile_picture' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên học viên',
            'email.unique' => 'Email này đã được đăng kí. Vui lòng nhập email khác',
            'email.required' => 'Vui lòng nhập Email học viên',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'class_id.required' => 'Vui lòng nhập lớp học mà học viên đó thuộc về',
            'gender.required' => 'Vui lòng nhập giới tính',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'dateofbirth.required' => 'Vui lòng nhập ngày tháng năm sinh',
            'current_address.required' => 'Vui lòng nhập địa chỉ hiện tại',
            'permanent_address.required' => 'Vui lòng nhập địa chỉ thường trú',
        ];

    }
}
