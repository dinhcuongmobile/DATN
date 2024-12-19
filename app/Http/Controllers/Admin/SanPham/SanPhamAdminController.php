<?php

namespace App\Http\Controllers\Admin\SanPham;

use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\BienThe;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SanPham\StoreBienTheRequest;
use App\Http\Requests\SanPham\StoreSanPhamRequest;
use App\Http\Requests\SanPham\UpdateBienTheRequest;
use App\Http\Requests\SanPham\UpdateSanPhamRequest;
use App\Models\AnhDanhGia;
use App\Models\ChiTietDonHang;
use App\Models\DanhGia;
use App\Models\TraLoiDanhGia;
use App\Models\YeuThich;

class SanPhamAdminController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    //show
    public function danhSachSanPham(Request $request){
        $query = SanPham::with('danhMuc', 'bienThes')->where('danh_muc_id','!=',1);
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->where('ten_san_pham', 'LIKE', "%$keyword%")
                  ->orWhereHas('danhMuc', function($loc) use ($keyword) {
                      $loc->where('ten_danh_muc', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['san_phams'] = $query->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        foreach ($this->views['san_phams'] as $san_pham) {
            $san_pham->tong_so_luong = $san_pham->bienThes->sum('so_luong');
        }

        return view('admin.sanPham.DSSanPham', $this->views);
    }

    public function danhSachBienThe(Request $request){
        $query = BienThe::with('sanPham');
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('so_luong', (int)$keyword)
                        ->orWhere('kich_co', $keyword)
                        ->orWhere('ten_mau', $keyword)
                        ->orWhereHas('sanPham', function ($productQuery) use ($keyword) {
                            $productQuery->where('ten_san_pham', 'LIKE', "%$keyword%");
                        });
            });
        }

        $this->views['bien_thes'] = $query->orderBy('san_pham_id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        return view('admin.sanPham.bienThe.DSBienThe', $this->views);
    }


    public function danhSachSize(){
        $this->views['kich_cos'] = KichCo::orderBy('id', 'desc')->paginate(10);

        return view('admin.sanPham.kichCo.DSKichCo',$this->views);
    }

    public function danhSachMauSac(){
        $this->views['mau_sacs'] = MauSac::orderBy('id', 'desc')->paginate(10);

        return view('admin.sanPham.mauSac.DSMauSac',$this->views);
    }

    public function loadBienTheOneSanPham(Request $request, int $id){
        $query= BienThe::with('sanPham')->where('san_pham_id',$id);
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->whereHas('sanPham', function($loc) use ($keyword) {
                      $loc->where('ten_san_pham', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['bien_thes'] = $query->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        return view('admin.sanPham.bienThe.DSBienThe',$this->views);
    }

    public function loadOneSanPham(Request $request, int $id){
        $query = SanPham::with('danhMuc','bienThes')->where('id',$id);
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->where('ten_san_pham', 'LIKE', "%$keyword%")
                  ->orWhereHas('danhMuc', function($loc) use ($keyword) {
                      $loc->where('ten_danh_muc', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['san_phams'] = $query->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        foreach ($this->views['san_phams'] as $san_pham) {
            $san_pham->tong_so_luong = $san_pham->bienThes->sum('so_luong');
        }

        return view('admin.sanPham.DSSanPham',$this->views);
    }

    public function sanPhamDanhMuc(Request $request, int $id){
        $query= SanPham::with('danhMuc')->where('danh_muc_id',$id);
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->whereHas('sanPham', function($loc) use ($keyword) {
                      $loc->where('ten_san_pham', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['san_phams'] = $query->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        foreach ($this->views['san_phams'] as $san_pham) {
            $san_pham->tong_so_luong = $san_pham->bienThes->sum('so_luong');
        }

        return view('admin.sanPham.DSSanPham',$this->views);
    }

    public function danhSachDaXoa(Request $request){
        $keywordSP = $request->input('kywSP');

        $sanPhams = SanPham::with('danhMuc', 'bienThes')->onlyTrashed();

        if ($keywordSP) {
            $sanPhams->where(function ($query) use ($keywordSP) {
                $query->where('ten_san_pham', 'LIKE', "%$keywordSP%")
                    ->orWhereHas('danhMuc', function ($loc) use ($keywordSP) {
                        $loc->where('ten_danh_muc', 'LIKE', "%$keywordSP%");
                    });
            });
        }

        $sanPhams = $sanPhams->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keywordSP]);

        foreach ($sanPhams as $san_pham) {
            $san_pham->tong_so_luong = $san_pham->bienThes->sum('so_luong');
        }

        $keywordBT = $request->input('kywBT');

        $bienThes = BienThe::with('sanPham')->onlyTrashed();

        if ($keywordBT) {
            $bienThes->where(function ($query) use ($keywordBT) {
                $query->where('kich_co', 'LIKE', "%$keywordBT%")
                    ->orWhere('ten_mau', 'LIKE', "%$keywordBT%")
                    ->orWhereHas('sanPham', function ($loc) use ($keywordBT) {
                        $loc->where('ten_san_pham', 'LIKE', "%$keywordBT%");
                    });
            });
        }

        $bienThes = $bienThes->orderBy('san_pham_id', 'desc')->paginate(10)->appends(['kyw' => $keywordBT]);

        $this->views['san_phams'] = $sanPhams;
        $this->views['bien_thes'] = $bienThes;

        return view('admin.sanPham.DSSanPhamDaXoa', $this->views);
    }


    //show them
    public function showThemSanPham(){
        $this->views['danh_mucs']= DanhMuc::all();
        return view('admin.sanPham.themSanPham',$this->views);
    }

    public function showThemBienThe(){
        $this->views['san_phams']=SanPham::orderBy('id','desc')->get();
        $this->views['mau_sacs']=MauSac::all();
        $this->views['kich_cos']=KichCo::all();
        return view('admin.sanPham.bienThe.themBienThe',$this->views);
    }

    public function showThemSize(){
        return view('admin.sanPham.kichCo.themKichCo');
    }

    public function showThemMauSac(){
        return view('admin.sanPham.mauSac.themMauSac');
    }

    //show update
    public function showSuaSanPham(int $id){
        $this->views['san_pham']=SanPham::findOrFail($id);
        $this->views['danh_mucs']=DanhMuc::all();
        return view('admin.sanPham.capNhatSanPham',$this->views);
    }

    public function showSuaBienThe(int $id){
        $this->views['bien_the']=BienThe::findOrFail($id);
        $this->views['san_phams']=SanPham::orderBy('id','desc')->get();
        $this->views['mau_sacs']=MauSac::all();
        $this->views['kich_cos']=KichCo::all();
        return view('admin.sanPham.bienThe.capNhatBienThe',$this->views);
    }


    //add
    public function themSanPham(StoreSanPhamRequest $request){
        $check_sp= SanPham::withTrashed()
                            ->where('ten_san_pham',$request->ten_san_pham)
                            ->where('danh_muc_id',$request->danh_muc_id)->first();
        if($check_sp){
            return redirect()->back()->with('error', 'Sản phẩm này đã tồn tại. Hãy xóa khỏi danh sách và thùng rác để thêm mới !');
        }

        if($request->hasFile('hinh_anh')){
            $fileName= $request->file('hinh_anh')->store('uploads/sanPham','public');
        }else{
            $fileName=null;
        }

        $dataInsert= [
            'danh_muc_id' => $request->danh_muc_id,
            'hinh_anh' => $fileName,
            'ten_san_pham' => $request->ten_san_pham,
            'gia_san_pham' => $request->gia_san_pham,
            'khuyen_mai' => $request->khuyen_mai,
            'mo_ta' => $request->mo_ta,
            'created_at' => now()
        ];

        $result= SanPham::create($dataInsert);
        if($result){
                return redirect()->route('san-pham.danh-sach')->with('success', 'Bạn đã thêm thành công !');
        }else{
            return redirect()->route('san-pham.danh-sach')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    public function themBienThe(StoreBienTheRequest $request){
        $bienThe = BienThe::where('kich_co', $request->kich_co)
                       ->where('ma_mau', $request->ma_mau)
                       ->where('san_pham_id', $request->san_pham_id)
                       ->first();

        if ($bienThe) {
            return redirect()->back()->with(['error' => 'Biến thể này đã được tạo từ trước !']);
        }

        if($request->hasFile('hinh_anh')){
            $fileName= $request->file('hinh_anh')->store('uploads/sanPham','public');
        }else{
            $fileName=null;
        }

        $dataInsert= [
            'hinh_anh' => $fileName,
            'kich_co' => $request->kich_co,
            'ten_mau' => $request->ten_mau,
            'ma_mau' => $request->ma_mau,
            'so_luong' => $request->so_luong,
            'san_pham_id' => $request->san_pham_id,
            'created_at' => now()
        ];

        $result= BienThe::create($dataInsert);
        if($result){
                return redirect()->route('san-pham.danh-sach-bien-the-san-pham')->with('success', 'Bạn đã thêm thành công !');
        }else{
            return redirect()->route('san-pham.danh-sach-bien-the-san-pham')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    public function themSize(Request $request){
        $request->validate(
            [
                'kich_co' => [
                    'required',
                    'in:XS,S,M,L,XL,XXL,XXXL',
                    'unique:kich_cos,kich_co'
                ],
            ],
            [
                'kich_co.required' => 'Vui lòng nhập kích cỡ!',
                'kich_co.in' => 'Kích cỡ phải là một trong các giá trị: XS, S, M, L, XL, XXL, XXXL.',
                'kich_co.unique' => 'Kích cỡ này đã tồn tại.',
            ]
        );

        $result=KichCo::create(['kich_co'=>$request->kich_co]);
        if($result){
            return redirect()->route('san-pham.quan-ly-size')->with('success', 'Bạn đã thêm thành công !');
        }else{
            return redirect()->route('san-pham.quan-ly-size')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }

    }

    public function themMauSac(Request $request){
        $request->validate(
            [
                'ten_mau' => 'required|max:255',
                'ma_mau' => [
                    'required',
                    'regex:/^#[0-9A-Fa-f]{6}$/',
                    'unique:mau_sacs,ma_mau',
                ],
            ],
            [
                'ma_mau.required' => 'Vui lòng nhập mã màu.',
                'ma_mau.regex' => 'Mã màu không hợp lệ. Mã màu hợp lệ phải có dạng #FFFFFF.',
                'ma_mau.unique' => 'Mã màu này đã tồn tại trong hệ thống.',
            ]
        );

        $result=MauSac::create(['ten_mau'=>$request->ten_mau, 'ma_mau' => $request->ma_mau]);
        if($result){
            return redirect()->route('san-pham.quan-ly-mau-sac')->with('success', 'Bạn đã thêm thành công !');
        }else{
            return redirect()->route('san-pham.quan-ly-mau-sac')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    //update
    public function suaSanPham(UpdateSanPhamRequest $request , int $id){
        $san_pham=SanPham::find($id);

        if($request->ten_san_pham!=$san_pham->ten_san_pham ||
            $request->danh_muc_id!=$san_pham->danh_muc_id)
        {
            $check_sp= SanPham::withTrashed()
                            ->where('ten_san_pham',$request->ten_san_pham)
                            ->where('danh_muc_id',$request->danh_muc_id)->first();
            if($check_sp){
                return redirect()->back()->with('error', 'Sản phẩm này đã tồn tại. Hãy xóa khỏi danh sách và thùng rác để tiếp tục !');
            }
        }

        if($request->hasFile('hinh_anh')){
            $fileName= $request->file('hinh_anh')->store('uploads/sanPham','public');
            if($san_pham->hinh_anh){
                Storage::disk('public')->delete($san_pham->hinh_anh);
            }
        }else{
            $fileName=$san_pham->hinh_anh;
        }

        $dataUpdate= [
            'danh_muc_id' => $request->danh_muc_id,
            'hinh_anh' => $fileName,
            'ten_san_pham' => $request->ten_san_pham,
            'gia_san_pham' => $request->gia_san_pham,
            'khuyen_mai' => $request->khuyen_mai,
            'mo_ta' => $request->mo_ta,
            'updated_at' => now()
        ];

        $result= $san_pham->update($dataUpdate);
        if($result){
                return redirect()->route('san-pham.danh-sach')->with('success', 'Bạn đã sửa thành công !');
        }else{
            return redirect()->route('san-pham.danh-sach')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    public function suaBienThe(UpdateBienTheRequest $request , int $id){
        $bien_the=BienThe::findOrFail($id);

        //kiểm tra xem có thay đổi biến thể không nếu thay đổi check xem có trùng trên db ko
        if($request->kich_co!=$bien_the->kich_co ||
            $request->ma_mau!=$bien_the->ma_mau ||
            $request->san_pham_id!=$bien_the->san_pham_id)
        {
            $bienThe = BienThe::where('kich_co', $request->kich_co)
                                ->where('ma_mau', $request->ma_mau)
                                ->where('san_pham_id', $request->san_pham_id)
                                ->first();

            if ($bienThe) {
            return redirect()->back()->with(['error' => 'Biến thể này đã được tạo từ trước !']);
            }
        }

        if($request->hasFile('hinh_anh')){
            $fileName= $request->file('hinh_anh')->store('uploads/sanPham','public');
            if($bien_the->hinh_anh){
                Storage::disk('public')->delete($bien_the->hinh_anh);
            }
        }else{
            $fileName=$bien_the->hinh_anh;
        }

        $dataUpdate= [
            'hinh_anh' => $fileName,
            'kich_co' => $request->kich_co,
            'ten_mau' => $request->ten_mau,
            'ma_mau' => $request->ma_mau,
            'so_luong' => $request->so_luong,
            'san_pham_id' => $request->san_pham_id,
            'updated_at' => now()
        ];

        $result= $bien_the->update($dataUpdate);
        if($result){
                return redirect()->route('san-pham.danh-sach-bien-the-san-pham')->with('success', 'Bạn đã sửa thành công !');
        }else{
            return redirect()->route('san-pham.danh-sach-bien-the-san-pham')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    //delete
    public function xoaSanPham(int $id){
        if (Auth::guard('admin')->user()->vai_tro_id == 1) {
                $san_pham = SanPham::findOrFail($id);
                if($san_pham){
                    $ChiTietDonHangs = ChiTietDonHang::where('san_pham_id',$san_pham->id)->get();

                    foreach ($ChiTietDonHangs as $key => $value) {
                        $bien_the = BienThe::find($value->bien_the_id);

                        if ($bien_the && $bien_the->so_luong_tam_giu >= $value->so_luong) {
                            $bien_the->decrement('so_luong', $value->so_luong); // Trừ số lượng kho chính thức
                            $bien_the->decrement('so_luong_tam_giu', $value->so_luong); // Giảm tạm giữ
                        }

                        $donHang = DonHang::where('id',$value->don_hang_id)->first();
                        if($donHang->trang_thai==0){
                            $donHang->update([
                                'nguoi_ban' => Auth::guard('admin')->user()->id,
                                'trang_thai' => 4,
                                'ngay_cap_nhat' => now()
                            ]);
                                ThongBao::create([
                                    'user_id' => $donHang->user_id,
                                    'tieu_de' => "Đơn hàng " . $donHang->ma_don_hang . " đã bị hủy",
                                    'noi_dung' => 'Đơn hàng của bạn đã bị hủy bởi ' . Auth::guard('admin')->user()->ho_va_ten . '. Do trong kho không còn sản phẩm đã mua.',
                                ]);
                        }
                    }

                    BienThe::where('san_pham_id', $san_pham->id)->delete();
                    YeuThich::where('san_pham_id',$san_pham->id)->delete();
                    $san_pham->delete();
                }

                return redirect()->back()->with('success', 'Một mục đã được chuyển vào thùng rác và đơn hàng liên quan đã được cập nhật.');
        }

        return redirect()->route('admin.index');
    }

    public function xoaNhieuSanPham(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $san_pham = SanPham::findOrFail($id);
                if($san_pham){
                    $ChiTietDonHangs = ChiTietDonHang::where('san_pham_id',$san_pham->id)->get();

                    foreach ($ChiTietDonHangs as $key => $value) {
                        $bien_the = BienThe::find($value->bien_the_id);

                        if ($bien_the && $bien_the->so_luong_tam_giu >= $value->so_luong) {
                            $bien_the->decrement('so_luong', $value->so_luong); // Trừ số lượng kho chính thức
                            $bien_the->decrement('so_luong_tam_giu', $value->so_luong); // Giảm tạm giữ
                        }

                        $donHang = DonHang::where('id',$value->don_hang_id)->first();
                        if($donHang->trang_thai==0){
                            $donHang->update([
                                'nguoi_ban' => Auth::guard('admin')->user()->id,
                                'trang_thai' => 4,
                                'ngay_cap_nhat' => now()
                            ]);
                                ThongBao::create([
                                    'user_id' => $donHang->user_id,
                                    'tieu_de' => "Đơn hàng " . $donHang->ma_don_hang . " đã bị hủy",
                                    'noi_dung' => 'Đơn hàng của bạn đã bị hủy bởi ' . Auth::guard('admin')->user()->ho_va_ten . '. Do trong kho không còn sản phẩm đã mua.',
                                ]);
                        }
                    }

                    BienThe::where('san_pham_id', $san_pham->id)->delete();
                    YeuThich::where('san_pham_id',$san_pham->id)->delete();
                    $san_pham->delete();
                }

            }
            return redirect()->back()->with('success', 'Đã chuyển các mục vào thùng rác !');
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }

    public function xoaBienThe(int $id){
        if (Auth::guard('admin')->user()->vai_tro_id == 1) {
            $bien_the=BienThe::findOrFail($id);

            $ChiTietDonHangs = ChiTietDonHang::where('bien_the_id',$bien_the->id)->get();

            foreach ($ChiTietDonHangs as $key => $value) {
                $bien_the = BienThe::find($value->bien_the_id);

                if ($bien_the && $bien_the->so_luong_tam_giu >= $value->so_luong) {
                    $bien_the->decrement('so_luong', $value->so_luong); // Trừ số lượng kho chính thức
                    $bien_the->decrement('so_luong_tam_giu', $value->so_luong); // Giảm tạm giữ
                }

                $donHang = DonHang::where('id',$value->don_hang_id)->first();
                if($donHang->trang_thai==0){
                    $donHang->update([
                        'nguoi_ban' => Auth::guard('admin')->user()->id,
                        'trang_thai' => 4,
                        'ngay_cap_nhat' => now()
                    ]);
                        ThongBao::create([
                            'user_id' => $donHang->user_id,
                            'tieu_de' => "Đơn hàng " . $donHang->ma_don_hang . " đã bị hủy",
                            'noi_dung' => 'Đơn hàng của bạn đã bị hủy bởi ' . Auth::guard('admin')->user()->ho_va_ten . '. Do trong kho không còn sản phẩm đã mua.',
                        ]);
                }
            }
            $bien_the->delete();

            return redirect()->back()->with('success', 'Đã xóa thành công biến thể !');
        }

        return redirect()->route('admin.index');
    }

    public function xoaNhieuBienThe(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $bien_the=BienThe::findOrFail($id);

                $ChiTietDonHangs = ChiTietDonHang::where('bien_the_id',$bien_the->id)->get();

                foreach ($ChiTietDonHangs as $key => $value) {
                    $bien_the = BienThe::find($value->bien_the_id);

                    if ($bien_the && $bien_the->so_luong_tam_giu >= $value->so_luong) {
                        $bien_the->decrement('so_luong', $value->so_luong); // Trừ số lượng kho chính thức
                        $bien_the->decrement('so_luong_tam_giu', $value->so_luong); // Giảm tạm giữ
                    }

                    $donHang = DonHang::where('id',$value->don_hang_id)->first();
                    if($donHang->trang_thai==0){
                        $donHang->update([
                            'nguoi_ban' => Auth::guard('admin')->user()->id,
                            'trang_thai' => 4,
                            'ngay_cap_nhat' => now()
                        ]);
                            ThongBao::create([
                                'user_id' => $donHang->user_id,
                                'tieu_de' => "Đơn hàng " . $donHang->ma_don_hang . " đã bị hủy",
                                'noi_dung' => 'Đơn hàng của bạn đã bị hủy bởi ' . Auth::guard('admin')->user()->ho_va_ten . '. Do trong kho không còn sản phẩm đã mua.',
                            ]);
                    }
                }
                $bien_the->delete();
            }
            return redirect()->back()->with('success', 'Đã xóa các biến thể được chọn !');
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }

    public function xoaSize(int $id){
        if (Auth::guard('admin')->user()->vai_tro_id == 1) {
            $kich_co=KichCo::findOrFail($id);
            if($kich_co){
                $kich_co->delete();
            }
            return redirect()->back()->with('success', 'Đã xóa thành công Size !');
        }

        return redirect()->route('admin.index');
    }

    public function xoaMauSac(int $id){
        if (Auth::guard('admin')->user()->vai_tro_id == 1) {
            $mau_sac=MauSac::findOrFail($id);
            if($mau_sac){
                $mau_sac->delete();
            }
            return redirect()->back()->with('success', 'Đã xóa thành công màu sắc !');
        }

        return redirect()->route('admin.index');
    }


    public function xoaSanPhamVinhVien(int $id){
        $san_pham=SanPham::onlyTrashed()->find($id);
        if($san_pham){

            $donHangs = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
                    ->whereIn('trang_thai', [0,1,2])->get();
            foreach ($donHangs as $key => $value) {
                $chiTietDonHangs = ChiTietDonHang::with('sanPham','bienThe')->where("don_hang_id",$value->id)->get();

                foreach ($chiTietDonHangs as $item) {
                    if($item->san_pham_id === $san_pham->id){
                        return redirect()->route('san-pham.danh-sach-san-pham-da-xoa')->with('error', 'Sản phẩm muốn xóa có đơn hàng chưa hoàn thành !');
                    }
                }
            }

            $donHangHoanThanh = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
                    ->whereIn('trang_thai', [3,4])->get();

            foreach ($donHangHoanThanh as $key => $value) {
                $chiTietDonHangs = ChiTietDonHang::with('sanPham','bienThe')->where("don_hang_id",$value->id)->get();

                foreach ($chiTietDonHangs as $item) {
                    if($item->san_pham_id === $san_pham->id){
                        $xoaDonHang = DonHang::find($item->don_hang_id);

                        if($xoaDonHang){

                            $danhGia = DanhGia::where("don_hang_id",$xoaDonHang->id)->first();
                            if($danhGia){

                                $traLoiDanhGia = TraLoiDanhGia::where("danh_gia_id",$danhGia->id)->get();
                                if($traLoiDanhGia){
                                    foreach ($traLoiDanhGia as $traLoi) {
                                        $traLoi->delete();
                                    }
                                }

                                $anhDanhGia = AnhDanhGia::where("danh_gia_id",$danhGia->id)->get();
                                if($anhDanhGia){
                                    foreach ($anhDanhGia as $anh) {

                                        if($anh->hinh_anh){
                                            Storage::disk('public')->delete($anh->hinh_anh);
                                        }
                                        $anh->delete();
                                    }
                                }

                                $danhGia->delete();

                            }

                            $item->delete();

                        }else{
                            return;
                        }

                        $xoaDonHang->delete();
                    }
                }
            }

            $bien_thes = BienThe::onlyTrashed()->where('san_pham_id',$san_pham->id)->get();
            foreach ($bien_thes as $key => $value) {
                if($value->hinh_anh){
                    Storage::disk('public')->delete($value->hinh_anh);
                }
                $value->forceDelete();
            }

            if($san_pham->hinh_anh){
                Storage::disk('public')->delete($san_pham->hinh_anh);
            }
            $san_pham->forceDelete();

            return redirect()->route('san-pham.danh-sach-san-pham-da-xoa')->with('success', 'Một mục đã bị xóa vĩnh viễn !');
        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
    }


    public function xoaBienTheVinhVien(int $id){
        $bien_the=BienThe::onlyTrashed()->find($id);

        if($bien_the){

            $donHangs = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
                    ->whereIn('trang_thai', [0,1,2])->get();
            foreach ($donHangs as $key => $value) {
                $chiTietDonHangs = ChiTietDonHang::with('sanPham','bienThe')->where("don_hang_id",$value->id)->get();

                foreach ($chiTietDonHangs as $item) {
                    if($item->bien_the_id === $bien_the->id){
                        return redirect()->route('san-pham.danh-sach-san-pham-da-xoa')->with('error', 'Biến thể muốn xóa có đơn hàng chưa hoàn thành !');
                    }
                }
            }

            $donHangHoanThanh = DonHang::with(['user', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienThe'])
            ->whereIn('trang_thai', [3,4])->get();

            foreach ($donHangHoanThanh as $key => $value) {
                $chiTietDonHangs = ChiTietDonHang::with('sanPham','bienThe')->where("don_hang_id",$value->id)->get();

                foreach ($chiTietDonHangs as $item) {
                    if($item->san_pham_id === $bien_the->san_pham_id){
                        $xoaDonHang = DonHang::find($item->don_hang_id);

                        if($xoaDonHang){

                            $danhGia = DanhGia::where("don_hang_id",$xoaDonHang->id)->first();
                            if($danhGia){

                                $traLoiDanhGia = TraLoiDanhGia::where("danh_gia_id",$danhGia->id)->get();
                                if($traLoiDanhGia){
                                    foreach ($traLoiDanhGia as $traLoi) {
                                        $traLoi->delete();
                                    }
                                }

                                $anhDanhGia = AnhDanhGia::where("danh_gia_id",$danhGia->id)->get();
                                if($anhDanhGia){
                                    foreach ($anhDanhGia as $anh) {

                                        if($anh->hinh_anh){
                                            Storage::disk('public')->delete($anh->hinh_anh);
                                        }
                                        $anh->delete();
                                    }
                                }

                                $danhGia->delete();

                            }

                            $item->delete();

                        }else{
                            return;
                        }

                        $xoaDonHang->delete();
                    }
                }
            }
            if($bien_the->hinh_anh){
                Storage::disk('public')->delete($bien_the->hinh_anh);
            }
            $bien_the->forceDelete();

            return redirect()->route('san-pham.danh-sach-san-pham-da-xoa')->with('success', 'Một mục đã bị xóa vĩnh viễn !');
        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
    }

    public function khoiPhucSanPham(int $id){
        $san_pham=SanPham::onlyTrashed()->find($id);
        if($san_pham){
            $san_pham->restore();
        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
        return redirect()->route('san-pham.danh-sach-san-pham-da-xoa')->with('success', 'Một mục đã được khôi phục !');
    }

    public function khoiPhucBienThe(int $id){
        $bien_the=BienThe::onlyTrashed()->find($id);
        if($bien_the){
            $san_pham = SanPham::find($bien_the->san_pham_id);
            if($san_pham){
                $bien_the->restore();
            }else{
                return redirect()->back()->with('error', 'Vui lòng khôi phục sản phẩm trước khi khôi phục biến thể này !');
            }

        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
        return redirect()->route('san-pham.danh-sach-san-pham-da-xoa')->with('success', 'Một mục đã được khôi phục !');
    }
}
