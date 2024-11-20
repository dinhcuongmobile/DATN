<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

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
    public function thongKeLuotXem(){
        if(!Session::has('luot_xem')){
            $tongLuotXem = Cache::get('tong_luot_xem', 0) + 1;
            Cache::put('tong_luot_xem', $tongLuotXem);
            Session::put('luot_xem', true);
        }else{
            $tongLuotXem = Cache::get('tong_luot_xem',0);
        }
        return view('admin.homeAdmin', ['tongLuotXem' => $tongLuotXem,]);
    }
}
