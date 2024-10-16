<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSanPhamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_san_pham' => [
                'required',
                'max:255',
            ],
            'gia_san_pham' => [
                'required',
                'regex:/^\d{1,10}(\.\d{1,2})?$/',
                'min:0',
                'max:1000000000'
            ],
            'hinh_anh' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],
            'khuyen_mai' => [
                'required',
                'integer',
                'min:0',
                'max:100'
            ],
            'mo_ta' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
            'ten_san_pham.required' => 'Vui lòng không bỏ trống tên sản phẩm!',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 255 ký tự!',
            'gia_san_pham.required' => 'Vui lòng không bỏ trống giá sản phẩm!',
            'gia_san_pham.regex' => 'Giá sản phẩm phải là số và có tối đa hai chữ số sau dấu thập phân ( . )!',
            'gia_san_pham.min' => 'Giá sản phẩm không được nhỏ hơn 0!',
            'gia_san_pham.max' => 'Giá sản phẩm không hợp lệ!',
            'hinh_anh.required' => 'Vui lòng không bỏ trống hình ảnh!',
            'hinh_anh.image' => 'Hình ảnh phải là một tệp ảnh!',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc webp!',
            'hinh_anh.max' => 'Hình ảnh không được lớn hơn 2MB!',
            'khuyen_mai.required' => 'Vui lòng không bỏ trống khuyến mại!',
            'khuyen_mai.integer' => 'Vui lòng nhập 1 số nguyên!',
            'khuyen_mai.min' => 'Khuyến mại phải lớn hơn hoặc bằng 0!',
            'khuyen_mai.max' => 'Khuyến mại không được phép lớn hơn 100!',
            'mo_ta.required' => 'Vui lòng không bỏ trống mô tả sản phẩm!',
        ];
    }
}
