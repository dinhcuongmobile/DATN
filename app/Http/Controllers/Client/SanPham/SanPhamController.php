<?php

namespace App\Http\Controllers\Client\SanPham;

use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\BienThe;
use App\Models\DanhGia;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GioHang;
use App\Models\TraLoiDanhGia;
use App\Models\User;
use App\Models\YeuThich;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    protected $views;
    public function __construct()
    {
        $this->views = [];
    }

    public function chiTietSanPham(int $id)
    {
        $userId = Auth::id();
        $san_pham = SanPham::with(['danhMuc','bienThes', 'danhGias', 'yeuThich' => function ($query) use ($userId) {
                    $query->where('user_id', $userId); }])->find($id);

        if (!$san_pham) {
            return redirect()->route('404');
        }
        $luot_xem = $san_pham->luot_xem+1;
        $san_pham->update(['luot_xem'=>$luot_xem]);

        $danh_gias= DanhGia::with('user','sanPham','anhDanhGias')->where('san_pham_id',$san_pham->id)->orderBy('id','desc')->paginate(6);
        // Số lượng đánh giá theo sao
        $saoCounts = DanhGia::where('san_pham_id', $id)
            ->select('so_sao', DB::raw('count(*) as total'))
            ->groupBy('so_sao')
            ->pluck('total', 'so_sao');
        // Số lượng đánh giá có bình luận
        $coBinhLuan = DanhGia::where('san_pham_id', $id)
            ->where('noi_dung', '!=', '')
            ->count();
        // Số lượng đánh giá có hình ảnh
        $coHinhAnh = DanhGia::where('san_pham_id', $id)
            ->whereHas('anhDanhGias')
            ->count();

        $arrTraLoiDanhGia = [];

        foreach ($danh_gias as $key => $itemDanhGia) {
            $arrTraLoiDanhGia[$itemDanhGia->id] = TraLoiDanhGia::with('user')->where('danh_gia_id',$itemDanhGia->id)->orderBy('id','desc')->first();
        }

        $this->views['san_pham_lien_quan'] = SanPham::with('danhMuc', 'bienThes', 'danhGias')
            ->where('danh_muc_id', $san_pham->danh_muc_id)
            ->take(8)->get();
        $this->views['san_pham']=$san_pham;
        $this->views['danh_gias']=$danh_gias;
        $this->views['saoCounts']=$saoCounts;
        $this->views['coBinhLuan']=$coBinhLuan;
        $this->views['coHinhAnh']=$coHinhAnh;
        $this->views['kich_cos'] = KichCo::all();
        $this->views['mau_sacs'] = MauSac::all();
        $this->views['arrTraLoiDanhGia'] = $arrTraLoiDanhGia;

        // Tổng yêu thích
        if (Auth::check()) {
            $yeuThich = YeuThich::where('user_id',Auth::id())->get();
            $tongYeuThich = $yeuThich->count();
            //
            $this->views['tong_yeu_thich'] = $tongYeuThich;
        }
        //
        return view('client.sanPham.chiTietSanPham', $this->views);
    }

    public function sanPham(Request $request)
    {
        $userId = Auth::id();
        // Lấy giá tối đa của sản phẩm từ cơ sở dữ liệu
        $maxPrice = SanPham::max('gia_san_pham'); // Lấy giá cao nhất của sản phẩm

        // Giá tối thiểu mặc định
        $minPrice = 0;

        // Lọc sản phẩm dựa trên các tham số được gửi lên
        $sanPhams = SanPham::with(['bienThes', 'danhGias', 'yeuThich' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);
        // Xử lý lọc theo điều kiện sắp xếp
        if ($request->has('orderby')) {
            switch ($request->orderby) {
                case 'best-selling':
                    // Sắp xếp theo bán chạy nhất (ví dụ như theo số lượng bán)
                    $sanPhams->orderBy('da_ban', 'desc');
                    break;
                case 'a-z':
                    // Sắp xếp theo tên sản phẩm, A-Z
                    $sanPhams->orderBy('ten_san_pham', 'asc');
                    break;
                case 'price-high-low':
                    // Sắp xếp theo giá từ cao đến thấp
                    $sanPhams->orderBy('gia_san_pham', 'desc');
                    break;
                case 'discount-high-low':
                    // Sắp xếp theo mức giảm giá % từ cao đến thấp
                    $sanPhams->orderBy('khuyen_mai', 'desc');
                    break;
                default:
                    // Mặc định sắp xếp
                    $sanPhams->orderBy('id', 'desc');
                    break;
            }
        }


        // Thêm điều kiện lọc theo giá
        if ($request->has('minPrice')) {
            $sanPhams->where('gia_san_pham', '>=', $request->minPrice);
        }

        if ($request->has('maxPrice')) {
            $sanPhams->where('gia_san_pham', '<=', $request->maxPrice);
        }


        // Truyền minPrice và maxPrice vào view
        $this->views['minPrice'] = $minPrice;
        $this->views['maxPrice'] = $maxPrice;

        // Lấy tất cả sản phẩm
        $allSanPham = $sanPhams->orderBy('id', 'desc')->get();

        // Lấy số trang có sản phẩm
        $pages = [];
        $checkPages = ceil($allSanPham->count() / 8); // Tính số trang dựa trên số sản phẩm

        for ($i = 1; $i <= $checkPages; $i++) {
            // Kiểm tra xem trang này có sản phẩm không
            if ($allSanPham->forPage($i, 8)->isNotEmpty()) {
                $pages[] = $i; // Thêm trang có sản phẩm vào danh sách
            }
        }

        $this->views['san_phams'] = $sanPhams->orderBy('id', 'desc')->paginate(8);
        $this->views['danh_mucs'] = DanhMuc::all();
        $this->views['count_sp_danh_muc'] = $sanPhams->groupBy('danh_muc_id')
            ->selectRaw('danh_muc_id, COUNT(*) as count')
            ->pluck('count', 'danh_muc_id');
        // Kiểm tra nếu yêu cầu AJAX
        if ($request->ajax()) {
            $html = view('client.sanPham.filterSanPham', $this->views)->render();

            return response()->json([
                'html' => $html,
                'prevUrl' => $this->views['san_phams']->previousPageUrl(),
                'nextUrl' => $this->views['san_phams']->nextPageUrl(),
                'pages' => $pages,
            ]);
        }
        return view('client.sanPham.sanPham', $this->views);
    }

    public function sanPhamDanhMuc(Request $request, int $id)
    {
        $userId = Auth::id();
        // Lấy giá tối đa của sản phẩm từ cơ sở dữ liệu trong danh mục đó
        $maxPrice = SanPham::where('danh_muc_id', $id)->max('gia_san_pham'); // Lấy giá cao nhất trong danh mục

        // Giá tối thiểu mặc định
        $minPrice = 0;

        // Lọc sản phẩm dựa trên các tham số được gửi lên, chỉ lọc sản phẩm trong danh mục đó
        $sanPhams = SanPham::with(['bienThes', 'danhGias', 'yeuThich' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('danh_muc_id',$id);


        // Xử lý lọc theo điều kiện sắp xếp
        if ($request->has('orderby')) {
            switch ($request->orderby) {
                case 'best-selling':
                    // Sắp xếp theo bán chạy nhất (ví dụ như theo số lượng bán)
                    $sanPhams->orderBy('da_ban', 'desc');
                    break;
                case 'a-z':
                    // Sắp xếp theo tên sản phẩm, A-Z
                    $sanPhams->orderBy('ten_san_pham', 'asc');
                    break;
                case 'price-high-low':
                    // Sắp xếp theo giá từ cao đến thấp
                    $sanPhams->orderBy('gia_san_pham', 'desc');
                    break;
                case 'discount-high-low':
                    // Sắp xếp theo mức giảm giá % từ cao đến thấp
                    $sanPhams->orderBy('khuyen_mai', 'desc');
                    break;
                default:
                    // Mặc định sắp xếp
                    $sanPhams->orderBy('id', 'desc');
                    break;
            }
        }


        // Thêm điều kiện lọc theo giá
        if ($request->has('minPrice')) {
            $sanPhams->where('gia_san_pham', '>=', $request->minPrice);
        }

        if ($request->has('maxPrice')) {
            $sanPhams->where('gia_san_pham', '<=', $request->maxPrice);
        }


        // Truyền minPrice và maxPrice vào view
        $this->views['minPrice'] = $minPrice;
        $this->views['maxPrice'] = $maxPrice;

        // Lấy tất cả sản phẩm
        $allSanPham = SanPham::where('danh_muc_id', $id)->orderBy('id', 'desc')->get();

        // Lấy số trang có sản phẩm
        $pages = [];
        $checkPages = ceil($allSanPham->count() / 8); // Tính số trang dựa trên số sản phẩm

        for ($i = 1; $i <= $checkPages; $i++) {
            // Kiểm tra xem trang này có sản phẩm không
            if ($allSanPham->forPage($i, 8)->isNotEmpty()) {
                $pages[] = $i; // Thêm trang có sản phẩm vào danh sách
            }
        }

        $this->views['san_phams'] = $sanPhams->where('danh_muc_id', $id)->with('danhMuc', 'bienThes', 'danhGias')->orderBy('id', 'desc')->paginate(8);
        $this->views['danh_mucs'] = DanhMuc::all();
        $this->views['danh_muc'] = DanhMuc::where('id', $id)->first();
        $this->views['count_sp_danh_muc'] = SanPham::selectRaw('danh_muc_id, COUNT(*) as count')
                                                ->groupBy('danh_muc_id')
                                                ->pluck('count', 'danh_muc_id');
        //
        // Kiểm tra nếu yêu cầu AJAX
        if ($request->ajax()) {
            $html = view('client.sanPham.filterSanPham', $this->views)->render();

            return response()->json([
                'html' => $html,
                'prevUrl' => $this->views['san_phams']->previousPageUrl(),
                'nextUrl' => $this->views['san_phams']->nextPageUrl(),
                'pages' => $pages,
            ]);
        }

        return view('client.sanPham.sanPhamDanhMuc', $this->views);
    }

    public function soLuongTonKho(Request $request)
    {
        $kich_co = $request->input('kich_co');
        $mau_sac = $request->input('mau_sac');
        $san_pham_id = $request->input('san_pham_id');

        $bienThe = BienThe::where('san_pham_id', $san_pham_id)
            ->where('kich_co', $kich_co)
            ->where('ma_mau', $mau_sac)
            ->first();

        $gio_hang= GioHang::where('user_id',Auth::user()->id)
                            ->where('san_pham_id',$san_pham_id)
                            ->where('bien_the_id',$bienThe->id)->first();
        if ($bienThe) {
            return response()->json([
                'quantity' => $bienThe->so_luong,
                'gio_hang' => $gio_hang
            ]);
        } else {
            return response()->json(['quantity' => 0]);
        }
    }
}
