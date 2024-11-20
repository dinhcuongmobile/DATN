<?php

namespace App\Http\Controllers\Client\DonHang;

use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use App\Models\DiaChi;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    protected $views;

    public function __construct(){
        $this->views = [];
    }

    public function showChiTietDonHang(Request $request){
        $donHangId = $request->input('donHangId');
        $don_hang = DonHang::with('user','diaChi','chiTietDonHangs','donHangHoan')->find($donHangId);
        $dia_chi = DiaChi::with('phuongXa','quanHuyen','tinhThanhPho')->find($don_hang->dia_chi_id);
        $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham','bienThe')->where('don_hang_id',$donHangId)->orderBy('id','desc')->get();
        if($don_hang){

            return response()->json([
                'success' => true,
                'don_hang' => $don_hang,
                'dia_chi' => $dia_chi,
                'chi_tiet_don_hangs' => $chi_tiet_don_hangs
            ]);
        }
        else{
            return response()->json([
                'success' => false
            ]);
        }

    }
}
