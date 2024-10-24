<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Location\LocationController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Auth\Admin\AuthAdminController;
use App\Http\Controllers\Client\LienHe\LienHeController;
use App\Http\Controllers\Client\TinTuc\TinTucController;
use App\Http\Controllers\Client\GioHang\GioHangController;
use App\Http\Controllers\Client\SanPham\SanPhamController;
use App\Http\Controllers\Admin\LienHe\LienHeAdminController;
use App\Http\Controllers\Admin\TinTuc\TinTucAdminController;

use App\Http\Controllers\Client\TaiKhoan\TaiKhoanController;
use App\Http\Controllers\Admin\DanhMuc\DanhMucAdminController;
use App\Http\Controllers\Admin\SanPham\SanPhamAdminController;
use App\Http\Controllers\Client\GioiThieu\GioiThieuController;
use App\Http\Controllers\Admin\TaiKhoan\TaiKhoanAdminController;
use App\Http\Controllers\Admin\TaiKhoan\ThongTinTaiKhoan\ThongTinTaiKhoanAdminController;
use App\Http\Controllers\Admin\DanhMucTinTuc\DanhMucTinTucAdminController;
use App\Http\Controllers\Client\TaiKhoan\ThongTinTaiKhoan\ThongTinTaiKhoanController;

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

// Client
Route::middleware('autoDangNhap', 'clientAuth')->prefix('/')->group(function(){
    Route::get('/', [HomeController::class, 'home'])->name('trang-chu.home');
    Route::get('/404', [HomeController::class, 'error404'])->name('404');
    Route::prefix('/tai-khoan')->group(function(){
        Route::get('/dang-ky',[TaiKhoanController::class,'showDangKy'])->name('tai-khoan.dang-ky')->middleware('checkUser');
        Route::post('/dang-ky',[TaiKhoanController::class,'dangKy'])->name('tai-khoan.dang-ky');
        Route::get('/verify-email/{token}', [TaiKhoanController::class, 'verifyEmail'])->name('tai-khoan.verify-email');
        Route::get('/gui-lai-email/{email}', [TaiKhoanController::class, 'guiLaiEmail'])->name('tai-khoan.gui-lai-email');

        Route::get('/dang-nhap',[TaiKhoanController::class,'showDangNhap'])->name('tai-khoan.dang-nhap')->middleware('checkUser');
        Route::post('/dang-nhap',[TaiKhoanController::class,'dangNhap'])->name('tai-khoan.dang-nhap');

        Route::get('/quen-mat-khau',[TaiKhoanController::class,'showQuenMatKhau'])->name('tai-khoan.quen-mat-khau');
        Route::post('/quen-mat-khau/gui-otp',[TaiKhoanController::class,'guiOtp'])->name('tai-khoan.gui-otp');
        Route::post('/quen-mat-khau/gui-lai-otp',[TaiKhoanController::class,'guiLaiOtp'])->name('tai-khoan.gui-lai-otp');
        Route::get('/show-form-otp', [TaiKhoanController::class, 'showFormOtp'])->name('tai-khoan.form-otp');
        Route::post('/verify-otp', [TaiKhoanController::class, 'verifyOtp'])->name('tai-khoan.verify-otp');
        Route::get('/dat-lai-mat-khau', [TaiKhoanController::class, 'showDatLaiMatKhau'])->name('tai-khoan.dat-lai-mat-khau');
        Route::post('/dat-lai-mat-khau', [TaiKhoanController::class, 'datLaiMatKhau'])->name('tai-khoan.dat-lai-mat-khau');

        Route::get('/thong-tin-tai-khoan',[ThongTinTaiKhoanController::class,'showThongTinTaiKhoan'])
            ->name('tai-khoan.thong-tin-tai-khoan')->middleware('auth');
        Route::put('/cap-nhat-thong-tin-tai-khoan', [ThongTinTaiKhoanController::class, 'updateThongTinTaiKhoan'])
            ->name('tai-khoan.cap-nhat-thong-tin-tai-khoan')->middleware('auth');

        Route::post('/doi-mat-khau', [ThongTinTaiKhoanController::class, 'doiMatKhau'])
            ->name('tai-khoan.doi-mat-khau')->middleware('auth');

        Route::get('/dang-xuat', [TaiKhoanController::class, 'dangXuat'])->name('tai-khoan.dang-xuat');
    });

    Route::prefix('san-pham')->group(function () {
        Route::get('/', [SanPhamController::class, 'sanPham'])->name('san-pham.san-pham');
        Route::get('san-pham-danh-muc', [SanPhamController::class, 'sanPhamDanhMuc'])->name('san-pham.san-pham-danh-muc');
        Route::get('chi-tiet-san-pham/{id}', [SanPhamController::class, 'chiTietSanPham'])->name('san-pham.chi-tiet-san-pham');
        Route::get('so-luong-ton-kho', [SanPhamController::class, 'soLuongTonKho'])->name('san-pham.so-luong-ton-kho');

        Route::get('/filter', [SanPhamController::class, 'filterSanPham'])->name('san-pham.filter');
    });

    Route::prefix('gio-hang')->group(function () {
        Route::get('/', [GioHangController::class, 'gioHang'])->name('gio-hang.gio-hang');
        Route::get('chi-tiet-thanh-toan', [GioHangController::class, 'chiTietThanhToan'])->name('gio-hang.chi-tiet-thanh-toan');
    });

    Route::prefix('tin-tuc')->group(function () {
        Route::get('/', [TinTucController::class, 'tinTuc'])->name('tin-tuc.tin-tuc');
        Route::get('/chi-tiet-tin-tuc', [TinTucController::class, 'chiTietTinTuc'])->name('tin-tuc.chi-tiet-tin-tuc');
        Route::get('/tin-tuc-danh-muc', [TinTucController::class, 'tinTucDanhMuc'])->name('tin-tuc.tin-tuc-danh-muc');
    });

    Route::prefix('/lien-he')->group(function () {
        Route::get('/', [LienHeController::class, 'lienHe'])->name('lien-he.lien-he');
        Route::post('/gui-lien-he', [LienHeController::class, 'guiLienHe'])->name('lien-he.gui-lien-he');
    });

    Route::get('gioi-thieu', [GioiThieuController::class, 'gioiThieu'])->name('gioi-thieu');
});

// Đăng nhập admin
Route::prefix('/auth-admin')->group(function(){
    Route::get('/dang-nhap-admin', [AuthAdminController::class, 'showDangNhapAdmin'])->name('auth.dang-nhap-admin')->middleware('checkUserAdmin:admin');
    Route::post('/dang-nhap-admin', [AuthAdminController::class, 'dangNhapAdmin'])->name('auth.dang-nhap-admin');

    Route::get('/quen-mat-khau-admin', [AuthAdminController::class, 'showQuenMatKhau'])->name('auth.quen-mat-khau-admin');
    Route::post('/gui-otp-admin', [AuthAdminController::class, 'guiOtp'])->name('auth.gui-otp-admin');
    Route::post('/gui-lai-otp-admin', [AuthAdminController::class, 'guiLaiOtp'])->name('auth.gui-lai-otp-admin');
    Route::get('/form-otp-admin', [AuthAdminController::class, 'showFormOtp'])->name('auth.form-otp-admin');
    Route::post('/verify-otp-admin', [AuthAdminController::class, 'verifyOtp'])->name('auth.verify-otp-admin');
    Route::get('/dat-lai-mat-khau-admin', [AuthAdminController::class, 'showDatLaiMatKhau'])->name('auth.dat-lai-mat-khau-admin');
    Route::post('/dat-lai-mat-khau-admin', [AuthAdminController::class, 'datLaiMatKhau'])->name('auth.dat-lai-mat-khau-admin');

    Route::get('/dang-xuat-admin', [AuthAdminController::class, 'dangXuatAdmin'])->name('auth.dang-xuat-admin');
});


// admin
Route::middleware('adminAuth:admin')->prefix('admin')->group(function () {
    Route::get('index', [HomeAdminController::class, 'homeAdmin'])->name('admin.index');

    //tai khoan
    Route::prefix('tai-khoan')->group(function () {
        Route::get('danh-sach-QTV', [TaiKhoanAdminController::class, 'showTaiKhoanQTV'])->name('tai-khoan.danh-sach-QTV');
        Route::get('danh-sach-NV', [TaiKhoanAdminController::class, 'showTaiKhoanNV'])->name('tai-khoan.danh-sach-NV');
        Route::put('select-khoa-TK', [TaiKhoanAdminController::class, 'selectKhoaTK'])->name('tai-khoan.select-khoa-TK');
        Route::get('danh-sach-TV', [TaiKhoanAdminController::class, 'showTaiKhoanTV'])->name('tai-khoan.danh-sach-TV');
        Route::get('danh-sach-TKK', [TaiKhoanAdminController::class, 'showTaiKhoanTKK'])->name('tai-khoan.danh-sach-TKK');

        //add
        Route::get('them-tai-khoan', [TaiKhoanAdminController::class, 'viewAdd'])->name('tai-khoan.them-tai-khoan');
        Route::post('add', [TaiKhoanAdminController::class, 'add'])->name('tai-khoan.add');

        //update
        Route::get('sua-tai-khoan/{id}', [TaiKhoanAdminController::class, 'viewUpdate'])->name('tai-khoan.sua-tai-khoan');
        Route::put('update/{id}', [TaiKhoanAdminController::class, 'update'])->name('tai-khoan.update');
        Route::get('khoa-tai-khoan/{id}', [TaiKhoanAdminController::class, 'khoaTaiKhoan'])->name('tai-khoan.khoa-tai-khoan');
        Route::get('mo-khoa-tai-khoan/{id}', [TaiKhoanAdminController::class, 'moKhoaTaiKhoan'])->name('tai-khoan.mo-khoa-tai-khoan');

        // Thông tin tài khoản
        Route::get('/thong-tin-tai-khoan-admin', [ThongTinTaiKhoanAdminController::class, 'showThongTinTaiKhoanAdmin'])
            ->name('tai-khoan.thong-tin-tai-khoan-admin');
        Route::put('/cap-nhat-thong-tin-tai-khoan-admin', [ThongTinTaiKhoanAdminController::class, 'updateThongTinTaiKhoanAdmin'])
            ->name('tai-khoan.cap-nhat-thong-tin-tai-khoan-admin');
        Route::post('/doi-mat-khau-admin', [ThongTinTaiKhoanAdminController::class, 'doiMatKhauAdmin'])
            ->name('tai-khoan.doi-mat-khau-admin');
    });

    //Danh Muc
    Route::prefix('danh-muc')->group(function () {
        Route::get('danh-sach', [DanhMucAdminController::class, 'showDanhSach'])->name('danh-muc.danh-sach');
        Route::get('danh-sach-danh-muc-san-pham/{id}',[DanhMucAdminController::class, 'danhMucSanPham'])->name('san-pham.danh-sach-danh-muc-san-pham');
        //add
        Route::get('them-danh-muc', [DanhMucAdminController::class, 'viewAdd'])->name('danh-muc.them-danh-muc');
        Route::post('add', [DanhMucAdminController::class, 'add'])->name('danh-muc.add');

        //update
        Route::get('sua-danh-muc/{id}', [DanhMucAdminController::class, 'viewUpdate'])->name('danh-muc.sua-danh-muc');
        Route::put('update/{id}', [DanhMucAdminController::class, 'update'])->name('danh-muc.update');

        //delete
        Route::get('delete/{id}', [DanhMucAdminController::class, 'delete'])->name('danh-muc.delete');

        Route::post('xoa-nhieu', [DanhMucAdminController::class, 'xoaNhieuDanhMuc'])->name('danh-muc.xoa-nhieu');

        Route::get('danh-sach-danh-muc-da-xoa', [DanhMucAdminController::class, 'danhSachDanhMucDaXoa'])->name('danh-muc.danh-sach-danh-muc-da-xoa');

        Route::get('xoa-danh-muc-vinh-vien/{id}', [DanhMucAdminController::class, 'xoaDanhMucVinhVien'])->name('danh-muc.xoa-danh-muc-vinh-vien');

        Route::post('xoa-nhieu-vinh-vien', [DanhMucAdminController::class, 'xoaNhieuDanhMucVinhVien'])->name('danh-muc.xoa-nhieu-vinh-vien');

        Route::get('khoi-phuc-danh-muc/{id}', [DanhMucAdminController::class, 'khoiPhucDanhMuc'])->name('danh-muc.khoi-phuc-danh-muc');
    });

    Route::prefix('san-pham')->group(function(){
        Route::get('danh-sach',[SanPhamAdminController::class, 'danhSachSanPham'])->name('san-pham.danh-sach');
        Route::get('san-pham-bien-the/{san_pham_id}',[SanPhamAdminController::class, 'loadOneSanPham'])->name('san-pham.san-pham-bien-the');
        Route::get('danh-sach-bien-the-san-pham',[SanPhamAdminController::class, 'danhSachBienThe'])->name('san-pham.danh-sach-bien-the-san-pham');
        Route::get('quan-ly-size',[SanPhamAdminController::class, 'danhSachSize'])->name('san-pham.quan-ly-size');
        Route::get('quan-ly-mau-sac',[SanPhamAdminController::class, 'danhSachMauSac'])->name('san-pham.quan-ly-mau-sac');
        Route::get('bien-the-san-pham/{san_pham_id}',[SanPhamAdminController::class, 'loadBienTheOneSanPham'])->name('san-pham.bien-the-san-pham');
        Route::get('danh-sach-ma-khuyen-mai',[SanPhamAdminController::class, 'danhSachMaKhuyenMai'])->name('san-pham.danh-sach-ma-khuyen-mai');
        Route::get('khuyen-mai-san-pham/{san_pham_id}',[SanPhamAdminController::class, 'loadKhuyenMaiOneSanPham'])->name('san-pham.khuyen-mai-san-pham');
        Route::get('san-pham-ma-khuyen-mai/{san_pham_id}',[SanPhamAdminController::class, 'loadOneSanPham'])->name('san-pham.san-pham-ma-khuyen-mai');
        Route::get('danh-sach-san-pham-da-xoa',[SanPhamAdminController::class, 'danhSachDaXoa'])->name('san-pham.danh-sach-san-pham-da-xoa');
        Route::get('danh-sach-san-pham-danh-muc/{danh_muc_id}',[SanPhamAdminController::class, 'sanPhamDanhMuc'])->name('san-pham.danh-sach-san-pham-danh-muc');

        //add
        Route::get('show-them-san-pham',[SanPhamAdminController::class, 'showThemSanPham'])->name('san-pham.show-them-san-pham');
        Route::post('them-san-pham',[SanPhamAdminController::class, 'themSanPham'])->name('san-pham.them-san-pham');

        Route::get('show-them-size',[SanPhamAdminController::class, 'showThemSize'])->name('san-pham.show-them-size');
        Route::post('them-size',[SanPhamAdminController::class, 'themSize'])->name('san-pham.them-size');

        Route::get('show-them-mau-sac',[SanPhamAdminController::class, 'showThemMauSac'])->name('san-pham.show-them-mau-sac');
        Route::post('them-mau-sac',[SanPhamAdminController::class, 'themMauSac'])->name('san-pham.them-mau-sac');

        Route::get('show-them-bien-the-san-pham',[SanPhamAdminController::class, 'showThemBienThe'])->name('san-pham.show-them-bien-the-san-pham');
        Route::post('them-bien-the-san-pham',[SanPhamAdminController::class, 'themBienThe'])->name('san-pham.them-bien-the-san-pham');

        Route::get('show-them-ma-khuyen-mai',[SanPhamAdminController::class, 'showThemMaKhuyenMai'])->name('san-pham.show-them-ma-khuyen-mai');
        Route::post('them-ma-khuyen-mai',[SanPhamAdminController::class, 'themMaKhuyenMai'])->name('san-pham.them-ma-khuyen-mai');

        //update
        Route::get('show-sua-san-pham/{id}',[SanPhamAdminController::class, 'showSuaSanPham'])->name('san-pham.show-sua-san-pham');
        Route::put('sua-san-pham/{id}',[SanPhamAdminController::class, 'suaSanPham'])->name('san-pham.sua-san-pham');

        Route::get('show-sua-bien-the-san-pham/{id}',[SanPhamAdminController::class, 'showSuaBienThe'])->name('san-pham.show-sua-bien-the-san-pham');
        Route::put('sua-bien-the-san-pham/{id}',[SanPhamAdminController::class, 'suaBienThe'])->name('san-pham.sua-bien-the-san-pham');

        Route::get('show-sua-ma-khuyen-mai/{id}',[SanPhamAdminController::class, 'ShowSuaMaKhuyenMai'])->name('san-pham.show-sua-ma-khuyen-mai');
        Route::put('sua-ma-khuyen-mai/{id}',[SanPhamAdminController::class, 'suaMaKhuyenMai'])->name('san-pham.sua-ma-khuyen-mai');

        //delete
        Route::get('xoa-san-pham/{id}',[SanPhamAdminController::class, 'xoaSanPham'])->name('san-pham.xoa-san-pham');
        Route::post('xoa-nhieu-san-pham',[SanPhamAdminController::class, 'xoaNhieuSanPham'])->name('san-pham.xoa-nhieu-san-pham');

        Route::get('xoa-bien-the-san-pham/{id}',[SanPhamAdminController::class, 'xoaBienThe'])->name('san-pham.xoa-bien-the-san-pham');
        Route::post('xoa-nhieu-bien-the-san-pham',[SanPhamAdminController::class, 'xoaNhieuBienThe'])->name('san-pham.xoa-nhieu-bien-the-san-pham');

        Route::get('xoa-size/{id}',[SanPhamAdminController::class, 'xoaSize'])->name('san-pham.xoa-size');

        Route::get('xoa-mau-sac/{id}',[SanPhamAdminController::class, 'xoaMauSac'])->name('san-pham.xoa-mau-sac');

        Route::get('xoa-ma-khuyen-mai/{id}',[SanPhamAdminController::class, 'xoaKhuyenMai'])->name('san-pham.xoa-ma-khuyen-mai');
        Route::post('xoa-nhieu-ma-khuyen-mai',[SanPhamAdminController::class, 'xoaNhieuKhuyenMai'])->name('san-pham.xoa-nhieu-ma-khuyen-mai');

        Route::get('xoa-san-pham-vinh-vien/{id}', [SanPhamAdminController::class, 'xoaSanPhamVinhVien'])->name('san-pham.xoa-san-pham-vinh-vien');

        Route::post('xoa-nhieu-san-pham-vinh-vien', [SanPhamAdminController::class, 'xoaNhieuSanPhamVinhVien'])->name('san-pham.xoa-nhieu-san-pham-vinh-vien');

        Route::get('khoi-phuc-san-pham/{id}', [SanPhamAdminController::class, 'khoiPhucSanPham'])->name('san-pham.khoi-phuc-san-pham');
    });
    Route::prefix('danh-muc-tin-tuc')->group(function () {
        Route::get('danh-sach-danh-muc', [DanhMucTinTucAdminController::class, 'showDanhSach'])->name('danh-muc-tin-tuc.danh-sach');

        //add
        Route::get('them-danh-muc-tin-tuc', [DanhMucTinTucAdminController::class, 'viewAdd'])->name('danh-muc-tin-tuc.them-danh-muc-tin-tuc');
        Route::post('add', [DanhMucTinTucAdminController::class, 'add'])->name('danh-muc-tin-tuc.add');

        //update
        Route::get('danh-muc-tin-tuc/{id}', [DanhMucTinTucAdminController::class, 'viewUpdate'])->name('danh-muc-tin-tuc.danh-muc');
        Route::put('update/{id}', [DanhMucTinTucAdminController::class, 'update'])->name('danh-muc-tin-tuc.update');

        //delete
        Route::get('delete/{id}', [DanhMucTinTucAdminController::class, 'delete'])->name('danh-muc-tin-tuc.delete');
        Route::post('xoa-nhieu', [DanhMucTinTucAdminController::class, 'xoaNhieuTinTuc'])->name('danh-muc-tin-tuc.xoa-nhieu');

        Route::get('danh-sach-danh-muc-tin-tuc-da-xoa', [DanhMucTinTucAdminController::class, 'danhSachDanhMucDaXoa'])->name('danh-muc-tin-tuc.danh-sach-danh-muc-da-xoa');

        Route::get('xoa-danh-muc-vinh-vien/{id}', [DanhMucTinTucAdminController::class, 'xoaDanhMucVinhVien'])->name('danh-muc-tin-tuc.xoa-danh-muc-vinh-vien');

        Route::post('xoa-nhieu-vinh-vien', [DanhMucTinTucAdminController::class, 'xoaNhieuDanhMucVinhVien'])->name('danh-muc-tin-tuc.xoa-nhieu-vinh-vien');

        Route::get('khoi-phuc-danh-muc/{id}', [DanhMucTinTucAdminController::class, 'khoiPhucDanhMuc'])->name('danh-muc-tin-tuc.khoi-phuc-danh-muc');
    });
    Route::prefix('tin-tuc')->group(function () {
        Route::get('danh-sach', [TinTucAdminController::class, 'showDanhSach'])->name('tin-tuc.danh-sach');

        //add
        Route::get('them-tin-tuc', [TinTucAdminController::class, 'viewAdd'])->name('tin-tuc.them-tin-tuc');
        Route::post('add', [TinTucAdminController::class, 'add'])->name('tin-tuc.add');

        //update
        Route::get('sua-tin-tuc/{id}', [TinTucAdminController::class, 'viewUpdate'])->name('tin-tuc.sua-tin-tuc');
        Route::put('update/{id}', [TinTucAdminController::class, 'update'])->name('tin-tuc.update');

        //delete
        Route::get('delete/{id}', [TinTucAdminController::class, 'delete'])->name('tin-tuc.delete');
        Route::post('xoa-nhieu', [TinTucAdminController::class, 'xoaNhieuTinTuc'])->name('tin-tuc.xoa-nhieu');
    });

    // Banner
    Route::prefix('banner')->group(function () {
        Route::get('danh-sach', [BannerController::class, 'danhSachBanner'])->name('banner.dsBanner');
        // Thêm
        Route::get('view-them-banner', [BannerController::class, 'viewAdd'])->name('banner.viewAdd');
        Route::post('store-banner', [BannerController::class, 'storeAdd'])->name('banner.storeBanner');
        // Cập nhật
        Route::get('view-update-banner/{id}', [BannerController::class, 'viewUpdate'])->name('banner.updatebanner');
        Route::post('update/{id}', [BannerController::class, 'Update'])->name('banner.update');
        // Xóa
        Route::get('xoa-banner/{id}', [BannerController::class, 'Delete'])->name('banner.delete');
        Route::post('xoa-nhieu-banner', [BannerController::class, 'deleteAll'])->name('banner.deleteAll');
    });

    Route::prefix('lienHe')->group(function (){
        Route::get('danh-sach',[LienHeAdminController::class,'dsLienHe'])->name('lienhe.dsLienHe');
        Route::put('phan-hoi/{id}', [LienHeAdminController::class, 'phanHoi'])->name('lienhe.phanHoi');
        Route::get('danh-sach-da-phan-hoi', [LienHeAdminController::class, 'dsLienHeDaPhanHoi'])->name('lienhe.dsLienHeDaPhanHoi');
        Route::get('danh-sach-chua-phan-hoi', [LienHeAdminController::class, 'dsLienHeChuaPhanHoi'])->name('lienhe.dsLienHeChuaPhanHoi');


    });
});

// dia chỉ
Route::prefix('dia-chi')->group(function () {
    Route::get('quan-huyen/{matp}', [LocationController::class, 'showQuanHuyen'])->name('dia-chi.quan-huyen');
    Route::get('phuong-xa/{maqh}', [LocationController::class, 'showPhuongXa'])->name('dia-chi.phuong-xa');
});
