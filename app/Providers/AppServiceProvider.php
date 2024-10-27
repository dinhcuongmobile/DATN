<?php

namespace App\Providers;

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
            if(Auth::check()){
                $gio_hangs = GioHang::with('user','sanPham','bienThe')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
                $view->with('gio_hangs', $gio_hangs);
            }else{
                $gio_hangs = [];
                $view->with('gio_hangs', $gio_hangs);
            }

        });
    }
}
