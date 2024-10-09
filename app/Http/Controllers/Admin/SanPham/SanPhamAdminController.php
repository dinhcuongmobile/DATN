<?php

namespace App\Http\Controllers\Admin\SanPham;

use App\Models\BienThe;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\AnhSanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SanPham\StoreBienTheRequest;
use App\Http\Requests\SanPham\StoreKhuyenMaiRequest;
use App\Http\Requests\SanPham\StoreSanPhamRequest;
use App\Http\Requests\SanPham\UpdateBienTheRequest;
use App\Http\Requests\SanPham\UpdateKhuyenMaiRequest;
use App\Http\Requests\SanPham\UpdateSanPhamRequest;
use App\Models\KhuyenMai;

class SanPhamAdminController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    //show
    public function danhSachSanPham(Request $request){
        $query = SanPham::with('danhMuc', 'bienThes');
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->where('ten_san_pham', 'LIKE', "%$keyword%")
                  ->orWhereHas('danhMuc', function($loc) use ($keyword) {
                      $loc->where('ten_danh_muc', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['san_phams'] = $query->orderBy('id', 'desc')->paginate(10);

        foreach ($this->views['san_phams'] as $san_pham) {
            $san_pham->tong_so_luong = $san_pham->bienThes->sum('so_luong');
        }

        return view('admin.sanPham.DSSanPham', $this->views);
    }

    public function danhSachBienThe(Request $request){
        $query = BienThe::with('sanPham');
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->whereHas('sanPham', function($loc) use ($keyword) {
                      $loc->where('ten_san_pham', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['bien_thes'] = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.sanPham.bienThe.DSBienThe',$this->views);
    }

    public function loadBienTheOneSanPham(Request $request, int $id){
        $query= BienThe::with('sanPham')->where('san_pham_id',$id);
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->whereHas('sanPham', function($loc) use ($keyword) {
                      $loc->where('ten_san_pham', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['bien_thes'] = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.sanPham.bienThe.DSBienThe',$this->views);
    }

    public function loadOneSanPham(Request $request, int $id){
        $query = SanPham::with('danhMuc')->where('id',$id);
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->where('ten_san_pham', 'LIKE', "%$keyword%")
                  ->orWhereHas('danhMuc', function($loc) use ($keyword) {
                      $loc->where('ten_danh_muc', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['san_phams'] = $query->orderBy('id', 'desc')->paginate(10);

        foreach ($this->views['san_phams'] as $san_pham) {
            $san_pham->tong_so_luong = $san_pham->bienThes->sum('so_luong');
        }

        return view('admin.sanPham.DSSanPham',$this->views);
    }

    public function danhSachMaKhuyenMai(Request $request){
        $query = KhuyenMai::with('sanPham');
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->whereHas('sanPham', function($loc) use ($keyword) {
                      $loc->where('ten_san_pham', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['ma_khuyen_mais'] = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.sanPham.maKhuyenMai.DSMaKhuyenMai',$this->views);
    }

    public function loadKhuyenMaiOneSanPham(Request $request, int $id){
        $query= KhuyenMai::with('sanPham')->where('san_pham_id',$id);
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->whereHas('sanPham', function($loc) use ($keyword) {
                      $loc->where('ten_san_pham', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['ma_khuyen_mais'] = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.sanPham.maKhuyenMai.DSMaKhuyenMai',$this->views);
    }

    public function danhSachDaXoa(){
        return view('admin.sanPham.DSSanPhamDaXoa',$this->views);
    }

    //show them
    public function showThemSanPham(){
        $this->views['danh_mucs']= DanhMuc::all();
        return view('admin.sanPham.themSanPham',$this->views);
    }

    public function showThemBienThe(){
        $this->views['san_phams']=SanPham::all();
        return view('admin.sanPham.bienThe.themBienThe',$this->views);
    }

    public function showThemMaKhuyenMai(){
        $this->views['san_phams']=SanPham::all();
        return view('admin.sanPham.maKhuyenMai.themMaKhuyenMai',$this->views);
    }

    //show update
    public function showSuaSanPham(int $id){
        $this->views['san_pham']=SanPham::findOrFail($id);
        $this->views['danh_mucs']=DanhMuc::all();
        return view('admin.sanPham.capNhatSanPham',$this->views);
    }

    public function showSuaBienThe(int $id){
        $this->views['bien_the']=BienThe::findOrFail($id);
        $this->views['san_phams']=SanPham::all();
        return view('admin.sanPham.bienThe.capNhatBienThe',$this->views);
    }

    public function showSuaMaKhuyenMai(int $id){
        $this->views['khuyen_mai']=KhuyenMai::findOrFail($id);
        $this->views['san_phams']=SanPham::all();
        return view('admin.sanPham.maKhuyenMai.capNhatMaKhuyenMai',$this->views);
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


    public function themMaKhuyenMai(StoreKhuyenMaiRequest $request){
        $khuyen_mai = KhuyenMai::where('ma_giam_gia', $request->ma_giam_gia)
                       ->where('san_pham_id', $request->san_pham_id)
                       ->first();

        if ($khuyen_mai) {
            return redirect()->back()->with(['error' => 'Mã khuyến mại này đã được tạo từ trước !']);
        }
        $dataInsert= [
            'ma_giam_gia' => $request->ma_giam_gia,
            'so_tien_giam' => $request->so_tien_giam,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'gia_tri_toi_thieu' => $request->gia_tri_toi_thieu,
            'san_pham_id' => $request->san_pham_id,
            'created_at' => now()
        ];

        $result= KhuyenMai::create($dataInsert);
        if($result){
                return redirect()->route('san-pham.danh-sach-ma-khuyen-mai')->with('success', 'Bạn đã thêm thành công !');
        }else{
            return redirect()->route('san-pham.danh-sach-ma-khuyen-mai')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    //update
    public function suaSanPham(UpdateSanPhamRequest $request , int $id){
        $san_pham=SanPham::findOrFail($id);

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

    public function suaMaKhuyenMai(UpdateKhuyenMaiRequest $request , int $id){
        $khuyen_mai=KhuyenMai::find($id);

        if($request->ma_giam_gia!=$khuyen_mai->ma_giam_gia ||
            $request->san_pham_id!=$khuyen_mai->san_pham_id)
        {
            $khuyen_mai = KhuyenMai::where('ma_giam_gia', $request->ma_giam_gia)
                                ->where('san_pham_id', $request->san_pham_id)
                                ->first();
            if ($khuyen_mai) {
            return redirect()->back()->with(['error' => 'Mã khuyến mại này đã được tạo từ trước !']);
            }
        }

        $dataUpdate= [
            'ma_giam_gia' => $request->ma_giam_gia,
            'so_tien_giam' => $request->so_tien_giam,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'gia_tri_toi_thieu' => $request->gia_tri_toi_thieu,
            'san_pham_id' => $request->san_pham_id,
            'updated_at' => now()
        ];

        $result= $khuyen_mai->update($dataUpdate);
        if($result){
                return redirect()->route('san-pham.danh-sach-ma-khuyen-mai')->with('success', 'Bạn đã sửa thành công !');
        }else{
            return redirect()->route('san-pham.danh-sach-ma-khuyen-mai')->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    //delete
    public function xoaSanPham(int $id){
        $san_pham=SanPham::findOrFail($id);
        $san_pham->delete();
        BienThe::where('san_pham_id',$san_pham->id)->delete();
        return redirect()->back()->with('success', 'Một mục đã được chuyển vào thùng rác !');
    }

    public function xoaNhieuSanPham(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $san_pham=SanPham::findOrFail($id);
                $san_pham->delete();
                BienThe::where('san_pham_id',$san_pham->id)->delete();
            }
            return redirect()->back()->with('success', 'Đã chuyển các mục vào thùng rác !');
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }

    public function xoaBienThe(int $id){
        $bien_the=BienThe::findOrFail($id);
        $bien_the->delete();
        return redirect()->back()->with('success', 'Đã xóa thành công biến thể !');
    }

    public function xoaNhieuBienThe(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $bien_the=BienThe::findOrFail($id);
                $bien_the->delete();
            }
            return redirect()->back()->with('success', 'Đã xóa các biến thể được chọn !');
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }

    public function xoaKhuyenMai(int $id){
        $khuyen_mai=KhuyenMai::findOrFail($id);
        $khuyen_mai->delete();
        return redirect()->back()->with('success', 'Đã xóa thành công mã khuyến mại !');
    }

    public function xoaNhieuKhuyenMai(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $khuyen_mai=KhuyenMai::findOrFail($id);
                $khuyen_mai->delete();
            }
            return redirect()->back()->with('success', 'Đã xóa các mã khuyến mại được chọn !');
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }
}
