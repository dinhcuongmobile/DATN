<?php

namespace App\Providers;

use App\Models\DanhMuc;
use App\Models\GioHang;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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

        View::composer('client.layout.main', function ($view) {
            $gio_hangs = [];
            $count_gio_hang = 0;
            $danh_mucs = DanhMuc::all();

            if (Auth::check()) {
                $gio_hangs = GioHang::with('user', 'sanPham', 'bienThe')
                    ->where('user_id', Auth::id())
                    ->orderBy('id', 'desc')
                    ->get();
                $count_gio_hang = $gio_hangs->count();
            }

            $view->with(compact('gio_hangs', 'count_gio_hang','danh_mucs'));
        });
    }
}
