<?php

namespace App\Http\Controllers\Client;

use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\TinTuc;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $views;
    protected $tin_tucs;
    public function __construct() {
        $this->views=[];
        $this->tin_tucs=new TinTuc();
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
        $this->views['tin_tucs']=$this->tin_tucs->loadAllTinTuc();
        return view('client.home',$this->views);
    }

    public function quickView(Request $request){
        $san_pham = SanPham::with('bienThes','danhGias')->find($request->input('san_pham_id'));
        $kich_cos = KichCo::all();
        $mau_sacs = MauSac::all();
        return response()->json([
            'san_pham'=>$san_pham,
            'kich_cos' => $kich_cos,
            'mau_sacs' => $mau_sacs
        ]);
    }

    public function error404()
    {
        return view('auth.404');
    }
}
