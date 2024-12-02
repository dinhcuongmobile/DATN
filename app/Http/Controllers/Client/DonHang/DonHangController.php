<?php

namespace App\Http\Controllers\Client\DonHang;

use App\Models\DiaChi;
use App\Models\DanhGia;
use App\Models\DonHang;
use App\Models\PhiShip;
use App\Models\SanPham;
use App\Models\AnhDanhGia;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    protected $views;

    public function __construct(){
        $this->views = [];
    }

    public function showChiTietDonHang(Request $request){
        $donHangId = $request->input('donHangId');
        $don_hang = DonHang::with('user','diaChi','chiTietDonHangs')->find($donHangId);
        $dia_chi = DiaChi::with('phuongXa','quanHuyen','tinhThanhPho')->find($don_hang->dia_chi_id);
        $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham','bienThe')->where('don_hang_id',$donHangId)->orderBy('id','desc')->get();
        $phi_ships = PhiShip::with('tinhThanhPho', 'quanHuyen')
                            ->where('ma_quan_huyen', $dia_chi->ma_quan_huyen)
                            ->first();
        if($don_hang){

            return response()->json([
                'success' => true,
                'don_hang' => $don_hang,
                'dia_chi' => $dia_chi,
                'chi_tiet_don_hangs' => $chi_tiet_don_hangs,
                'phi_ships' => $phi_ships
            ]);
        }
        else{
            return response()->json([
                'success' => false
            ]);
        }

    }

    public function huyDonHang(Request $request){
        DB::beginTransaction();
        try {
            $don_hang_id = $request->input('don_hang_id');
            $don_hang = DonHang::with('user','diaChi','chiTietDonHangs')->find($don_hang_id);
            if($don_hang){
                $don_hang->update([
                    'trang_thai' => 4,
                    'ngay_cap_nhat'=>now()
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function showModalDanhGia(Request $request){
        $don_hang_id = $request->input('don_hang_id');
        $don_hang = DonHang::with('user', 'diaChi', 'chiTietDonHangs')->find($don_hang_id);

        $subQuery = ChiTietDonHang::selectRaw('MIN(id) as id')
            ->where('don_hang_id', $don_hang_id)
            ->groupBy('san_pham_id');

        $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham', 'bienThe')
            ->whereIn('id', $subQuery)
            ->orderBy('id', 'desc')
            ->get();


        $chiTietChuaDanhGia = [];

        foreach ($chi_tiet_don_hangs as $item) {

            $danhGia = DanhGia::where('user_id', Auth::id())
                ->where('don_hang_id', $item->don_hang_id)
                ->where('san_pham_id', $item->san_pham_id)
                ->first();


            if (!$danhGia) {
                $chiTietChuaDanhGia[] = $item;
            }
        }

        if ($don_hang) {
            return response()->json([
                'success' => true,
                'don_hang' => $don_hang,
                'chi_tiet_don_hangs' => $chiTietChuaDanhGia
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function danhGia(Request $request){
        DB::beginTransaction();
        try {
            // Lưu đánh giá
            $danhGia = DanhGia::create([
                'don_hang_id' => $request->input('don_hang_id'),
                'san_pham_id' => $request->input('san_pham_id'),
                'user_id' => Auth::id(),
                'noi_dung' => $request->input('noiDung'),
                'so_sao' => $request->input('soSao'),
                'created_at' => now(),
            ]);

            // Xử lý file và lưu vào bảng `anh_danh_gias`
            if ($request->hasFile('images')) {
                if($danhGia){
                    foreach ($request->file('images') as $image) {
                        $filePath = $image->store('uploads/anhDanhGia', 'public');

                        AnhDanhGia::create([
                            'danh_gia_id' => $danhGia->id,
                            'hinh_anh' => $filePath,
                            'created_at' => now(),
                        ]);
                    }
                }
            }


            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function congNamadXuDanhGia(Request $request){
        DB::beginTransaction();
        try {
            $coin = Coin::where('user_id', Auth::user()->id)->first();
            $soCoin = $request->input('namad_xu');
            if ($coin && $soCoin > 0) {
                $coin->increment('coin', $soCoin);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function capNhatTrangThaiDaGiao(Request $request){
        DB::beginTransaction();
        try {
            $don_hang_id = $request->input('don_hang_id');
            $don_hang = DonHang::find($don_hang_id);
            if($don_hang){
                $don_hang->update([
                    'trang_thai' => 3,
                    'thanh_toan' => 1,
                    'ngay_cap_nhat'=>now()
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

}
