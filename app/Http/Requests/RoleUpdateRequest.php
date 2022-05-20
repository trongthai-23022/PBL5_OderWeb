<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'description' => 'required|max:255',
        ];
    }
    public function messages(): array
    {
        //format: 'field.rule' => 'message'
        return [
            'name.required' => 'Tên role không được để trống',
            'name.max' => 'Tên role không được quá 255 ký tự',
            'description.required' => 'Role mô tả không được để trống',
            'description.max:255' => 'Role mô tả không được quá 255 ký tự',
        ];
    }
}
