<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',

        ];
    }
    public function messages()
    {
        //format: 'field.rule' => 'message'
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 255 ký tự',
            'price.required' => 'Giá tiền không được để trống',
            'price.numeric' => 'Giá tiền phải là chữ số',
            'category_id.required' => 'Danh mục không được để trống',
            'description.required' => 'Thông tin chi tiết không được để trống',
        ];
    }
}
