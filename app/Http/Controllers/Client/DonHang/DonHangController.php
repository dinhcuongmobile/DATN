<?php

namespace App\Http\Controllers\Client\DonHang;

use Carbon\Carbon;
use App\Models\Coin;
use App\Models\DiaChi;
use App\Models\BienThe;
use App\Models\DanhGia;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\PhiShip;
use App\Models\SanPham;
use App\Models\ThongBao;
use App\Models\AnhDanhGia;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    protected $views;

    public function __construct(){
        $this->views = [];
    }

    public function checkTrangThaiDonHang(){
        $donHangs = DonHang::with(['user', 'diaChi', 'danhGia', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
        ->where('user_id', Auth::id())
        ->orderBy('ngay_cap_nhat', 'desc')
        ->get();

        $don_hangs = $donHangs->map(function ($donHang) {
            $soLuongDaDanhGia = $donHang->danhGia->count();

            $donHang->so_luong_da_danh_gia = $soLuongDaDanhGia;
            return $donHang;
        });

        $don_hangs_grouped = [
            'trang_thai_all' => $don_hangs,
            'trang_thai_0' => $don_hangs->where('trang_thai', 0)->values(),
            'trang_thai_1' => $don_hangs->where('trang_thai', 1)->values(),
            'trang_thai_2' => $don_hangs->where('trang_thai', 2)->values(),
            'trang_thai_3' => $don_hangs->where('trang_thai', 3)->values(),
            'trang_thai_4' => $don_hangs->where('trang_thai', 4)->values(),
        ];

        return response()->json([
            "donHang" => $don_hangs_grouped
        ]);

    }
    public function showChiTietDonHang(Request $request){
        $donHangId = $request->input('donHangId');
        $don_hang = DonHang::with('user','diaChi','chiTietDonHangs')->find($donHangId);

        if($don_hang){
            $dia_chi = DiaChi::with('phuongXa','quanHuyen','tinhThanhPho')->find($don_hang->dia_chi_id);
            $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham','bienThe')->where('don_hang_id',$donHangId)->orderBy('id','desc')->get();
            $phi_ships = PhiShip::with('tinhThanhPho', 'quanHuyen')
                                ->where('ma_quan_huyen', $dia_chi->ma_quan_huyen)
                                ->first();

            // Kiểm tra sản phẩm đã được đánh giá chưa
            $ngayQuyDinh = Carbon::now()->subDays(3);
            $checkChiTietDanhGia = ChiTietDonHang::with('sanPham', 'bienThe')
                                                ->where('don_hang_id', $donHangId)
                                                ->where('updated_at', '>=', $ngayQuyDinh)
                                                ->get();
            $san_pham_ids = $checkChiTietDanhGia->pluck('san_pham_id');
            $danh_gias = DanhGia::whereIn('san_pham_id', $san_pham_ids)
                                ->where('user_id', Auth::id())
                                ->where('don_hang_id',$donHangId)
                                ->pluck('san_pham_id');

            $chuaDanhGia = $san_pham_ids->diff($danh_gias);

            return response()->json([
                'success' => true,
                'don_hang' => $don_hang,
                'dia_chi' => $dia_chi,
                'chi_tiet_don_hangs' => $chi_tiet_don_hangs,
                'phi_ships' => $phi_ships,
                'chuaDanhGia' => $chuaDanhGia->values()
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

                $chi_tiet_don_hangs = ChiTietDonHang::where("don_hang_id",$don_hang_id)->get();
                
                foreach ($chi_tiet_don_hangs as $key => $value) {
                    $bien_the = BienThe::find($value->bien_the_id);

                    if ($bien_the && $bien_the->so_luong_tam_giu >= $value->so_luong) {
                        $bien_the->decrement('so_luong', $value->so_luong); // Trừ số lượng kho chính thức
                        $bien_the->decrement('so_luong_tam_giu', $value->so_luong); // Giảm tạm giữ
                    }
                }


                $userHuyDon = $don_hang->user->ho_va_ten ? $don_hang->user->ho_va_ten : $don_hang->user->email;
                ThongBao::create([
                    'tieu_de' => "Hủy đơn hàng",
                    'noi_dung' => "Đơn hàng ". $don_hang->ma_don_hang . " đã bị hủy bởi ". $userHuyDon,
                    'nguoi_nhan' => true
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

    public function daNhanHang(Request $request){
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

                $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham')->where('don_hang_id',$don_hang_id)->get();
                foreach ($chi_tiet_don_hangs as $item) {
                    $san_pham = SanPham::find($item->san_pham_id);
                    $san_pham->update(['da_ban'=> $san_pham->da_ban + $item->so_luong]);
                }

                ThongBao::create([
                    'tieu_de' => "Đơn hàng giao thành công",
                    'noi_dung' => "Đơn hàng ". $don_hang->ma_don_hang ." đã được giao thành công.",
                    'nguoi_nhan' => true
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

    public function muaLai(Request $request){
        DB::beginTransaction();
        try {
            $don_hang_id = $request->input('don_hang_id');
            $don_hang = DonHang::find($don_hang_id);

            if (!$don_hang || $don_hang->user_id != Auth::id()) {
                return response()->json([
                    'success' => false
                ]);
            }

            $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham','donHang','bienThe')
                                                ->where('don_hang_id',$don_hang->id)->get();

            foreach ($chi_tiet_don_hangs as $key => $itemChiTiet) {

                $bien_the = BienThe::with('sanPham')->where('id',$itemChiTiet->bien_the_id)
                                    ->where('san_pham_id',$itemChiTiet->san_pham_id)->first();
                if (!$bien_the) {
                    continue; // Bỏ qua nếu biến thể không tồn tại
                }

                $san_pham = SanPham::find($bien_the->san_pham_id);
                $gia_khuyen_mai = $san_pham->gia_san_pham - ($san_pham->gia_san_pham * $san_pham->khuyen_mai) / 100;

                if($bien_the->so_luong >= $itemChiTiet->so_luong){
                    $gio_hang = GioHang::where('user_id', Auth::id())
                                        ->where('san_pham_id', $bien_the->san_pham_id)
                                        ->where('bien_the_id', $bien_the->id)->first();
                    if(!$gio_hang){
                        GioHang::create([
                            'user_id' => Auth::id(),
                            'san_pham_id' => $bien_the->san_pham_id,
                            'bien_the_id' => $bien_the->id,
                            'so_luong' => $itemChiTiet->so_luong,
                            'thanh_tien' => $gia_khuyen_mai * $itemChiTiet->so_luong,
                            'created_at' => now(),
                        ]);
                    }else{
                        $gio_hang->update([
                            'so_luong' => $gio_hang->so_luong + $itemChiTiet->so_luong,
                            'thanh_tien' => $gia_khuyen_mai * ($gio_hang->so_luong + $itemChiTiet->so_luong),
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

}
