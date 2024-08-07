<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_code' => 'required|max:10|unique:products,product_code' . $this->route('id'),
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpg,jpeg,png,gif',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'numeric|min:0|lt:price',
            'short_description' => 'string|max:255',
            'quantity' => 'integer|min:0',
            'date_add' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ];
    }
    public function messages()
    {
        return [
            'product_code.required' => 'Mã sản phẩm bắt buộc điền',
            'product_code.max' => 'Mã sản phẩm không được dài quá 10 kí tự',
            'product_code.unique' => 'Mã sản phẩm đã tồn tại',
            'name.required' => 'Tên sản phẩm là bắt buộc',
            'name.max' => 'Tên sản phẩm không được quá 255 kí tự',
            'image.image' => 'Hình ảnh không hợp lệ',
            'image.mimes' => 'Hình ảnh không hợp lệ',
            'price.required' => 'Giá sản phẩm bắt buộc điền',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá sản phẩm không được để số âm',
            'sale_price.numeric' => 'Giá khuyến mãi phải là số',
            'sale_price.min' => 'Giá khuyến mãi không được là số âm',
            'sale_price.lt' => 'Giá khuyễn mãi phải nhỏ hơn giá sản phẩm',
            'short_description.max' => 'Mô tả ngắn không được dài hơn 255 ',
            'quantity.integer' => 'Số lượng phải là số',
            'quantity.min' => 'Số lượng phải là số dương',
            'date_add.required' => 'Ngày nhập bắt buộc điền',
            'date_add.date' => 'Ngày nhập sai định dạng',
            'category_id.required' => 'Danh mục là bắt buộc',
            'category_id.exists' => 'Danh mục không hợp lệ',
        ];
    }
}
