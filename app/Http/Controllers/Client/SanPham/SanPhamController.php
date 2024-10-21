<?php

namespace App\Http\Controllers\Client\SanPham;

use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\BienThe;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SanPhamController extends Controller
{
    protected $views;
    public function __construct() {
        $this->views=[];
    }

    public function chiTietSanPham(int $id){
        $this->views['san_pham']=SanPham::with('danhMuc','bienThes','danhGias')->find($id);
        $this->views['san_pham_lien_quan']=SanPham::with('danhMuc','bienThes','danhGias')
                                                    ->where('danh_muc_id',$this->views['san_pham']->danh_muc_id)->take(8)->get();
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

    public function soLuongTonKho(Request $request)
    {
        $kich_co = $request->input('kich_co');
        $mau_sac = $request->input('mau_sac');
        $san_pham_id = $request->input('san_pham_id');

        $bienThe = BienThe::where('san_pham_id', $san_pham_id)
                        ->where('kich_co', $kich_co)
                        ->where('ma_mau', $mau_sac)
                        ->first();

        if ($bienThe) {
            return response()->json(['quantity' => $bienThe->so_luong]);
        } else {
            return response()->json(['quantity' => 0]);
        }
    }

}
