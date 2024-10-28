<?php

namespace App\Http\Controllers\Client\GioHang;

use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\GioHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BienThe;
use Illuminate\Support\Facades\Auth;

class GioHangController extends Controller
{
    protected $views;

    public function __construct()
    {
        $this->views = [];
    }

    public function gioHang()
    {
        if (Auth::check()) {
            $this->views['gio_hangs'] = GioHang::with('user', 'sanPham', 'bienThe')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        } else {
            $this->views['gio_hangs'] = [];
        }
        return view('client.gioHang.gioHang', $this->views);
    }

    public function chiTietThanhToan()
    {
        return view('client.gioHang.chiTietThanhToan');
    }

    public function themGioHang(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['loginFalse' => false]);
        } else {
            $user_id = Auth::user()->id;
            $gia_khuyen_mai = $request->input('gia_khuyen_mai');
            $san_pham_id = $request->input('san_pham_id');
            $so_luong = $request->input('so_luong');
            $kich_co = $request->input('kich_co');
            $ma_mau = $request->input('ma_mau');
            $bien_the = BienThe::where('san_pham_id', $san_pham_id)->where('kich_co', $kich_co)->where('ma_mau', $ma_mau)->first();
            $gio_hang = GioHang::where('user_id', $user_id)->where('san_pham_id', $san_pham_id)->where('bien_the_id', $bien_the->id)->first();
            if (!$gio_hang) {
                $data = [
                    'user_id' => $user_id,
                    'san_pham_id' => $san_pham_id,
                    'bien_the_id' => $bien_the->id,
                    'so_luong' => $so_luong,
                    'thanh_tien' => $gia_khuyen_mai * $so_luong,
                    'created_at' => now(),
                ];
                $result = GioHang::create($data);
            } else {
                $data = [
                    'so_luong' => $gio_hang->so_luong + $so_luong,
                    'thanh_tien' => $gia_khuyen_mai * ($gio_hang->so_luong + $so_luong),
                ];
                $result = $gio_hang->update($data);
            }
        }
    }
}
