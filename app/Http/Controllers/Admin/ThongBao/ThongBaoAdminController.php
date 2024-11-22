<?php

namespace App\Http\Controllers\Admin\ThongBao;

use App\Models\LienHe;
use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThongBaoAdminController extends Controller
{
    public function layThongBao()
    {
        // Lấy 2 thông báo đầu tiên khi chưa mở modal
        $donHangMoi = DonHang::where('trang_thai', 0)->orderBy('ngay_tao', 'desc')->take(2)->get();
        $donHangDaGiao = DonHang::where('trang_thai', 3)->orderBy('ngay_cap_nhat', 'desc')->take(2)->get();
        $lienHeMoi = LienHe::where('trang_thai', 0)->orderBy('created_at', 'desc')->take(2)->get();
        $lienHeDaPhanHoi = LienHe::where('trang_thai', 1)->orderBy('created_at', 'desc')->take(2)->get();

        // Lấy tất cả thông báo khi mở modal
        $donHangMoiFull = DonHang::where('trang_thai', 0)->orderBy('ngay_tao', 'desc')->get();
        $donHangDaGiaoFull = DonHang::where('trang_thai', 3)->orderBy('ngay_cap_nhat', 'desc')->get();
        $lienHeMoiFull = LienHe::where('trang_thai', 0)->orderBy('created_at', 'desc')->get();
        $lienHeDaPhanHoiFull = LienHe::where('trang_thai', 1)->orderBy('created_at', 'desc')->get();

        // Lấy tổng số lượng thông báo cho mỗi loại
        $donHangMoiCount = $donHangMoiFull->count();
        $donHangDaGiaoCount = $donHangDaGiaoFull->count();
        $lienHeMoiCount = $lienHeMoiFull->count();
        $lienHeDaPhanHoiCount = $lienHeDaPhanHoiFull->count();
        $tongSoLuongTB = $donHangMoiCount + $donHangDaGiaoCount + $lienHeMoiCount + $lienHeDaPhanHoiCount;

        return response()->json([
            'donHangMoi' => $donHangMoi,
            'donHangDaGiao' => $donHangDaGiao,
            'lienHeMoi' => $lienHeMoi,
            'lienHeDaPhanHoi' => $lienHeDaPhanHoi,
            'tongSoLuongTB' => $tongSoLuongTB,
            'donHangMoiFull' => $donHangMoiFull,
            'donHangDaGiaoFull' => $donHangDaGiaoFull,
            'lienHeMoiFull' => $lienHeMoiFull,
            'lienHeDaPhanHoiFull' => $lienHeDaPhanHoiFull,
        ]);
    }
}
