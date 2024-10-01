<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Http\Controllers\Controller;
use App\Models\VaiTro;
use Illuminate\Http\Request;

class AdminVaiTroTaiKhoanComtroller extends Controller
{
    public function danhSachVaiTroTaiKhoan() {
        $vai_tros = VaiTro::query()->orderByDesc('id')->get();
        return view('admin.vaiTroTaiKhoan.danhSachVaiTroTaiKhoan', compact('vai_tros'));
    }

}
