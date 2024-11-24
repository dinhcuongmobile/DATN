<?php

namespace App\Http\Controllers\Client\DonHang;

use App\Http\Controllers\Controller;
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
        $don_hang = DonHang::with('diaChi','chiTietDonHangs','donHangHoan')->find($donHangId);
        if($don_hang){


            return response()->json([
                'success' => true,
                'don_hang' => $don_hang
            ]);
        }
        else{
            return response()->json([
                'success' => false
            ]);
        }

    }
}
