<?php

namespace App\Http\Controllers\Admin\DanhMuc;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DanhMuc\StoreDanhMucRequest;
use App\Http\Requests\DanhMuc\UpdateDanhMucRequest;

class DanhMucAdminController extends Controller
{
    protected $views;
    public function __construct() {
        $this->views=[];
    }

    //SHOW
    public function showDanhSach(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSDanhmuc'] = DanhMuc::where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'desc')->paginate(10);
        } else {
            $this->views['DSDanhmuc'] = DanhMuc::orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.danhMuc.DSDanhMuc',$this->views);
    }

    public function danhSachDanhMucDaXoa(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSDanhmuc'] = DanhMuc::onlyTrashed()->where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'desc')->paginate(10);
        } else {
            $this->views['DSDanhmuc'] = DanhMuc::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.danhMuc.danhSachDaXoa',$this->views);
    }

    //add
    public function viewAdd(){
        
        return view('admin.danhMuc.add');
    }

    public function add(StoreDanhMucRequest $request){
        if($request->hasFile('hinh_anh')){
            $fileName=$request->file('hinh_anh')->store('uploads/danhMuc','public');
        }else{
            $fileName=null;
        }
       $dataInsert=[
            'hinh_anh' => $fileName,
            'ten_danh_muc' => $request->ten_danh_muc,
            'created_at' => now()
       ];
       $result= DanhMuc::create($dataInsert);
       if($result){
            return redirect()->route('danh-muc.danh-sach')->with('success', 'Bạn đã thêm thành công !');
       }else{
        return "<script>alert('Đã xảy ra lỗi !')</script>";
       }
    }
    //update
    public function viewUpdate(int $id){
        $this->views['danh_muc']=DanhMuc::findOrFail($id);
        return view('admin.danhMuc.update',$this->views);
    }

    public function update(UpdateDanhMucRequest $request, int $id){
        $danh_muc=DanhMuc::findOrFail($id);
        if($request->hasFile('hinh_anh')){
            $fileName=$request->file('hinh_anh')->store('uploads/danhMuc','public');

            if ($danh_muc->hinh_anh) {
                Storage::disk('public')->delete($danh_muc->hinh_anh);
            }
        }else{
            $fileName=$danh_muc->hinh_anh;
        }
        $dataUpdate=[
            'hinh_anh' => $fileName,
            'ten_danh_muc'=> $request->ten_danh_muc,
            'updated_at' => now()
        ];
        $result=$danh_muc->update($dataUpdate);
        if($result){
            return redirect()->route('danh-muc.danh-sach')->with('success', 'Bạn đã sửa thành công!');
        }else{
            return "<script>alert('Đã xảy ra lỗi !')</script>";
        }
    }

    public function delete($id){
        $danh_muc=DanhMuc::findOrFail($id);
        if($danh_muc){
            $danh_muc->delete();
            return redirect()->route('danh-muc.danh-sach')->with('success', 'Một mục đã được chuyển vào thùng rác !');
        }
    }

    public function xoaNhieuDanhMuc(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $danh_muc=DanhMuc::find($id);
                if($danh_muc){
                    $danh_muc->delete();
                }else{
                    return redirect()->route('admin.index');
                }
            }
            return redirect()->route('danh-muc.danh-sach')->with('success', 'Đã chuyển các mục vào thùng rác !');
        }else{
            return redirect()->route('danh-muc.danh-sach')->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }

    public function xoaNhieuDanhMucVinhVien(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $danh_muc=DanhMuc::onlyTrashed()->find($id);
                if($danh_muc){
                    $danh_muc->forceDelete();
                }else{
                    return redirect()->route('admin.index');
                }
            }
            return redirect()->route('danh-muc.danh-sach-danh-muc-da-xoa')->with('success', 'Đã xóa vĩnh viễn các mục đã chọn !');
        }else{
            return redirect()->route('danh-muc.danh-sach-danh-muc-da-xoa')->with('error', 'Vui lòng chọn mục muốn xóa !');
        }

    }

    public function xoaDanhMucVinhVien(int $id){
        $danh_muc=DanhMuc::onlyTrashed()->find($id);
        if($danh_muc){
            $danh_muc->forceDelete();
        }else{
            return redirect()->route('admin.index');
        }
        return redirect()->route('danh-muc.danh-sach-danh-muc-da-xoa')->with('success', 'Một mục đã bị xóa vĩnh viễn !');
    }

    public function khoiPhucDanhMuc(int $id){
        $danh_muc=DanhMuc::onlyTrashed()->find($id);

        if($danh_muc){
            $danh_muc->restore();
        }else{
            return redirect()->route('admin.index');
        }
        return redirect()->route('danh-muc.danh-sach-danh-muc-da-xoa')->with('success', 'Một mục đã được khôi phục !');
    }

}
