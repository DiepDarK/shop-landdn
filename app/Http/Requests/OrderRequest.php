<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name_P' => 'required|string|max:255',
            'email_P' => 'required|string|email|max:255',
            'phone_P' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address_P' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name_P.required' => 'Tên là bắt buộc.',
            'name_P.string' => 'Tên phải là chuỗi ký tự.',
            'name_P.max' => 'Tên không được vượt quá 255 ký tự.',
            'phone_P.required' => 'Số điện thoại là bắt buộc.',
            'phone_P.string' => 'Số điện thoại phải là chuỗi ký tự.',
            'phone_P.regex' => 'Định dạng số điện thoại không hợp lệ.',
            'phone_P.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',
            'email_P.required' => 'Email là bắt buộc.',
            'email_P.string' => 'Email phải là chuỗi ký tự.',
            'email_P.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'email_P.max' => 'Email không được vượt quá 255 ký tự.',
            'address_P.required' => 'Địa chỉ là bắt buộc.',
            'address_P.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address_P.max' => 'Địa chỉ không được vượt quá 255 ký tự.'
        ];
    }
}
