<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Banner;
use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\TinTuc;
use App\Models\DanhMuc;
use App\Models\Message;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\Algolia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $views;
    public function __construct()
    {
        $this->views = [];
    }

    public function home()
    {
        $userId = Auth::id();
        $danh_mucs = DanhMuc::where('id','!=',1)->get();

        $san_pham_noi_bat = SanPham::with(['bienThes', 'danhGias', 'yeuThich' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('danh_muc_id','!=',1)->orderBy('luot_xem', 'desc')->take(8)->get();

        $san_pham_moi_nhat = SanPham::with(['bienThes', 'danhGias', 'yeuThich' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('danh_muc_id','!=',1)->orderBy('id', 'desc')->take(8)->get();

        $san_pham_ban_chay = SanPham::with(['bienThes', 'danhGias', 'yeuThich' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('danh_muc_id','!=',1)->orderBy('da_ban', 'desc')->take(8)->get();

        $san_pham_khuyen_mai = SanPham::with(['bienThes', 'danhGias', 'yeuThich' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('danh_muc_id','!=',1)->where('khuyen_mai', '>', 0)->orderBy('id', 'desc')->take(8)->get();

        $banner = Banner::all();
        $this->views['banner'] = $banner;
        $this->views['danh_mucs'] = $danh_mucs;

        $this->views['san_pham_noi_bat'] = $san_pham_noi_bat;
        $this->views['san_pham_moi_nhat'] = $san_pham_moi_nhat;
        $this->views['san_pham_ban_chay'] = $san_pham_ban_chay;
        $this->views['san_pham_khuyen_mai'] = $san_pham_khuyen_mai;
        $this->views['tin_tucs'] = TinTuc::with('danhMucTinTuc','user')->orderBy('id','desc')->take(8)->get();
        return view('client.home', $this->views);
    }

    public function fetchMessages($userId)
    {
        // Lấy tin nhắn giữa người dùng hiện tại và receiver_id
        $messages = Message::with('sender')->where('user_id', $userId)
                ->orWhere('receiver_id', $userId)->get();

        // Trả về tin nhắn dưới dạng JSON
        return response()->json([
            'messages' => $messages
        ]);
    }

    public function quickView(Request $request)
    {
        $san_pham = SanPham::with('bienThes', 'danhGias')->find($request->input('san_pham_id'));
        $kich_cos = KichCo::all();
        $mau_sacs = MauSac::all();
        return response()->json([
            'san_pham' => $san_pham,
            'kich_cos' => $kich_cos,
            'mau_sacs' => $mau_sacs
        ]);
    }
    public function search(Request $request)
    {
        $searchText = $request->input('search_text');
        $results = SanPham::search($searchText)->get();

        // Lấy danh sách sản phẩm có liên kết với bảng 'danhGias' để tính số sao trung bình
        $results = SanPham::with('danhGias')
        ->where('ten_san_pham', 'LIKE', '%' . $searchText . '%') // Tìm kiếm theo tên sản phẩm
        ->get(); // Reset lại chỉ số mảng
        // Trả về kết quả dưới dạng JSON để sử dụng AJAX
        if ($request->ajax()) {
            return response()->json([
                'results' => $results
            ]);
        }

        // Nếu không phải AJAX request, render bình thường
        return view('client.layout.main', [
            'san_pham_tim_kiem' => $results,
        ]);
    }


    public function error404()
    {
        return view('errors.404');
    }
    public function chinhSachBaoMat()
    {
        return view('client.chinhSachBaoMat.chinhSachBaoMat');
    }

    public function cauHoiThuongGap()
    {
        return view('client.cauHoiThuongGap.cauHoiThuongGap');
    }
}
