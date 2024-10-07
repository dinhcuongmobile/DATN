<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaiKhoanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'confirm_password' => 'same:password',
            'email' => 'required|email|unique:users,email',
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
            'password.required' => 'Vui lòng không bỏ trống mật khẩu!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp !',
            'email.required' => 'Vui lòng không bỏ trống email!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại!',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số!',
            'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ!',
            'quan_huyen.required_with' => 'Vui lòng chọn Quận Huyện nếu như bạn đã chọn Tỉnh/Thành phố!',
            'phuong_xa.required_with' => 'Vui lòng chọn Phường Xã nếu như bạn đã chọn Tỉnh/Thành phố và Quận Huyện!',
        ];
    }
}
