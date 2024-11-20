<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeAdminController extends Controller
{
    public function __construct() {

    }

    public function homeAdmin(){
        return view('admin.homeAdmin');
    }

    public function thongKeTaiKhoan(){
        $tongTaiKhoan = User::count();
    return view('admin.homeAdmin', ['tongTaiKhoan' => $tongTaiKhoan,]);
    }
    public function thongKeDonHang(){
        $tongDonHang = DonHang::count();
    return view('admin.homeAdmin', ['tongDonHang' => $tongDonHang,]);
    }
}
