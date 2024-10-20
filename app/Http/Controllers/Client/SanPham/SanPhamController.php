<?php

namespace App\Http\Controllers\Client\SanPham;

use App\Http\Controllers\Controller;
use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    protected $views;
    public function __construct() {
        $this->views=[];
    }

    public function chiTietSanPham(int $id){
        $this->views['san_pham']=SanPham::with('bienThes','danhGias')->find($id);
        $this->views['kich_cos']=KichCo::all();
        $this->views['mau_sacs']=MauSac::all();
        return view('client.sanPham.chiTietSanPham',$this->views);
    }

    public function sanPham(){
        return view('client.sanPham.sanPham');
    }

    public function sanPhamDanhMuc(){
        return view('client.sanPham.sanPhamDanhMuc');
    }
}
