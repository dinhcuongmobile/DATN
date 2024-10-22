<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThongTinTaiKhoanRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'ho_va_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|numeric|regex:/^0[1-9][0-9]{8}$/',
            'tinh_thanh_pho' => 'required',
            'quan_huyen' => 'required_with:tinh_thanh_pho',
            'phuong_xa'     => 'required_with:quan_huyen',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'ho_va_ten.required' => 'Vui lòng không bỏ trống Họ và Tên!',
            'ho_va_ten.max' => 'Họ và tên quá dài!',
            'so_dien_thoai.required' => 'Vui lòng không bỏ trống Số điện thoại!',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số!',
            'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ!',
            'tinh_thanh_pho.required' => 'Vui lòng chọn Tỉnh/Thành Phố!',
            'quan_huyen.required_with' => 'Vui lòng chọn Quận Huyện!',
            'phuong_xa.required_with' => 'Vui lòng chọn Phường Xã!',
        ];
    }
}
