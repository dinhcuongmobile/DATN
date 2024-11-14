<?php

namespace App\Http\Requests\SanPham;

use App\Models\SanPham;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKhuyenMaiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'so_tien_giam' => 'required|numeric|min:0',
            'ngay_ket_thuc' => 'required|after:ngay_bat_dau',
            'gia_tri_toi_thieu' => 'required|numeric|min:0'
        ];
    }


    public function messages()
    {
        return [
            'so_tien_giam.required' => 'Vui lòng nhập số tiền giảm.',
            'so_tien_giam.numeric' => 'Số tiền giảm phải là một số.',
            'so_tien_giam.min' => 'Số tiền giảm không được nhỏ hơn 0.',
            'ngay_ket_thuc.required' => 'Vui lòng chọn ngày kết thúc.',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'gia_tri_toi_thieu.required' => 'Vui lòng nhập giá trị tối thiểu.',
            'gia_tri_toi_thieu.numeric' => 'Giá trị tối thiểu phải là một số.',
            'gia_tri_toi_thieu.min' => 'Giá trị tối thiểu không được nhỏ hơn 0.'
        ];
    }

}
