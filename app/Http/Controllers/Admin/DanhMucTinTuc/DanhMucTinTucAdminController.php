<?php

namespace App\Http\Controllers\Admin\DanhMucTinTuc;

use App\Models\TinTuc;
use Illuminate\Http\Request;
use App\Models\DanhMucTinTuc;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DanhMucTinTuc\StoreDanhMucTinTucRequest;
use App\Http\Requests\DanhMucTinTuc\UpdateDanhMucTinTucRequest;

class DanhMucTinTucAdminController extends Controller
{
    protected $views;
    public function __construct() {
        $this->views=[];
    }

    //SHOW
    public function showDanhSach(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSDanhmuc'] = DanhMucTinTuc::where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);
        } else {
            $this->views['DSDanhmuc'] = DanhMucTinTuc::orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.danhMucTinTuc.DSDanhMuc',$this->views);
    }

    public function danhSachDanhMucDaXoa(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSDanhmuc'] = DanhMucTinTuc::onlyTrashed()->where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'desc')->paginate(10);
        } else {
            $this->views['DSDanhmuc'] = DanhMucTinTuc::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.danhMucTinTuc.danhSachDaXoa',$this->views);
    }

    public function danhMucTinTuc(Request $request, int $id){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSDanhmuc'] = DanhMucTinTuc::where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'desc')->paginate(10);
        } else {
            $this->views['DSDanhmuc'] = DanhMucTinTuc::where('id',$id)->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.danhMucTinTuc.DSDanhMuc',$this->views);
    }

    //add
    public function viewAdd(){

        return view('admin.danhMucTinTuc.add');
    }

    public function add(StoreDanhMucTinTucRequest $request){

       $dataInsert=[
            'ten_danh_muc' => $request->ten_danh_muc,
            'created_at' => now()
       ];
       $result= DanhMucTinTuc::create($dataInsert);
       if($result){
            return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('success', 'Bạn đã thêm thành công !');
       }else{
            return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
       }
    }
    //update
    public function viewUpdate(Request $request, int $id){
        $this->views['danh_muc']=DanhMucTinTuc::findOrFail($id);
        return view('admin.danhMucTinTuc.update',$this->views);
    }

    public function update(UpdateDanhMucTinTucRequest $request, int $id){
        $danh_muc_tin_tuc=DanhMucTinTuc::findOrFail($id);

        $dataUpdate=[
            'ten_danh_muc'=> $request->ten_danh_muc,
            'updated_at' => now()
        ];
        $result=$danh_muc_tin_tuc->update($dataUpdate);
        if($result){
            return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('success', 'Bạn đã sửa thành công!');
        }else{
            return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
    }

    public function delete($id){
        $danh_muc_tin_tuc=DanhMucTinTuc::find($id);
        if($danh_muc_tin_tuc){
            $tin_tucs=TinTuc::where('danh_muc_id',$danh_muc_tin_tuc->id)->get();
            if($tin_tucs->isNotEmpty()){
                foreach ($tin_tucs as $item) {

                    $item->forceDelete();
                }
            }
            $danh_muc_tin_tuc->delete();

            return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('success', 'Một mục đã được chuyển vào thùng rác !');
        }
    }

    public function xoaNhieuDanhMuc(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $danh_muc=DanhMucTinTuc::find($id);
                if($danh_muc){
                    $tin_tucs=TinTuc::where('danh_muc_id',$danh_muc->id)->get();
                    if($tin_tucs->isNotEmpty()){
                        foreach ($tin_tucs as $item) {
                            $item->delete();
                        }
                    }
                    $danh_muc->delete();
                }else{
                    return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
                }
            }
            return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('success', 'Đã chuyển các mục vào thùng rác !');
        }else{
            return redirect()->route('danh-muc-tin-tuc.danh-sach')->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }

    public function xoaNhieuDanhMucVinhVien(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $danh_muc=DanhMucTinTuc::onlyTrashed()->find($id);
                if($danh_muc){
                    $danh_muc->forceDelete();
                }else{
                    return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
                }
            }
            return redirect()->route('danh-muc-tin-tuc.danh-sach-danh-muc-da-xoa')->with('success', 'Đã xóa vĩnh viễn các mục đã chọn !');
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn xóa !');
        }

    }

    public function xoaDanhMucVinhVien(int $id){
        $danh_muc_tin_tuc=DanhMucTinTuc::onlyTrashed()->find($id);
        if($danh_muc_tin_tuc){
            $danh_muc_tin_tuc->forceDelete();

        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
        return redirect()->route('danh-muc-tin-tuc.danh-sach-danh-muc-da-xoa')->with('success', 'Một mục đã bị xóa vĩnh viễn !');
    }

    public function khoiPhucDanhMuc(int $id){
        $danh_muc_tin_tuc=DanhMucTinTuc::onlyTrashed()->find($id);

        if($danh_muc_tin_tuc){
            $danh_muc_tin_tuc->restore();
        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
        return redirect()->route('danh-muc-tin-tuc.danh-sach-danh-muc-da-xoa')->with('success', 'Một mục đã được khôi phục !');
    }

}
