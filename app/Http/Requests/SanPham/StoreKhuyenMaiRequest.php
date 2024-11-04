<?php

namespace App\Http\Requests\SanPham;

use App\Models\SanPham;
use Illuminate\Foundation\Http\FormRequest;

class StoreKhuyenMaiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'ma_giam_gia' => 'required|max:255|unique:ma_khuyen_mais,ma_giam_gia',
            'so_tien_giam' => 'required|numeric|min:0',
            'ngay_bat_dau' => 'required|before:ngay_ket_thuc|after_or_equal:today',
            'ngay_ket_thuc' => 'required|after:ngay_bat_dau',
            'gia_tri_toi_thieu' => 'required|numeric|min:0',
            'trang_thai' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'ma_giam_gia.required' => 'Vui lòng nhập mã giảm giá.',
            'ma_giam_gia.max' => 'Mã giảm giá không được vượt quá 255 ký tự.',
            'ma_giam_gia.unique' => 'Mã giảm này đã được tạo trước đó.',
            'so_tien_giam.required' => 'Vui lòng nhập số tiền giảm.',
            'so_tien_giam.numeric' => 'Số tiền giảm phải là một số.',
            'so_tien_giam.min' => 'Số tiền giảm không được nhỏ hơn 0.',
            'ngay_bat_dau.required' => 'Vui lòng chọn ngày bắt đầu.',
            'ngay_bat_dau.before' => 'Ngày bắt đầu phải trước ngày kết thúc.',
            'ngay_bat_dau.after_or_equal' => 'Ngày bắt đầu không được là ngày trong quá khứ.',
            'ngay_ket_thuc.required' => 'Vui lòng chọn ngày kết thúc.',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'gia_tri_toi_thieu.required' => 'Vui lòng nhập giá trị tối thiểu.',
            'gia_tri_toi_thieu.numeric' => 'Giá trị tối thiểu phải là một số.',
            'gia_tri_toi_thieu.min' => 'Giá trị tối thiểu không được nhỏ hơn 0.',
            'trang_thai.required' => 'Vui lòng chọn kiểu giảm giá.',
        ];
    }

}
