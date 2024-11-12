<?php

namespace App\Http\Controllers\Admin\DonHang;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Http\Controllers\Controller;

class DonHangAdminController extends Controller
{
    
    

    // Hiển thị danh sách đơn hàng
    public function showDSDonHang() {
       
        return view('admin.donHang.DSDonHang', );
    }

    // Hiển thị danh sách đơn hàng đã giao
    public function showDSDaGiao() {
     
        return view('admin.donHang.DSDaGiao');
    }

    // Hiển thị danh sách đơn hàng đã hủy
    public function showDSDaHuy() {
        
        return view('admin.donHang.DSDaHuy');
    }

    // Hiển thị danh sách đơn hàng chờ kiểm duyệt
    public function showDSKiemDuyet() {
       
        return view('admin.donHang.kiemDuyet');
    }

    //Hiển thị chờ lấy hàng
    public function showDSChoLayHang(){
        return view('admin.donHang.choLayHang');
    }
    // Hiển thị chi tiết đơn hàng
    public function showChiTietDonHang($id) {
        return view('admin.donHang.chiTietDonHang');
    }

    // In hóa đơn
    public function inHoaDon($id) {
        return view('admin.donHang.hoaDon');
    }

    // Hủy đơn hàng
    public function huyDonHang(int $id) {
    }

    // Duyệt đơn hàng
    public function duyetDonHang(int $id) {
    
    }

    // Hiển thị form cập nhật đơn hàng
    public function showCapNhatDonHang(int $id) {

        return view('admin.donHang.update');
    }

    // Cập nhật trạng thái đơn hàng
    public function capNhatDonHang(Request $request, int $id) {

    }

    // Duyệt nhiều đơn hàng
    public function duyetNhieuDonHang(Request $request) {
       
    }
}
