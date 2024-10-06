<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class StoreDanhMucRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'ten_danh_muc' => [
                'required',
                'string',
                'max:255',
                'unique:danh_mucs,ten_danh_muc',
                'regex:/^[^\d]*$/'
            ],
            'hinh_anh' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],
        ];
    }

    public function messages()
    {
        return [
            'ten_danh_muc.required' => 'Vui lòng không bỏ trống !',
            'ten_danh_muc.max' => 'Tên danh mục quá dài !',
            'ten_danh_muc.unique' => 'Danh mục đã tồn tại !',
            'ten_danh_muc.regex' => 'Danh mục không được để ký tự chữ số !',
            'hinh_anh.required' => 'Vui lòng không bỏ trống hình ảnh!',
            'hinh_anh.image' => 'Hình ảnh phải là một tệp ảnh!',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc webp!',
            'hinh_anh.max' => 'Hình ảnh không được lớn hơn 2MB!',
        ];
    }
}
