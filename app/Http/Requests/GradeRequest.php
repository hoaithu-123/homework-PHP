<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
            'name_grade' => 'required|string|max:255',
            'note_grade' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name_grade.required' => 'Vui lòng nhập tên khối',
            'note_grade.required' => 'Vui lòng nhập ghi chú khối',
        ];
    }
}
