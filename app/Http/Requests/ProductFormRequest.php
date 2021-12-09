<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'avatar' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên sản phẩm!!!',
            'description.required' => 'Vui lòng điền mô tả sản phẩm!!!',
            'category_id.required' => 'Vui lòng chọn danh mục!!!',
            'price.required' => 'Vui lòng điền giá sản phẩm!!!',
            'price.required' => 'Ảnh đại diện sản phẩm không được để trống!!!'
        ];
    }
}
