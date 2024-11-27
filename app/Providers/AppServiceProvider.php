<?php

namespace App\Providers;

use App\Models\User;
use App\Models\LienHe;
use App\Models\TinTuc;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\DanhMucTinTuc;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        //client
        View::composer('client.layout.main', function ($view) {
            $gio_hangs = [];
            $count_gio_hang = 0;
            $danh_mucs = DanhMuc::all();
            $userId = Auth::id();

            if (Auth::check()) {
                $gio_hangs = GioHang::with('user', 'sanPham', 'bienThe')
                    ->where('user_id', Auth::id())
                    ->orderBy('id', 'desc')
                    ->get();
                $count_gio_hang = $gio_hangs->count();
            }
            // Tổng yêu thích
            if (Auth::check()) {
                $nguoi_dung_id = Auth::id();
                $user = User::find($nguoi_dung_id);
                $tong_yeu_thich = $user->yeuThich()->count();
            }
            //

            $view->with(compact('gio_hangs', 'count_gio_hang', 'danh_mucs', 'userId', 'tong_yeu_thich'));
        });

        //danh mục tin tức
        $danh_muc_tin_tucs = DanhMucTinTuc::all();
        view()->share('danh_muc_tin_tucs', $danh_muc_tin_tucs);
        //admin
        View::composer('admin.layout.main', function ($view) {
            // Lấy dữ liệu từ model
            $sub = DonHang::where('trang_thai', 0)->count();
            // Chia sẻ dữ liệu với view
            $view->with('sub', $sub);
        });
        // Chia sẻ dữ liệu cho view in hóa đơn
        View::composer('admin.donHang.hoaDon', function ($view) {
            $donHangId = request()->route('id');
            $donHang = DonHang::with(['chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])->findOrFail($donHangId);
            $tongTienSanPham = $donHang->chiTietDonHangs->sum('thanh_tien');
            $view->with([
                'donHang' => $donHang,
                'tongTienSanPham' => $tongTienSanPham,
                'phiVanChuyen' => $donHang->giam_gia_van_chuyen,
                'giamGiaDonHang' => $donHang->giam_gia_don_hang,
                'tongThanhToan' => $donHang->tong_thanh_toan
            ]);
        });
        // Chia sẻ dữ liệu cho view in hàng loạt hóa đơn
        View::composer('admin.donHang.inHoaDonHangLoat', function ($view) {
            $donHangs = DonHang::with(['chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])->where('trang_thai', 1)->get();
            // Tính tổng tiền sản phẩm cho tất cả các đơn hàng
            $tongTienSanPham = $donHangs->reduce(function ($carry, $donHang) {
                return $carry + $donHang->chiTietDonHangs->sum('thanh_tien');
            }, 0);
            $donHangs->each(function ($donHang) {
                $donHang->tongThanhToan = $donHang->tong_thanh_toan;
            });

            $view->with([
                'donHangs' => $donHangs,
                'tongTienSanPham' => $tongTienSanPham,  // Tổng tiền sản phẩm cho tất cả các đơn hàng
                'phiVanChuyen' => $donHangs->sum('giam_gia_van_chuyen'),  // Tổng phí vận chuyển cho tất cả các đơn hàng
                'giamGiaDonHang' => $donHangs->sum('giam_gia_don_hang'),  // Tổng giảm giá đơn hàng
                'tongThanhToan' => $donHangs->map(function ($donHang) {
                    return $donHang->tongThanhToan;  // Tổng thanh toán riêng biệt cho mỗi đơn hàng
                }),
            ]);
        });
    }
}
