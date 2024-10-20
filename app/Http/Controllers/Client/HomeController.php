<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $views;
    public function __construct() {
        $this->views=[];
    }

    public function home(){
        $san_pham_noi_bat= SanPham::with('bienThes','danhGias')->orderBy('luot_xem','desc')->take(8)->get();
        $san_pham_moi_nhat= SanPham::with('bienThes','danhGias')->orderBy('id','desc')->take(8)->get();
        $san_pham_ban_chay= SanPham::with('bienThes','danhGias')->orderBy('da_ban','desc')->take(8)->get();
        $san_pham_khuyen_mai= SanPham::with('bienThes','danhGias')->where('khuyen_mai',">",0)->orderBy('id','desc')->take(8)->get();
        $this->views['san_pham_noi_bat']=$san_pham_noi_bat;
        $this->views['san_pham_moi_nhat']=$san_pham_moi_nhat;
        $this->views['san_pham_ban_chay']=$san_pham_ban_chay;
        $this->views['san_pham_khuyen_mai']=$san_pham_khuyen_mai;
        return view('client.home',$this->views);
    }

    public function error404()
    {
        return view('auth.404');
    }
}
