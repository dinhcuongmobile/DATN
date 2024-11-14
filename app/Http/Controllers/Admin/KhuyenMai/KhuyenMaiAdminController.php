<?php

namespace App\Http\Controllers\Admin\KhuyenMai;

use App\Models\KhuyenMai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SanPham\StoreKhuyenMaiRequest;
use App\Http\Requests\SanPham\UpdateKhuyenMaiRequest;

class KhuyenMaiAdminController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    public function danhSachMaKhuyenMaiDonHang(Request $request){
        $keyword = $request->input('kyw');

        if ($keyword) {
            $this->views['ma_khuyen_mais'] = KhuyenMai::where('so_tien_giam', $keyword)
                                            ->orWhere('gia_tri_toi_thieu', $keyword)
                                            ->orWhere('ngay_bat_dau', 'LIKE', "%$keyword%")
                                            ->orWhere('ngay_ket_thuc', 'LIKE', "%$keyword%")
                                            ->where('trang_thai',1)
                                            ->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);
        }else{
            $this->views['ma_khuyen_mais'] = KhuyenMai::where('trang_thai',1)->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.maKhuyenMai.DSMaKhuyenMai',$this->views);
    }

    public function danhSachMaKhuyenMaiVanChuyen(Request $request){
        $keyword = $request->input('kyw');

        if ($keyword) {
            $this->views['ma_khuyen_mais'] = KhuyenMai::where('so_tien_giam', $keyword)
                                            ->orWhere('gia_tri_toi_thieu', $keyword)
                                            ->orWhere('ngay_bat_dau', 'LIKE', "%$keyword%")
                                            ->orWhere('ngay_ket_thuc', 'LIKE', "%$keyword%")
                                            ->where('trang_thai',2)
                                            ->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);
        }else{
            $this->views['ma_khuyen_mais'] = KhuyenMai::where('trang_thai',2)->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.maKhuyenMai.DSMaMienPhiVanChuyen',$this->views);
    }

    public function showThemMaKhuyenMai(){
        return view('admin.maKhuyenMai.themMaKhuyenMai',$this->views);
    }

    public function showSuaMaKhuyenMai(int $id){
        $this->views['khuyen_mai']=KhuyenMai::find($id);
        return view('admin.maKhuyenMai.capNhatMaKhuyenMai',$this->views);
    }

    public function themMaKhuyenMai(StoreKhuyenMaiRequest $request){
        $dataInsert= [
            'ma_giam_gia' => $request->ma_giam_gia,
            'so_tien_giam' => $request->so_tien_giam,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'gia_tri_toi_thieu' => $request->gia_tri_toi_thieu,
            'trang_thai' => $request->trang_thai,
            'created_at' => now()
        ];

        $result= KhuyenMai::create($dataInsert);
        if($result){
            if($request->trang_thai==1){
                return redirect()->route('khuyen-mai.danh-sach-ma-khuyen-mai-don-hang')->with('success', 'Bạn đã thêm thành công mã khuyến mại mọi đơn hàng !');
            }else{
                return redirect()->route('khuyen-mai.danh-sach-ma-khuyen-mai-van-chuyen')->with('success', 'Bạn đã thêm thành công mã khuyến mại vận chuyển !');
            }
        }else{
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
        }
    }

    public function suaMaKhuyenMai(UpdateKhuyenMaiRequest $request , int $id){
        $khuyen_mai=KhuyenMai::find($id);

        $dataUpdate= [
            'so_tien_giam' => $request->so_tien_giam,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'gia_tri_toi_thieu' => $request->gia_tri_toi_thieu,
            'updated_at' => now()
        ];

        $result= $khuyen_mai->update($dataUpdate);
        if($result){
            if($request->trang_thai==1){
                return redirect()->route('khuyen-mai.danh-sach-ma-khuyen-mai-don-hang')->with('success', 'Bạn đã sửa thành công mã khuyến mại mọi đơn hàng !');
            }else{
                return redirect()->route('khuyen-mai.danh-sach-ma-khuyen-mai-van-chuyen')->with('success', 'Bạn đã sửa thành công mã khuyến mại vận chuyển !');
            }
        }else{
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thao tác lại !');
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
