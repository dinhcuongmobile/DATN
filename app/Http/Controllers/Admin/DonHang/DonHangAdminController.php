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
        $donHangs = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->whereIn('trang_thai', [0, 1, 2, 3, 4, 5]) // Lấy tất cả các trạng thái đơn hàng
            ->get();
        return view('admin.donHang.DSDonHang', compact('donHangs'));
    }
    
    
    // Hiển thị danh sách đơn hàng chờ lấy hàng
    public function showDSChoLayHang() {
        $donHangs = DonHang::where('trang_thai', 2)->get(); // 2 là trạng thái chờ lấy hàng
        return view('admin.donHang.choLayHang', compact('donHangs'));

    }

    // Hiển thị danh sách đang giao
    public function showDSDangGiao() {
        $donHangs = DonHang::where('trang_thai', 3)->get(); //3 là trạng thái đang giao
        return view('admin.donHang.DSDangGiao', compact('donHangs'));
    }
    
    
    // Hiển thị danh sách đơn hàng đã giao
    public function showDSDaGiao() {
        $donHangs = DonHang::where('trang_thai', 4)->get(); //4 là trang thái đã giao
        return view('admin.donHang.DSDaGiao', compact('donHangs'));
    }
    

    // Hiển thị danh sách đơn hàng đã hủy
    public function showDSDaHuy() {
        $donHangs = DonHang::where('trang_thai', 5)->get(); // 5 là trạng thái "Đã Hủy"
        return view('admin.donHang.DSDaHuy', compact('donHangs'));
    }

    // Hiển thị danh sách đơn hàng chờ duyệt
    public function showDSKiemDuyet() {
        $donHangs = DonHang::where('trang_thai', 0)->get(); // 0 là trạng thái chưa duyệt
        return view('admin.donHang.kiemDuyet', compact('donHangs'));
    }

    // Duyệt đơn hàng - Chuyển trạng thái đơn hàng sang chờ lấy hàng
    public function duyetDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = 2; // 2 là trạng thái chờ lấy hàng
        $donHang->save();
    
        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('success', 'Đơn hàng đã được duyệt và chuyển sang trạng thái chờ lấy hàng');
    }

     // Xử lý yêu cầu lấy hàng cho một đơn hàng
     public function yeuCauLayHangDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = 3; // 3 là trạng thái Đang Giao
        $donHang->save();

        return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('success', 'Đơn hàng đã được chuyển sang trạng thái Đang Giao.');
    }

    // Xử lý giao hàng cho các đơn hàng đã chọn
    public function giaoNhieuDonHang(Request $request) {
        $ids = $request->input('select', []);
        DonHang::whereIn('id', $ids)->update(['trang_thai' => 3]); // 3 là trạng thái Đang Giao

        return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('success', 'Các đơn hàng đã được chuyển sang trạng thái Đang Giao.');
    }
    public function daGiao(int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = 4; // 4 là trạng thái đã giao
        $donHang->save();
    
        return redirect()->route('don-hang.danh-sach-dang-giao')->with('success', 'Đơn hàng đã được giao ');
    }
    
    // Hiển thị chi tiết đơn hàng
    public function showChiTietDonHang($id)
    {
        // Lấy thông tin đơn hàng và các chi tiết liên quan
        $donHang = DonHang::with(['chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])->findOrFail($id);

        // Tính tổng tiền sản phẩm từ chi tiết đơn hàng
        $tongTienSanPham = $donHang->chiTietDonHangs->sum('thanh_tien');

        // Truyền dữ liệu qua view
        return view('admin.donHang.chiTietDonHang', [
            'donHang' => $donHang,
            'tongTienSanPham' => $tongTienSanPham,
            'phiVanChuyen' => $donHang->giam_gia_van_chuyen,
            'giamGiaDonHang' => $donHang->giam_gia_don_hang,
            'tongThanhToan' => $donHang->tong_thanh_toan
        ]);
    }

    // In hóa đơn
    public function inHoaDon($id) {
        $donHang = DonHang::findOrFail($id);
        return view('admin.donHang.hoaDon', compact('donHang'));
    }

    // Hủy đơn hàng
    public function huyDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = 5; // 5 là trạng thái Đã Hủy
        $donHang->save();
    
        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('success', 'Đơn hàng đã được hủy thành công.');
    }


    // Hiển thị form cập nhật đơn hàng
    public function showCapNhatDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        return view('admin.donHang.update', compact('donHang'));
    }

    // Cập nhật trạng thái đơn hàng
    public function capNhatDonHang(Request $request, int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = $request->trang_thai;
        $donHang->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    // Duyệt nhiều đơn hàng
    public function duyetNhieuDonHang(Request $request) {
        if (!empty($ids)) {
        $ids = $request->input('select', []);
        DonHang::whereIn('id', $ids)->update(['trang_thai' => 2]); // 2 là trạng thái chờ lấy hàng
        }
        return redirect()->back()->with('success', 'Các đơn hàng đã được chuyển sang trạng thái chờ lấy hàng.');
    }
}
