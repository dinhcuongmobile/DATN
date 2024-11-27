<?php

namespace App\Http\Controllers\Admin\DonHang;

use Exception;
use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DonHangAdminController extends Controller
{
    // Hiển thị danh sách tất cả đơn hàng
    public function showDSDonHang(Request $request)
    {
        $query = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->whereIn('trang_thai', [0, 1, 2, 3, 4, 5]);

        // Tìm kiếm theo mã đơn hàng hoặc tên khách hàng
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ma_don_hang', 'LIKE', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('ho_va_ten', 'LIKE', "%$search%");
                  });
            });
        }

        $donHangs = $query->MoiNhat()->get();
        return view('admin.donHang.DSDonHang', compact('donHangs'));
    }

    // Hiển thị danh sách đơn hàng chờ duyệt
    public function showDSKiemDuyet(Request $request) {
        $query = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->where('trang_thai', 0);

        // Tìm kiếm theo mã đơn hàng hoặc tên khách hàng
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ma_don_hang', 'LIKE', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('ho_va_ten', 'LIKE', "%$search%");
                  });
            });
        }

        $donHangs = $query->MoiNhat()->get();
        return view('admin.donHang.kiemDuyet', compact('donHangs'));
    }

    
    // Hiển thị danh sách đơn hàng chờ lấy hàng
    public function showDSChoLayHang(Request $request)
    {
        $query = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->where('trang_thai', 1);

        // Tìm kiếm theo mã đơn hàng hoặc tên khách hàng
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ma_don_hang', 'LIKE', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('ho_va_ten', 'LIKE', "%$search%");
                  });
            });
        }

        $donHangs = $query->MoiNhat()->get();
        return view('admin.donHang.choLayHang', compact('donHangs'));
    }

    // Hiển thị danh sách đơn hàng đang giao
    public function showDSDangGiao(Request $request)
    {
        $query = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->where('trang_thai', 2);

        // Tìm kiếm theo mã đơn hàng hoặc tên khách hàng
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ma_don_hang', 'LIKE', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('ho_va_ten', 'LIKE', "%$search%");
                  });
            });
        }

        $donHangs = $query->MoiNhat()->get();
        return view('admin.donHang.DSDangGiao', compact('donHangs'));
    }

    // Hiển thị danh sách đơn hàng đã giao
    public function showDSDaGiao(Request $request)
    {
        $query = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->where('trang_thai', 3);

        // Tìm kiếm theo mã đơn hàng hoặc tên khách hàng
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ma_don_hang', 'LIKE', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('ho_va_ten', 'LIKE', "%$search%");
                  });
            });
        }

        $donHangs = $query->MoiNhat()->get();
        return view('admin.donHang.DSDaGiao', compact('donHangs'));
    }
    
    // Hiển thị danh sách đơn hàng đã hủy
    public function showDSDaHuy(Request $request) {
        $donHangs = DonHang::where('trang_thai', 4)
        ->MoiNhat()
        ->get(); // 4 là trạng thái "Đã Hủy"
        return view('admin.donHang.DSDaHuy', compact('donHangs'));
    }

    // Duyệt đơn hàng - Chuyển trạng thái đơn hàng sang chờ lấy hàng
    public function duyetDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = 1; // 1 là trạng thái chờ lấy hàng
        $donHang->save();
    
        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('success', 'Đơn hàng đã được duyệt và chuyển sang trạng thái chờ lấy hàng');
    }
    // Duyệt nhiều đơn hàng đã chọn
    public function duyetNhieuDonHang(Request $request)
    {
      $ids = $request->input('select', []);
    if (empty($ids)) {
        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('error', 'Vui lòng chọn ít nhất một đơn hàng.');
    }

     DB::beginTransaction();
      try {
        // Cập nhật trạng thái hàng loạt
        DonHang::whereIn('id', $ids)->update(['trang_thai' => 1]); // 1: Chờ lấy hàng

        DB::commit();
        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('success', 'Các đơn hàng đã được duyệt thành công.');
      } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
     }
    }

     // Xử lý yêu cầu lấy hàng cho một đơn hàng
     public function yeuCauLayHangDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = 2; // 2 là trạng thái Đang Giao
        $donHang->save();

        return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('success', 'Đơn hàng đã được chuyển sang trạng thái Đang Giao.');
    }

    // Xử lý giao hàng cho các đơn hàng đã chọn
    public function giaoNhieuDonHang(Request $request)
{
    $ids = $request->input('select', []);
    if (empty($ids)) {
        return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('error', 'Vui lòng chọn ít nhất một đơn hàng.');
    }

    DB::beginTransaction();
    try {
        // Cập nhật trạng thái hàng loạt
        DonHang::whereIn('id', $ids)->update(['trang_thai' => 2]); // 2: Đang Giao

        DB::commit();
        return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('success', 'Các đơn hàng đã được chuyển sang trạng thái Đang Giao.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
    }
}
 
    // Hiển thị chi tiết đơn hàng
    public function showChiTietDonHang($id)
    {
        $donHang = DonHang::with(['chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])->findOrFail($id);
        $tongTienSanPham = $donHang->chiTietDonHangs->sum('thanh_tien');

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
        return view('admin.donHang.hoaDon');
    }
    //In Hàng Loạt 
    public function inHoaDonHangLoat()
    {
        return view('admin.donHang.inHoaDonHangLoat');
    }

    // Hủy đơn hàng
    public function huyDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = 4; // 5 là trạng thái Đã Hủy
        $donHang->save();
    
        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('success', 'Đơn hàng đã được hủy thành công.');
    }

}
