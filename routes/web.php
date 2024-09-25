<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Client\SanPham\SanPhamController;
use App\Http\Controllers\Client\TaiKhoan\TaiKhoanController;
use App\Http\Controllers\Client\GioiThieu\GioiThieuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'home'])->name('trang-chu.home');

Route::prefix('san-pham')->group(function(){
    Route::get('san-pham',[SanPhamController::class,'sanPham'])->name('san-pham.san-pham');
    Route::get('san-pham-danh-muc',[SanPhamController::class,'sanPhamDanhMuc'])->name('san-pham.san-pham-danh-muc');
    Route::get('chi-tiet-san-pham',[SanPhamController::class,'chiTietSanPham'])->name('san-pham.chi-tiet-san-pham');
   
});
Route::prefix('tai-khoan')->group(function(){
    Route::get('dang-nhap', [TaiKhoanController::class,'showDangNhap'])->name('tai-khoan.dang-nhap');
    Route::get('dang-ky', [TaiKhoanController::class,'showDangKy'])->name('tai-khoan.dang-ky');
    Route::get('quen-mat-khau', [TaiKhoanController::class,'showQuenMatKhau'])->name('tai-khoan.quen-mat-khau');
    Route::get('thong-tin-tai-khoan', [TaiKhoanController::class,'showThongTinTaiKhoan'])->name('tai-khoan.thong-tin-tai-khoan');
});
Route::get('gioi-thieu',[GioiThieuController::class,'gioiThieu'])->name('gioi-thieu.gioi-thieu');

// admin
Route::prefix('admin')->group(function(){
    Route::get('index',[HomeAdminController::class,'homeAdmin'])->name('admin.index');
});
