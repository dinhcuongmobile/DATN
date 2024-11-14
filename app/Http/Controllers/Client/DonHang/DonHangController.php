<?php

namespace App\Http\Controllers\Client\DonHang;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    public function donMua(){
        $don_hangs = [
            'trang_thai_all' => DonHang::with('user','diaChi')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get(),
            'trang_thai_0' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 0)->get(),
            'trang_thai_1_2' => DonHang::where('user_id', Auth::user()->id)->whereIn('trang_thai', [1, 2])->get(),
            'trang_thai_3' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 3)->get(),
            'trang_thai_4' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 4)->get(),
            'trang_thai_5' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 5)->get(),
        ];

        $chi_tiet_don_hangs = [];

        foreach ($don_hangs as $key => $items) {
            foreach ($items as $item) {
                $chi_tiet_don_hangs[$item->id] = ChiTietDonHang::with('sanPham','bienThe')->where('don_hang_id',$item->id)->get();
            }
        }

        $this->views['don_hangs'] = $don_hangs;
        $this->views['chi_tiet_don_hangs'] = $chi_tiet_don_hangs;

        return view('client.donHang.lichSuMuaHang',$this->views);
    }
}
