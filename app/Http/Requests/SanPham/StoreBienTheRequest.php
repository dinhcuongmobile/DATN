<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;

class StoreBienTheRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'kich_co' => [
                'required',
            ],
            'ten_mau' => [
                'required',
            ],
            'hinh_anh' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],
            'so_luong' => [
                'required',
                'integer',
                'min:1'
            ],
        ];
    }

    public function messages()
    {
        return [
            'kich_co.required' => 'Vui lòng chọn kích cỡ cho sản phẩm !',
            'ten_mau.required' => 'Vui lòng chọn màu sắc cho sản phẩm!',
            'hinh_anh.required' => 'Vui lòng không bỏ trống hình ảnh!',
            'hinh_anh.image' => 'Hình ảnh phải là một tệp ảnh!',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc webp!',
            'hinh_anh.max' => 'Hình ảnh không được lớn hơn 2MB!',
            'so_luong.required' => 'Vui lòng không bỏ trống số lượng sản phẩm !',
            'so_luong.integer' => 'Số lượng phải là 1 số nguyên !',
            'so_luong.min' => 'Số lượng phải lớn hơn 0 !',
        ];
    }
}
