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
        //admin
        View::composer('admin.layout.main', function ($view) {
            // Lấy dữ liệu từ model
            $sub=DonHang::where('trang_thai',0)->count();
            // Chia sẻ dữ liệu với view
            $view->with('sub', $sub);
        });
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
