<?php

namespace App\Http\Controllers\Admin\SanPham;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPham\StoreBienTheRequest;
use App\Http\Requests\SanPham\StoreSanPhamRequest;
use App\Models\BienThe;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

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

    public function danhSachAnhSanPham(){
        return view('admin.sanPham.anhSanPham.DSAnhSanPham',$this->views);
    }

    public function danhSachMaKhuyenMai(){
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

    public function showThemAnhSanPham(){
        return view('admin.sanPham.anhSanPham.themAnhSanPham');
    }

    public function showThemBienThe(){
        $this->views['san_phams']=SanPham::all();
        return view('admin.sanPham.bienThe.themBienThe',$this->views);
    }

    public function showThemMaKhuyenMai(){
        return view('admin.sanPham.maKhuyenMai.themMaKhuyenMai');
    }

    //add
    public function themSanPham(StoreSanPhamRequest $request){
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
        ];

        $result= SanPham::create($dataInsert);
        if($result){
                return redirect()->route('san-pham.danh-sach')->with('success', 'Bạn đã thêm thành công !');
        }else{
            return "<script>alert('Đã xảy ra lỗi !')</script>";
        }
    }

    public function themBienThe(StoreBienTheRequest $request){
        // $dataInsert= [
        //     'danh_muc_id' => $request->danh_muc_id,
        //     'hinh_anh' => $fileName,
        //     'ten_san_pham' => $request->ten_san_pham,
        //     'gia_san_pham' => $request->gia_san_pham,
        //     'khuyen_mai' => $request->khuyen_mai,
        //     'mo_ta' => $request->mo_ta,
        // ];

        // $result= SanPham::create($dataInsert);
        // if($result){
        //         return redirect()->route('san-pham.danh-sach')->with('success', 'Bạn đã thêm thành công !');
        // }else{
        //     return "<script>alert('Đã xảy ra lỗi !')</script>";
        // }
    }

    public function themAnhSanPham(){

    }

    public function themMaKhuyenMai(){

    }
}
