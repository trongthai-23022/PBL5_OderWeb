<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAddRequest extends FormRequest
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
            'email' => ['required','email',Rule::unique('users')->withoutTrashed()],
            'password' => 'bail|required|min:6',
        ];
    }
    public function messages(): array
    {
        //format: 'field.rule' => 'message'
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Sai định dạng email',
            'email.max' => 'Email không được quá 255 ký tự',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải dài hơn 6 ký tự',
        ];
    }
}
