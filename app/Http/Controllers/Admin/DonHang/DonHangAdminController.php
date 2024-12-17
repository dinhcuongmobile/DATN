<?php

namespace App\Http\Controllers\Admin\DonHang;

use Exception;
use Carbon\Carbon;
use App\Models\DiaChi;
use App\Models\BienThe;
use App\Models\DonHang;
use App\Models\PhiShip;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonHangAdminController extends Controller
{
    // Hiển thị danh sách tất cả đơn hàng
    public function showDSDonHang(Request $request)
    {
        $query = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->whereIn('trang_thai', [0, 1, 2, 3, 4]);

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

        $donHangs = $query->orderBy('ngay_cap_nhat', 'desc')->get();
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

        $donHangs = $query->orderBy('ngay_cap_nhat', 'desc')->get();
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

        $donHangs = $query->orderBy('ngay_cap_nhat', 'desc')->get();
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

        $donHangs = $query->orderBy('ngay_cap_nhat', 'desc')->get();
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

        $donHangs = $query->orderBy('ngay_cap_nhat', 'desc')->get();
        return view('admin.donHang.DSDaGiao', compact('donHangs'));
    }

    // Hiển thị danh sách đơn hàng đã hủy
    public function showDSDaHuy(Request $request) {
        $query = DonHang::where('trang_thai', 4);
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ma_don_hang', 'LIKE', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('ho_va_ten', 'LIKE', "%$search%");
                  });
            });
        }
        $donHangs = $query->orderBy('ngay_cap_nhat', 'desc')->get();
        return view('admin.donHang.DSDaHuy', compact('donHangs'));
    }
    // Hiển thị danh sách đơn hàng đã chuyển khoản
    public function showDSDaChuyenKhoan(Request $request)
    {
        $query = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->where('phuong_thuc_thanh_toan', 1) // Chuyển khoản
            ->where('thanh_toan', 1); // Đã thanh toán
        // Lọc theo mã đơn hàng nếu có
        if ($request->filled('ma_don_hang')) {
            $query->where('ma_don_hang', $request->input('ma_don_hang'));
        }
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

        $donHangs = $query->orderBy('ngay_cap_nhat', 'desc')->get();
        return view('admin.donHang.DSDaChuyenKhoan', compact('donHangs'));
    }

    // Duyệt đơn hàng - Chuyển trạng thái đơn hàng sang chờ lấy hàng
    public function duyetDonHang(int $id) {
        $donHang = DonHang::findOrFail($id);
        $chi_tiet_don_hangs = ChiTietDonHang::where('don_hang_id', $id)->get();

        foreach ($chi_tiet_don_hangs as $chi_tiet) {
            $bien_the = BienThe::find($chi_tiet->bien_the_id);

            if ($bien_the && $bien_the->so_luong_tam_giu >= $chi_tiet->so_luong) {
                $bien_the->decrement('so_luong', $chi_tiet->so_luong); // Trừ số lượng kho chính thức
                $bien_the->decrement('so_luong_tam_giu', $chi_tiet->so_luong); // Giảm tạm giữ
            } else {
                return redirect()->back()->with('error', 'Sản phẩm không đủ để xác nhận đơn hàng.');
            }
        }
        $donHang->trang_thai = 1; // 1 là trạng thái chờ lấy hàng
        $donHang->nguoi_ban = Auth::user()->id;
        $donHang->ngay_ban = Carbon::now();
        $donHang->save();

        ThongBao::create([
            'user_id' => $donHang->user_id,
            'tieu_de' => "Xác nhận đơn hàng",
            'noi_dung' => 'Đơn hàng ' . $donHang->ma_don_hang . ' đã được xác nhận.',
        ]);

        return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('success', 'Đơn hàng đã được duyệt và chuyển sang trạng thái chờ lấy hàng');
    }
    // Duyệt nhiều đơn hàng đã chọn
    public function duyetNhieuDonHang(Request $request){
      $ids = $request->input('select', []);
        if (empty($ids)) {
            return redirect()->route('don-hang.danh-sach-kiem-duyet')->with('error', 'Vui lòng chọn ít nhất một đơn hàng.');
        }

        DB::beginTransaction();
        try {
            $donHang = DonHang::whereIn('id',$ids)->get();
            foreach ($donHang as $key => $value) {
                $chi_tiet_don_hangs = ChiTietDonHang::where('don_hang_id', $value->id)->get();

                foreach ($chi_tiet_don_hangs as $chi_tiet) {
                    $bien_the = BienThe::find($chi_tiet->bien_the_id);

                    if ($bien_the && $bien_the->so_luong_tam_giu >= $chi_tiet->so_luong) {
                        $bien_the->decrement('so_luong', $chi_tiet->so_luong); // Trừ số lượng kho chính thức
                        $bien_the->decrement('so_luong_tam_giu', $chi_tiet->so_luong); // Giảm tạm giữ
                    } else {
                        return redirect()->back()->with('error', 'Sản phẩm không đủ để xác nhận đơn hàng.');
                    }
                }
                // Cập nhật trạng thái hàng loạt
                $value->update([
                    'trang_thai' => 1,
                    'nguoi_ban' => Auth::user()->id,
                    'ngay_ban' => Carbon::now()
                ]);

                ThongBao::create([
                    'user_id' => $value->user_id,
                    'tieu_de' => "Xác nhận đơn hàng",
                    'noi_dung' => 'Đơn hàng ' . $value->ma_don_hang . ' đã được xác nhận.',
                ]);
            }

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

        ThongBao::create([
            'user_id' => $donHang->user_id,
            'tieu_de' => "Đơn hàng " .$donHang->ma_don_hang. " đã được cập nhật",
            'noi_dung' => 'Đơn hàng đang được giao đến bạn.',
        ]);
        return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('success', 'Đơn hàng đã được chuyển sang trạng thái Đang Giao.');
    }

    // Xử lý giao hàng cho các đơn hàng đã chọn
    public function giaoNhieuDonHang(Request $request){
        $ids = $request->input('select', []);
        if (empty($ids)) {
            return redirect()->route('don-hang.danh-sach-cho-lay-hang')->with('error', 'Vui lòng chọn ít nhất một đơn hàng.');
        }

        DB::beginTransaction();
        try {
            $donHang = DonHang::whereIn('id',$ids)->get();

            foreach ($donHang as $key => $value) {
                $value->update(['trang_thai' => 2]);
                ThongBao::create([
                    'user_id' => $value->user_id,
                    'tieu_de' => "Đơn hàng " .$value->ma_don_hang. " đã được cập nhật",
                    'noi_dung' => 'Đơn hàng đang được giao đến bạn.',
                ]);
            }

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
        $diaChiNhanHang = DiaChi::with('phuongXa','quanHuyen','tinhThanhPho')->find($donHang->dia_chi_id);
        $phi_ships = PhiShip::with('tinhThanhPho', 'quanHuyen')
                            ->where('ma_quan_huyen', $diaChiNhanHang->ma_quan_huyen)
                            ->first();
        return view('admin.donHang.chiTietDonHang', [
            'donHang' => $donHang,
            'diaChiNhanHang' => $diaChiNhanHang,
            'phiShip' => $phi_ships ? $phi_ships->phi_ship : 0
        ]);
    }

    // In hóa đơn
    public function inHoaDon($id) {
        $donHang = DonHang::with(['chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])->findOrFail($id);
        $diaChiNhanHang = DiaChi::with('phuongXa','quanHuyen','tinhThanhPho')->find($donHang->dia_chi_id);
        $phi_ships = PhiShip::with('tinhThanhPho', 'quanHuyen')
                            ->where('ma_quan_huyen', $diaChiNhanHang->ma_quan_huyen)
                            ->first();
        return view('admin.donHang.hoaDon', [
            'donHang' => $donHang,
            'diaChiNhanHang' => $diaChiNhanHang,
            'phiShip' => $phi_ships ? $phi_ships->phi_ship : 0
        ]);
    }
    //In Hàng Loạt
    public function inHoaDonHangLoat()
    {
        $donHangs = DonHang::with([
            'chiTietDonHangs.sanPham',
            'chiTietDonHangs.bienThe',
            'diaChi.phuongXa',
            'diaChi.quanHuyen',
            'diaChi.tinhThanhPho',
        ])
            ->where('trang_thai', 1)
            ->orderBy('ngay_cap_nhat', 'desc')
            ->get();

        foreach ($donHangs as $donHang) {
            $diaChiNhanHang = DiaChi::find($donHang->dia_chi_id);
            $phiShip = PhiShip::where('ma_quan_huyen', $diaChiNhanHang->ma_quan_huyen)->first();
            $donHang->phi_ship = $phiShip ? $phiShip->phi_ship : 0;
        }
        return view('admin.donHang.inHoaDonHangLoat', [
            'donHangs' => $donHangs,
        ]);
    }
    // Hủy đơn hàng
    public function huyDonHang(int $id)
    {
        try {
            // Tìm đơn hàng và cập nhật trạng thái
            $donHang = DonHang::findOrFail($id);
            $chi_tiet_don_hangs = ChiTietDonHang::where('don_hang_id', $id)->get();

            foreach ($chi_tiet_don_hangs as $chi_tiet) {
                $bien_the = BienThe::find($chi_tiet->bien_the_id);

                if ($bien_the && $bien_the->so_luong_tam_giu >= $chi_tiet->so_luong) {
                    $bien_the->decrement('so_luong', $chi_tiet->so_luong); // Trừ số lượng kho chính thức
                    $bien_the->decrement('so_luong_tam_giu', $chi_tiet->so_luong); // Giảm tạm giữ
                }
            }
            $donHang->trang_thai = 4;
            $donHang->nguoi_ban = Auth::guard('admin')->user()->id;
            $donHang->save();
            ThongBao::create([
                'user_id' => $donHang->user_id,
                'tieu_de' => "Đơn hàng " .$donHang->ma_don_hang. " đã bị hủy",
                'noi_dung' => 'Đơn hàng của bạn đã bị hủy bởi shop! Vui lòng liên hệ với shop để biết thêm chi tiết.',
            ]);
            return redirect(url()->previous())->with('success', 'Đơn hàng đã được hủy thành công.');
        } catch (Exception $e) {
            return redirect(url()->previous())->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }

    public function checkTrangThaiDonHang(){
        $don_hangs = DonHang::with(['user', 'diaChi', 'danhGia', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
        ->orderBy('ngay_cap_nhat', 'desc')
        ->get()->values();

        $don_hangs_grouped = [
            'trang_thai_all' => $don_hangs,
            'trang_thai_0' => $don_hangs->where('trang_thai', 0)->values(),
            'trang_thai_1' => $don_hangs->where('trang_thai', 1)->values(),
            'trang_thai_2' => $don_hangs->where('trang_thai', 2)->values(),
            'trang_thai_3' => $don_hangs->where('trang_thai', 3)->values(),
            'trang_thai_4' => $don_hangs->where('trang_thai', 4)->values(),
        ];

        return response()->json([
            "donHang" => $don_hangs_grouped
        ]);
    }
}
