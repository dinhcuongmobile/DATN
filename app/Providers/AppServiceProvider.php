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
        View::composer('layout.main', function ($view) {
            $thongBaos = collect();
            $donHangMoi = DonHang::where('trang_thai', 0)
                ->orderBy('ngay_tao', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'Đơn hàng mới',
                        'icon' => 'fas fa-box',
                        'color' => 'bg-primary',
                        'message' => "Đơn hàng: {$item->ma_don_hang} - Bạn có đơn hàng mới!",
                        'link' => route('don-hang.chi-tiet-don-hang', $item->id),
                        'date' => $item->ngay_tao,
                    ];
                });
            $lienHeMoi = LienHe::where('trang_thai', 0)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'Liên hệ mới',
                        'icon' => 'fas fa-comments',
                        'color' => 'bg-warning',
                        'message' => "Bạn có liên hệ mới từ {$item->ho_va_ten}!",
                        'link' => route('lienhe.dsLienHeChuaPhanHoi'),
                        'date' => $item->created_at,
                    ];
                });
            $thongBaos = $thongBaos->concat($donHangMoi)->concat($lienHeMoi);
            // Sắp xếp theo thời gian giảm dần
            $thongBaos = $thongBaos->sortByDesc('date');
            // Share thông báo với view
            $view->with('thongBaos', $thongBaos);
        });
     }
    }
