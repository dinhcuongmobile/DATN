<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaiKhoanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id=$this->route('id');
        return [
            'ho_va_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'nullable|numeric|regex:/^0[1-9][0-9]{8}$/',
            'dia_chi' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required' => 'Vui lòng không bỏ trống Họ và Tên!',
            'ho_va_ten.max' => 'Họ và tên quá dài!',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số!',
            'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ!',
            'dia_chi.max' => 'Địa chỉ quá dài!',
        ];
    }
}
