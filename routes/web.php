<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\TaiKhoan\AdminVaiTroTaiKhoanComtroller;
use App\Http\Controllers\Client\LienHe\LienHeController;
use App\Http\Controllers\Client\TinTuc\TinTucController;
use App\Http\Controllers\Client\GioHang\GioHangController;
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

Route::prefix('tai-khoan')->group(function(){
    Route::get('dang-ky',[TaiKhoanController::class,'showDangKy'])->name('tai-khoan.dang-ky');
    Route::get('dang-nhap',[TaiKhoanController::class,'showDangNhap'])->name('tai-khoan.dang-nhap');
    Route::get('quen-mat-khau',[TaiKhoanController::class,'showQuenMatKhau'])->name('tai-khoan.quen-mat-khau');
    Route::get('thong-tin-tai-khoan',[TaiKhoanController::class,'showThongTinTaiKhoan'])->name('tai-khoan.thong-tin-tai-khoan');
});

Route::prefix('san-pham')->group(function(){
    Route::get('/',[SanPhamController::class,'sanPham'])->name('san-pham.san-pham');
    Route::get('san-pham-danh-muc',[SanPhamController::class,'sanPhamDanhMuc'])->name('san-pham.san-pham-danh-muc');
    Route::get('chi-tiet-san-pham',[SanPhamController::class,'chiTietSanPham'])->name('san-pham.chi-tiet-san-pham');
});

Route::prefix('gio-hang')->group(function(){
    Route::get('/',[GioHangController::class,'gioHang'])->name('gio-hang.gio-hang');
    Route::get('chi-tiet-thanh-toan',[GioHangController::class,'chiTietThanhToan'])->name('gio-hang.chi-tiet-thanh-toan');
});

Route::prefix('tin-tuc')->group(function(){
    Route::get('/',[TinTucController::class,'tinTuc'])->name('tin-tuc.tin-tuc');
    Route::get('/chi-tiet-tin-tuc',[TinTucController::class,'chiTietTinTuc'])->name('tin-tuc.chi-tiet-tin-tuc');
    Route::get('/tin-tuc-danh-muc',[TinTucController::class,'tinTucDanhMuc'])->name('tin-tuc.tin-tuc-danh-muc');
});

Route::prefix('lien-he')->group(function(){
    Route::get('/',[LienHeController::class,'lienHe'])->name('lien-he.lien-he');
});

Route::get('gioi-thieu',[GioiThieuController::class,'gioiThieu'])->name('gioi-thieu');


// admin
Route::prefix('/admin')->as('admin.')->group(function(){ // as('admin.') dùng để nối các tiếp các route vd muốn truy cập vài trang vai-tro-tai-khoan: admin.vai-tro-tai-khoan.danh-sach
    Route::get('index',[HomeAdminController::class,'homeAdmin'])->name('index');
    Route::prefix('/vai-tro-tai-khoan')->as('vai-tro-tai-khoan.')->group(function() {
        Route::get('/danh-sach', [AdminVaiTroTaiKhoanComtroller::class, 'danhSachVaiTroTaiKhoan'])->name('danh-sach');
        Route::get('/trang-them', [AdminVaiTroTaiKhoanComtroller::class, 'hienThiTrangThemVaiTroTaiKhoan'])->name('trang-them');
        Route::post('/them', [AdminVaiTroTaiKhoanComtroller::class, 'themVaiTroTaiKhoan'])->name('them');
        Route::get('/trang-sua/{id}', [AdminVaiTroTaiKhoanComtroller::class, 'hienThiTrangSuaVaiTroTaiKhoan'])->name('trang-sua');
        Route::post('/sua/{id}', [AdminVaiTroTaiKhoanComtroller::class, 'suaVaiTroTaiKhoan'])->name('sua');
    });
});
