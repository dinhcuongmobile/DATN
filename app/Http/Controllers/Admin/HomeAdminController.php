<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\DonHang;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThongBao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeAdminController extends Controller
{
    public function __construct() {
        // Có thể thêm middleware tại đây nếu cần
    }

    public function homeAdmin() {
        // Gọi các phương thức thống kê
        $thongKeSanPhams = $this->thongKeSanPham();
        $thongKeDanhMucs = $this->thongKeDanhMuc();
        $tongTaiKhoan = $this->thongKeTaiKhoan();
        $tongDonHang = $this->thongKeDonHang();
        $tongLuotXem = $this->thongKeLuotXem();

        return view('admin.homeAdmin', [
            'thongKeSanPhams' => $thongKeSanPhams,
            'thongKeDanhMucs' => $thongKeDanhMucs,
            'tongTaiKhoan' => $tongTaiKhoan,
            'tongDonHang' => $tongDonHang,
            'tongLuotXem' => $tongLuotXem
        ]);
    }

    public function fetchMessages($receiver_id)
    {
        // Lấy tin nhắn giữa người dùng hiện tại và receiver_id
        $messages = Message::with('sender')->where('user_id', $receiver_id)
                ->orWhere('receiver_id', $receiver_id)->orderBy('id','asc')->get();

        // Trả về tin nhắn dưới dạng JSON
        return response()->json([
            'messages' => $messages
        ]);
    }


    public function thongKeSanPham() {
        // Thống kê sản phẩm theo tổng doanh thu
        $thongKeSanPhams = DonHang::where('trang_thai', 3) // Trạng thái đã giao
            ->join('chi_tiet_don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->join('san_phams', 'chi_tiet_don_hangs.san_pham_id', '=', 'san_phams.id')
            ->selectRaw('san_phams.id, san_phams.ten_san_pham, san_phams.hinh_anh, SUM(chi_tiet_don_hangs.thanh_tien) as tong_doanh_thu')
            ->groupBy('san_phams.id', 'san_phams.ten_san_pham', 'san_phams.hinh_anh')
            ->orderByDesc('tong_doanh_thu')
            ->take(3)
            ->get();

        foreach ($thongKeSanPhams as $item) {
            $item->tong_doanh_thu = number_format($item->tong_doanh_thu, 0, ',', '.');
        }

        return $thongKeSanPhams;
    }

    public function thongKeDanhMuc() {
        // Thống kê danh mục theo tổng doanh thu
        $thongKeDanhMucs = DonHang::where('trang_thai', 3) // Trạng thái đã giao
            ->join('chi_tiet_don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->join('san_phams', 'chi_tiet_don_hangs.san_pham_id', '=', 'san_phams.id')
            ->join('danh_mucs', 'san_phams.danh_muc_id', '=', 'danh_mucs.id')
            ->selectRaw('danh_mucs.id, danh_mucs.ten_danh_muc, danh_mucs.hinh_anh, SUM(chi_tiet_don_hangs.thanh_tien) as tong_doanh_thu')
            ->groupBy('danh_mucs.id', 'danh_mucs.ten_danh_muc', 'danh_mucs.hinh_anh')
            ->orderByDesc('tong_doanh_thu')
            ->take(3)
            ->get();

        foreach ($thongKeDanhMucs as $item) {
            $item->tong_doanh_thu = number_format($item->tong_doanh_thu, 0, ',', '.');
        }

        return $thongKeDanhMucs;
    }

    public function thongKeTaiKhoan() {
        return User::count();
    }
    public function thongKeDonHang() {
        return DonHang::count();
    }
    public function thongKeLuotXem() {
        if (!Session::has('luot_xem')) {
            $tongLuotXem = Cache::get('tong_luot_xem', 0) + 1;
            Cache::put('tong_luot_xem', $tongLuotXem);
            Session::put('luot_xem', true);
        } else {
            $tongLuotXem = Cache::get('tong_luot_xem', 0);
        }
        return $tongLuotXem;
    }

    public function thongBaoPopup(){
        $thongBao = ThongBao::where('nguoi_nhan',1)->orderBy('created_at','desc')->take(4)->get();
        $allThongBao = ThongBao::where('nguoi_nhan',1)->orderBy('created_at','desc')->get();
        $count = ThongBao::where('nguoi_nhan',1)->get()->count();
        return response()->json([
            'allThongBao' => $allThongBao,
            'thongBao'=>$thongBao,
            'count' => $count
        ]);
    }

    public function messagePopup(){
        $messages = Message::with('sender')
                    ->whereIn('id', function ($query) {
                        $query->selectRaw('max(id)')
                            ->from('messages')
                            ->where('sender_role', 'thanhVien')
                            ->groupBy('user_id');
                    })
                    ->orderBy('id', 'desc')
                    ->get();
                    
        $messages->map(function($message) {
            $message->created_at_diff = $message->created_at->diffForHumans();
            return $message;
        });
        return response()->json([
            'messages' => $messages,
            'countMessage' => $messages->count(),
        ]);
    }
}
