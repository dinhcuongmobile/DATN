<?php

namespace App\Http\Controllers\Client\GioHang;

use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\GioHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GioHangController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views=[];
    }

    public function gioHang(){
        if(Auth::check()){
            $this->views['gio_hangs']=GioHang::with('user','sanPham','bienThe')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        }else{
            $this->views['gio_hangs']=[];
        }
        return view('client.gioHang.gioHang',$this->views);
    }

    public function chiTietThanhToan(){
        return view('client.gioHang.chiTietThanhToan');
    }

    public function themGioHang(Request $request){
        if(!Auth::check()){
            return response()->json(['loginFalse' => false]);
        }else{
            
        }
    }
}
