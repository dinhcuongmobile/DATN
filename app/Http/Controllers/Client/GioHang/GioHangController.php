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

    public function __construct(){
        $this->views = [];
    }

    public function gioHang(){
        $this->views['gio_hangs'] = [];
        $this->views['kich_cos'] = KichCo::all();
        $this->views['mau_sacs'] = MauSac::all();
        $this->views['san_pham_moi_nhat']= SanPham::with('bienThes','danhGias')->orderBy('id','desc')->take(8)->get();

        if (Auth::check()) {
            $gioHangs = GioHang::with('user', 'sanPham', 'bienThe')
                                ->where('user_id', Auth::user()->id)
                                ->whereHas('bienThe', function($query) {
                                    $query->where('so_luong', '>', 0);
                                })
                                ->orderBy('id', 'desc')
                                ->get();

            foreach ($gioHangs as $item) {
                $item->sanPham->load('danhMuc', 'bienThes', 'danhGias');
            }

            $this->views['gio_hangs'] = $gioHangs;
        }
        return view('client.gioHang.gioHang', $this->views);
    }

    public function chiTietThanhToan(){
        return view('client.gioHang.chiTietThanhToan');
    }

    public function themGioHang(Request $request){
        if (!Auth::check()) {
            return response()->json(['login' => false]);
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
            $gio_hangs = GioHang::with('user', 'sanPham', 'bienThe')
                    ->where('user_id', Auth::id())
                    ->orderBy('id', 'desc')
                    ->get();
            $san_pham= SanPham::find($san_pham_id);
            $count_gio_hang = $gio_hangs->count();
            if($result){
                return response()->json(['login' => true, 'count_gio_hang' => $count_gio_hang, 'san_pham' => $san_pham]);
            }
        }
    }

    public function xoaTatCa(Request $request){
        $gio_hang_id =  $request->input('gio_hang_id');
        foreach ($gio_hang_id as $item) {
            GioHang::where('id',$item)->delete();
        }

        $gio_hang = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereHas('bienThe', function($query) {
                                $query->where('so_luong', '>', 0);
                            })
                            ->orderBy('id', 'desc')
                            ->get();

        return response()->json(['success' => true, 'gio_hang'=>$gio_hang]);
    }

    public function xoaSanPhamGiohang(Request $request){
        $gio_hang_id =  $request->input('gio_hang_id');
        GioHang::where('id',$gio_hang_id)->delete();

        $gio_hang = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereHas('bienThe', function($query) {
                                $query->where('so_luong', '>', 0);
                            })
                            ->orderBy('id', 'desc')
                            ->get();

        return response()->json(['success' => true, 'gio_hang'=>$gio_hang]);
    }

    public function soLuongMua(Request $request){
        $gio_hang = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->find($request->input('gio_hang_id'));

        $so_luong = $request->input('so_luong');
        $thanh_tien = $request->input('thanh_tien');
        $data = [
            'so_luong' => $so_luong,
            'thanh_tien' => $thanh_tien
        ];
        $gio_hang->update($data);

        $gio_hangs = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereHas('bienThe', function($query) {
                                $query->where('so_luong', '>', 0);
                            })
                            ->orderBy('id', 'desc')
                            ->get();
        return response()->json(['gio_hangs'=>$gio_hangs]);
    }

    public function checkBienTheSize(Request $request){
        $gio_hang = GioHang::with('bienThe')->find($request->input('gio_hang_id'));
        $disabledColors = [];

        if ($gio_hang) {
            $bienTheProducts = GioHang::with('bienThe')
                ->where('san_pham_id', $gio_hang->san_pham_id)
                ->where('id', '!=', $gio_hang->id)
                ->get();

            foreach ($bienTheProducts as $item) {
                if ($item->bienThe && $item->bienThe->kich_co == $request->input('kich_co')) {
                    $disabledColors[] = $item->bienThe->ma_mau;
                }
            }
        }

        return response()->json(['disabledColors' => array_unique($disabledColors)]);
    }

    public function checkBienTheColor(Request $request){
        $gio_hang = GioHang::with('bienThe')->find($request->input('gio_hang_id'));
        $disabledSizes = [];

        if ($gio_hang) {
            $bienTheProducts = GioHang::with('bienThe')
                ->where('san_pham_id', $gio_hang->san_pham_id)
                ->where('id', '!=', $gio_hang->id)
                ->get();

            foreach ($bienTheProducts as $item) {
                if ($item->bienThe && $item->bienThe->ma_mau == $request->input('ma_mau')) {
                    $disabledSizes[] = $item->bienThe->kich_co;
                }
            }
        }

        return response()->json(['disabledSizes' => array_unique($disabledSizes)]);
    }


    public function thayDoiBienThe(Request $request){
        $gio_hang= GioHang::with('user', 'sanPham', 'bienThe')->find($request->input('gio_hang_id'));

        $bien_the = BienThe::where('san_pham_id',$gio_hang->san_pham_id)
                            ->where('kich_co',$request->input('kich_co'))
                            ->where('ma_mau',$request->input('ma_mau'))->first();

        if ($bien_the) {
            $gio_hang->update(['bien_the_id'=>$bien_the->id]);
        }

        return response()->json(['gio_hang'=>$gio_hang,'bien_the'=>$bien_the]);
    }
}
