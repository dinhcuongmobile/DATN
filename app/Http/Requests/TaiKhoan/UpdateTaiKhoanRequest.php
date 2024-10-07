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
            'tinh_thanh_pho' => 'nullable',
            'quan_huyen' => 'required_with:tinh_thanh_pho',
            'phuong_xa'     => 'required_with:quan_huyen',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required' => 'Vui lòng không bỏ trống Họ và Tên!',
            'ho_va_ten.max' => 'Họ và tên quá dài!',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số!',
            'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ!',
            'quan_huyen.required_with' => 'Vui lòng chọn Quận Huyện nếu như bạn đã chọn Tỉnh/Thành phố!',
            'phuong_xa.required_with' => 'Vui lòng chọn Phường Xã nếu như bạn đã chọn Tỉnh/Thành phố và Quận Huyện!',
        ];
    }
}
