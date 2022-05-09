<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => ['required', 'max:255', 'email', 'regex:/(.*)@(gmail|outlook)\.com/i', 'unique:users'],
            'password' => 'required|min:6',
            'password_confirmation' => 'required| min:6'
        ];
    }
    public function messages()
    {
        //format: 'field.rule' => 'message'
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.regex' => 'Sai định dạng email',
            'email.max' => 'Email không được quá 255 ký tự',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải dài hơn 6 ký tự',
            'password_confirmation.min' => 'Password phải dài hơn 6 ký tự',

        ];
    }
}
