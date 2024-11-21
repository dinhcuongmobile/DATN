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

            $view->with(compact('gio_hangs', 'count_gio_hang','danh_mucs', 'userId'));
        });
        //danh mục tin tức
        $danh_muc_tin_tucs = DanhMucTinTuc::all();
        view()->share('danh_muc_tin_tucs', $danh_muc_tin_tucs);
        //tin tức
        view()->composer('client.home', function ($view) {
            $tinTucs = TinTuc::with('user')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            $view->with('tinTucs', $tinTucs);
        });
        //admin
        View::composer('admin.layout.main', function ($view) {
            // Lấy dữ liệu từ model
            $sub=DonHang::where('trang_thai',0)->count();
            // Chia sẻ dữ liệu với view
            $view->with('sub', $sub);
        });
        // Tổng doanh thu theo sản phẩm đã giao
        View::composer('admin.homeAdmin', function ($view) {
            $thongKeSanPhams = DonHang::where('trang_thai', 3) // Trạng thái đã giao
                ->join('chi_tiet_don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
                ->join('san_phams', 'chi_tiet_don_hangs.san_pham_id', '=', 'san_phams.id')
                ->selectRaw('san_phams.id, san_phams.ten_san_pham, san_phams.hinh_anh, SUM(chi_tiet_don_hangs.thanh_tien) as tong_doanh_thu')
                ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
                ->orderByDesc('tong_doanh_thu')
                ->take(3)
                ->get();
            foreach ($thongKeSanPhams as $item) {
                $item->tong_doanh_thu = number_format($item->tong_doanh_thu, 0, ',', '.');
            }
            $view->with('thongKeSanPhams', $thongKeSanPhams);
        });
        // Tổng doanh thu theo danh mục đã giao
        View::composer('admin.homeAdmin', function ($view) {
            $thongKeDanhMucs = DonHang::where('trang_thai', 3) // Trạng thái đã giao
                ->join('chi_tiet_don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
                ->join('san_phams', 'chi_tiet_don_hangs.san_pham_id', '=', 'san_phams.id')
                ->join('danh_mucs', 'san_phams.danh_muc_id', '=', 'danh_mucs.id')
                ->selectRaw('danh_mucs.id, danh_mucs.ten_danh_muc, danh_mucs.hinh_anh, SUM(chi_tiet_don_hangs.thanh_tien) as tong_doanh_thu')
                ->groupBy('danh_mucs.id', 'danh_mucs.ten_danh_muc', 'danh_mucs.hinh_anh')
                ->orderByDesc('tong_doanh_thu')
                ->take(3)
                ->get();
            foreach ($thongKeDanhMucs as $item) {
                $item->tong_doanh_thu = number_format($item->tong_doanh_thu, 0, ',', '.'); 
            }

            // Truyền dữ liệu vào view
            $view->with('thongKeDanhMucs', $thongKeDanhMucs);
        });
        //Thống Kê Tài Khoản
        $tongTaiKhoan = User::count();
        View::share('tongTaiKhoan', $tongTaiKhoan);
        //Thống Kê Đơn Hàng
        $tongDonHang = DonHang::count();
        View::share('tongDonHang', $tongDonHang);
        //Thống Kê Lượt Xem 
        if (!Session::has('luot_xem')) {
            $tongLuotXem = Cache::get('tong_luot_xem', 0) + 1;
            Cache::put('tong_luot_xem', $tongLuotXem);
            Session::put('luot_xem', true);
        } else {
            $tongLuotXem = Cache::get('tong_luot_xem', 0);
        }
        View::share('tongLuotXem', $tongLuotXem);

        //Thông Báo Admin mini
        $donHangMoi = DonHang::where('trang_thai', 0)
            ->orderBy('ngay_tao', 'desc')
            ->take(2)
            ->get();
        $donHangDaGiao = DonHang::where('trang_thai', 3)
            ->orderBy('ngay_tao', 'desc')
            ->take(2)
            ->get();
        $lienHeMoi = LienHe::where('trang_thai', 0)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        $lienHeDaPhanHoi = LienHe::where('trang_thai', 1)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        View::share('donHangMoi', $donHangMoi);
        View::share('donHangDaGiao', $donHangDaGiao);
        View::share('lienHeMoi', $lienHeMoi);
        View::share('lienHeDaPhanHoi', $lienHeDaPhanHoi);
        //Tất cả thông báo
        $donHangMoiAll = DonHang::where('trang_thai', 0)
            ->orderBy('ngay_tao', 'desc')
            ->get();
        $donHangDaGiaoAll = DonHang::where('trang_thai', 3)
            ->orderBy('ngay_tao', 'desc')
            ->get();
        $lienHeMoiAll = LienHe::where('trang_thai', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        $lienHeDaPhanHoiAll = LienHe::where('trang_thai', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        View::share('donHangMoiAll', $donHangMoiAll);
        View::share('donHangDaGiaoAll', $donHangDaGiaoAll);
        View::share('lienHeMoiAll', $lienHeMoiAll);
        View::share('lienHeDaPhanHoiAll', $lienHeDaPhanHoiAll);
     }
    }
