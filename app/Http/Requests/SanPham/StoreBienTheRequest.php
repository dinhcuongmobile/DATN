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
            'mau_sac' => [
                'required',
            ],
            'so_luong' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'kich_co.required' => 'Vui lòng chọn kích cỡ cho sản phẩm !',
            'so_luong.required' => 'Vui lòng không bỏ trống số lượng sản phẩm !',
            'mau_sac.required' => 'Vui lòng chọn màu sắc cho sản phẩm!',
        ];
    }
}
