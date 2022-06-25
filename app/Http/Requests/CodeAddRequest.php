<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeAddRequest extends FormRequest
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
            'code' => 'bail|required|max:10',
            'discount' => 'required|numeric|between:1,100',
            'is_enable' => 'required',
        ];
    }
    public function messages()
    {
        //format: 'field.rule' => 'message'
        return [
            'code.required' => 'Mã không được để trống',
            'code.max' => 'Mã không được quá 10 ký tự',
            'discount.required' => 'Phần trăm giảm giá không được để trống',
            'discount.numeric' => 'Phần trăm giảm giá phải là chữ số',
            'discount.between' => 'Phần trăm giảm giá <= 100',
            'is_enable.required' => 'Trạng thái không được để trống',
        ];
    }
}
