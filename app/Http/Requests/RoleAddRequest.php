<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleAddRequest extends FormRequest
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
            'name' => ['bail','required','max:255',Rule::unique('roles')->withoutTrashed()],
            'description' => ['required']
        ];
    }
    public function messages(): array
    {
        //format: 'field.rule' => 'message'
        return [
            'name.required' => 'Tên role không được để trống',
            'name.max' => 'Tên role không được quá 255 ký tự',
            'name.unique' => 'Tên role đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
        ];
    }
}
