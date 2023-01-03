<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'homeroom_teacher' => 'required',
            'grade_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên lớp.',
            'homeroom_teacher' => 'Vui lòng nhập giáo viên chủ nhiệm lớp đó.',
            'grade_id' => 'Vui lòng nhập khối lớp.'
        ];
    }
}
