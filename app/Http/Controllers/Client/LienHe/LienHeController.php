<?php

namespace App\Http\Controllers\Client\LienHe;

use App\Http\Controllers\Controller;
use App\Models\LienHe;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    public function lienHe() {
        return view('client.lienHe.lienHe');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu form
        $request->validate([
            'ho_va_ten' => 'required|string|max:100',
            'email' => 'required|email',
            'so_dien_thoai' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'noi_dung' => 'required',
        ], [
            'ho_va_ten.required' => 'Họ và tên không được để trống.',
            'ho_va_ten.string' => 'Họ và tên phải là chuỗi ký tự.',
            'ho_va_ten.max' => 'Họ và tên không được vượt quá 100 ký tự.',

            'email.required' =>'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',

            'so_dien_thoai.required' =>'Số điện thoại không được để trống.',
            'so_dien_thoai.regez' => 'Số điện thoại không đúng định dạng.',
            'so_dien_thoai.min' => 'Số điện thoại không đúng định dạng.',

            'noi_dung.required' => 'Nội dung không được để trống.',
            
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        LienHe::create([
            'ho_va_ten' => $request->ho_va_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'noi_dung' => $request->noi_dung,
           
        ]);

        // Chuyển hướng sau khi lưu thành công
        return redirect()->route('lien-he.lien-he')->with('success', 'Liên hệ của bạn đã được gửi thành công.');
    }
}
