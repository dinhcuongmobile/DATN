<?php

namespace App\Http\Requests\LienHe;

use Illuminate\Foundation\Http\FormRequest;

class StoreLienHeRequest extends FormRequest
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
            'ho_va_ten' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'so_dien_thoai' => 'required|numeric|regex:/^0[1-9][0-9]{8}$/',
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'ho_va_ten.required' => 'Họ và tên không được bỏ trống!',
            'ho_va_ten.max' => 'Họ và tên quá dài!',


            'email.required' => 'Email không được bỏ trống!',
            'email.email' => 'Email không hợp lệ!',
            'email.max' => 'Email không quá 255 ký tự!',

            'so_dien_thoai.required' => 'Số điện thoại không được trống!',
            'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ!',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số!',

            'tieu_de.required' => 'Tiêu đề không được bỏ trống!',
            'tieu_de.max' => 'Tiêu đề quá dài!',

            'noi_dung.required' => 'Nội dung không được trống!',
        ];
    }
}
