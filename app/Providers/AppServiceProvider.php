<?php

namespace App\Providers;

use App\Models\User;
use App\Models\LienHe;
use App\Models\TinTuc;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\DanhMucTinTuc;
use App\Models\YeuThich;
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
            $count_yeu_thich = 0;
            $danh_mucs = DanhMuc::all();
            $userId = Auth::id();
            $danhMucTinTuc = DanhMucTinTuc::all();

            if (Auth::check()) {
                $gio_hangs = GioHang::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

                $yeu_thichs = YeuThich::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

                $count_gio_hang = $gio_hangs->count();
                $count_yeu_thich = $yeu_thichs->count();
            }

            $view->with(compact('gio_hangs', 'count_gio_hang','count_yeu_thich','danh_mucs', 'userId','danhMucTinTuc'));
        });
        //admin
        View::composer('admin.layout.main', function ($view) {
            // Lấy dữ liệu từ model
            $sub=DonHang::where('trang_thai',0)->count();
            // Chia sẻ dữ liệu với view
            $view->with('sub', $sub);
        });
    }
}
