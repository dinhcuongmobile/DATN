<?php

namespace App\Http\Controllers\Client\TaiKhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaiKhoanController extends Controller
{
    public function __construct(){

    }
    public function showDangKy(){
        return view('client.taiKhoan.dangKy');
    }
    public function showDangNhap(){
        return view('client.taiKhoan.dangNhap');
    }
    public function showQuenMatKhau(){
        return view('client.taiKhoan.quenMatKhau');
    }
    public function showThongTinTaiKhoan(){
        return view('client.taiKhoan.thongTinTaiKhoan');
    }
}
