<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTaiKhoanController extends Controller
{
    public function danhSachQuanTriVien() 
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 0)->get(); // with('vaiTro) là eloquent bên Model User

        return view('admin.taiKhoan.danhSachQuanTriVien', compact('taiKhoan'));
    }

    public function danhSachNhanVien() 
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 0)->get();

        return view('admin.taiKhoan.danhSachNhanVien', compact('taiKhoan'));
    }

    public function danhSachNguoiDung() 
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 0)->get();

        return view('admin.taiKhoan.danhSachNguoiDung', compact('taiKhoan'));   
    }

    public function danhSachTaiKhoanBiKhoa() 
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 1)->get();

        return view('admin.taiKhoan.danhSachTaiKhoanBiKhoa', compact('taiKhoan'));   
    }
}
