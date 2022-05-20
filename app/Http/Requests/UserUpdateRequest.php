<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'password' => 'bail|required|min:6',
            'email' => [
                'required',
                'email',
                ],
        ];
    }
    public function messages(): array
    {
        //format: 'field.rule' => 'message'
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.regex' => 'Sai định dạng email',
            'email.max' => 'Email không được quá 255 ký tự',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải dài hơn 6 ký tự',
        ];
    }
}
