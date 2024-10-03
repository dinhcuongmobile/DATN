<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTinTucRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id=$this->route('id');
        return [
            'tieu_de' => [
                'required',
                'string',
                'max:255',
                'unique:tin_tucs,tieu_de,'.$id
            ],
            'hinh_anh' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],
            'noi_dung' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'tieu_de.required' => 'Vui lòng không bỏ trống tiêu đề!',
            'tieu_de.max' => 'Tiêu đề dài hơn ký tự cho phép!',
            'tieu_de.unique' => 'Tiêu đề đã tồn tại!',
            'hinh_anh.required' => 'Vui lòng không bỏ trống hình ảnh!',
            'hinh_anh.image' => 'Hình ảnh phải là một tệp ảnh!',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc webp!',
            'hinh_anh.max' => 'Hình ảnh không được lớn hơn 2MB!',
            'noi_dung.required' => 'Vui lòng không bỏ trống nội dung!',
        ];
    }
}
