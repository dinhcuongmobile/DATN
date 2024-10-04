<?php

namespace App\Http\Controllers\Client\SanPham;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function __construct() {

    }

    public function chiTietSanPham(){
        return view('client.sanPham.chiTietSanPham');
    }

    public function sanPham(){
        return view('client.sanPham.sanPham');
    }

    public function sanPhamDanhMuc(){
        return view('client.sanPham.sanPhamDanhMuc');
    }
}
