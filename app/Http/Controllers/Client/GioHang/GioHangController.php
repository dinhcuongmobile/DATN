<?php

namespace App\Http\Controllers\Client\GioHang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GioHangController extends Controller
{
    public function __construct() {

    }

    public function gioHang(){
        return view('client.gioHang.gioHang');
    }

    public function chiTietThanhToan(){
        return view('client.gioHang.chiTietThanhToan');
    }
}
