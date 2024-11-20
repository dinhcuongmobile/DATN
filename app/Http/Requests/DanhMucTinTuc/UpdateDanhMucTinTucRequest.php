<?php

namespace App\Http\Requests\DanhMucTinTuc;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDanhMucTinTucRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id = $this->route('id');
        return [
            'ten_danh_muc' => [
                'required',
                'string',
                'max:255',
                'unique:danh_muc_tin_tucs,ten_danh_muc,'.$id,
                'regex:/^[^\d]*$/'
            ],
        ];
    }

    public function messages()
    {
        return [
            'ten_danh_muc.required' => 'Vui lòng không bỏ trống !',
            'ten_danh_muc.unique' => 'Danh mục đã tồn tại !',
            'ten_danh_muc.regex' => 'Danh mục không được để ký tự chữ số !',
        ];
    }
}
