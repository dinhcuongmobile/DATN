<?php

namespace App\Http\Controllers\Admin\SanPham;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanPhamAdminController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    public function danhSachSanPham(){
        return view('admin.sanPham.DSSanPham');
    }
}
