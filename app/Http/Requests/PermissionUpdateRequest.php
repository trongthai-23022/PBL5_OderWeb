<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['bail','required','max:255'],
            'parent_id' => 'required',
            'description' => 'required|max:255',
            'key_code' => 'required|max:255',
        ];
    }
    public function messages(): array
    {
        //format: 'field.rule' => 'message'
        return [
            'name.required' => 'Tên permission không được để trống',
            'name.max' => 'Tên permission không được quá 255 ký tự',
            'parent_id.required' => 'Parent id không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'key_code.required' => 'Key_code không được để trống',
        ];
    }
}
