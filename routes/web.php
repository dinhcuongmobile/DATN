<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Location\LocationController;
use App\Http\Controllers\Client\LienHe\LienHeController;
use App\Http\Controllers\Client\TinTuc\TinTucController;
use App\Http\Controllers\Client\GioHang\GioHangController;
use App\Http\Controllers\Client\SanPham\SanPhamController;
use App\Http\Controllers\Admin\TinTuc\AdminTinTucController;
use App\Http\Controllers\Client\TaiKhoan\TaiKhoanController;
use App\Http\Controllers\Admin\DanhMuc\DanhMucAdminController;
use App\Http\Controllers\Admin\SanPham\SanPhamAdminController;
use App\Http\Controllers\Client\GioiThieu\GioiThieuController;
use App\Http\Controllers\Admin\TaiKhoan\TaiKhoanAdminController;


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
    Route::post('/', [LienHeController::class, 'store'])->name('lien-he.store');
});

Route::get('gioi-thieu',[GioiThieuController::class,'gioiThieu'])->name('gioi-thieu');


// admin
Route::prefix('admin')->group(function(){
    Route::get('index',[HomeAdminController::class,'homeAdmin'])->name('admin.index');

    //tai khoan
    Route::prefix('tai-khoan')->group(function(){
        Route::get('danh-sach-QTV', [TaiKhoanAdminController::class,'showTaiKhoanQTV'])->name('tai-khoan.danh-sach-QTV');
        Route::get('danh-sach-NV', [TaiKhoanAdminController::class,'showTaiKhoanNV'])->name('tai-khoan.danh-sach-NV');
        Route::put('select-khoa-TK', [TaiKhoanAdminController::class,'selectKhoaTK'])->name('tai-khoan.select-khoa-TK');
        Route::get('danh-sach-TV', [TaiKhoanAdminController::class,'showTaiKhoanTV'])->name('tai-khoan.danh-sach-TV');
        Route::get('danh-sach-TKK', [TaiKhoanAdminController::class,'showTaiKhoanTKK'])->name('tai-khoan.danh-sach-TKK');

        //add
        Route::get('them-tai-khoan', [TaiKhoanAdminController::class,'viewAdd'])->name('tai-khoan.them-tai-khoan');
        Route::post('add', [TaiKhoanAdminController::class,'add'])->name('tai-khoan.add');

        //update
        Route::get('sua-tai-khoan/{id}', [TaiKhoanAdminController::class,'viewUpdate'])->name('tai-khoan.sua-tai-khoan');
        Route::put('update/{id}', [TaiKhoanAdminController::class,'update'])->name('tai-khoan.update');
        Route::get('khoa-tai-khoan/{id}', [TaiKhoanAdminController::class,'khoaTaiKhoan'])->name('tai-khoan.khoa-tai-khoan');
        Route::get('mo-khoa-tai-khoan/{id}', [TaiKhoanAdminController::class,'moKhoaTaiKhoan'])->name('tai-khoan.mo-khoa-tai-khoan');
    });

    //Danh Muc
    Route::prefix('danh-muc')->group(function(){
        Route::get('danh-sach', [DanhMucAdminController::class,'showDanhSach'])->name('danh-muc.danh-sach');
        //add
        Route::get('them-danh-muc', [DanhMucAdminController::class,'viewAdd'])->name('danh-muc.them-danh-muc');
        Route::post('add', [DanhMucAdminController::class,'add'])->name('danh-muc.add');

        //update
        Route::get('sua-danh-muc/{id}', [DanhMucAdminController::class,'viewUpdate'])->name('danh-muc.sua-danh-muc');
        Route::put('update/{id}', [DanhMucAdminController::class,'update'])->name('danh-muc.update');

        //delete
        Route::get('delete/{id}', [DanhMucAdminController::class,'delete'])->name('danh-muc.delete');

        Route::post('xoa-nhieu', [DanhMucAdminController::class,'xoaNhieuDanhMuc'])->name('danh-muc.xoa-nhieu');

        Route::get('danh-sach-danh-muc-da-xoa', [DanhMucAdminController::class,'danhSachDanhMucDaXoa'])->name('danh-muc.danh-sach-danh-muc-da-xoa');

        Route::get('xoa-danh-muc-vinh-vien/{id}', [DanhMucAdminController::class,'xoaDanhMucVinhVien'])->name('danh-muc.xoa-danh-muc-vinh-vien');

        Route::post('xoa-nhieu-vinh-vien', [DanhMucAdminController::class,'xoaNhieuDanhMucVinhVien'])->name('danh-muc.xoa-nhieu-vinh-vien');

        Route::get('khoi-phuc-danh-muc/{id}', [DanhMucAdminController::class,'khoiPhucDanhMuc'])->name('danh-muc.khoi-phuc-danh-muc');

    });

    Route::prefix('san-pham')->group(function(){
        Route::get('danh-sach',[SanPhamAdminController::class, 'danhSachSanPham'])->name('san-pham.danh-sach');
    });

    Route::prefix('tin-tuc')->group(function(){
        Route::get('danh-sach', [AdminTinTucController::class,'showDanhSach'])->name('tin-tuc.danh-sach');

        //add
        Route::get('them-tin-tuc', [AdminTinTucController::class,'viewAdd'])->name('tin-tuc.them-tin-tuc');
        Route::post('add', [AdminTinTucController::class,'add'])->name('tin-tuc.add');

        //update
        Route::get('sua-tin-tuc/{id}', [AdminTinTucController::class,'viewUpdate'])->name('tin-tuc.sua-tin-tuc');
        Route::put('update/{id}', [AdminTinTucController::class,'update'])->name('tin-tuc.update');

        //delete
        Route::get('delete/{id}', [AdminTinTucController::class,'delete'])->name('tin-tuc.delete');
        Route::post('xoa-nhieu', [AdminTinTucController::class,'xoaNhieuTinTuc'])->name('tin-tuc.xoa-nhieu');
    });


});

Route::prefix('dia-chi')->group(function(){
    Route::get('quan-huyen/{matp}', [LocationController::class, 'showQuanHuyen'])->name('dia-chi.quan-huyen');
    Route::get('phuong-xa/{maqh}', [LocationController::class, 'showPhuongXa'])->name('dia-chi.phuong-xa');
});



