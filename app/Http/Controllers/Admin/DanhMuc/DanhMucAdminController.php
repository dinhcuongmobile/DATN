<?php

namespace App\Http\Controllers\Admin\DanhMuc;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DanhMuc\StoreDanhMucRequest;
use App\Http\Requests\DanhMuc\UpdateDanhMucRequest;
use App\Models\SanPham;
use Illuminate\Support\Facades\Auth;

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
            $this->views['DSDanhmuc'] = DanhMuc::where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'asc')->paginate(10)->appends(['kyw' => $keyword]);
        } else {
            $this->views['DSDanhmuc'] = DanhMuc::orderBy('id', 'asc')->paginate(10);
        }
        return view('admin.danhMuc.DSDanhMuc',$this->views);
    }

    public function danhSachDanhMucDaXoa(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSDanhmuc'] = DanhMuc::onlyTrashed()->where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'asc')->paginate(10)->appends(['kyw' => $keyword]);
        } else {
            $this->views['DSDanhmuc'] = DanhMuc::onlyTrashed()->orderBy('id', 'asc')->paginate(10);
        }
        return view('admin.danhMuc.danhSachDaXoa',$this->views);
    }

    public function danhMucSanPham(Request $request, int $id){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSDanhmuc'] = DanhMuc::where('ten_danh_muc', 'LIKE', "%$keyword%")->orderBy('id', 'asc')->paginate(10)->appends(['kyw' => $keyword]);
        } else {
            $this->views['DSDanhmuc'] = DanhMuc::where('id',$id)->orderBy('id', 'asc')->paginate(10);
        }
        return view('admin.danhMuc.DSDanhMuc',$this->views);
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
            return redirect()->route('danh-muc.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
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
            return redirect()->route('danh-muc.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
    }

    public function delete($id){
        if (Auth::guard('admin')->user()->vai_tro_id == 1) {
            $danh_muc=DanhMuc::find($id);
            if($danh_muc){
                $san_phams=SanPham::where('danh_muc_id',$danh_muc->id)->get();
                if($san_phams->isNotEmpty()){
                    foreach ($san_phams as $item) {
                        $item->update(['danh_muc_id'=>1]);
                    }
                }
                $danh_muc->delete();
    
                return redirect()->route('danh-muc.danh-sach')->with('success', 'Một mục đã được chuyển vào thùng rác !');
            }
        }

        return redirect()->route('admin.index');
    }

    public function xoaNhieuDanhMuc(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $danh_muc=DanhMuc::find($id);
                if($danh_muc){
                    $san_phams=SanPham::where('danh_muc_id',$danh_muc->id)->get();
                    if($san_phams->isNotEmpty()){
                        foreach ($san_phams as $item) {
                            $item->update(['danh_muc_id'=>1]);
                        }
                    }
                    $danh_muc->delete();
                }else{
                    return redirect()->route('danh-muc.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
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
                    if($danh_muc->hinh_anh){
                        Storage::disk('public')->delete($danh_muc->hinh_anh);
                    }
                }else{
                    return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
                }
            }
            return redirect()->route('danh-muc.danh-sach-danh-muc-da-xoa')->with('success', 'Đã xóa vĩnh viễn các mục đã chọn !');
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn xóa !');
        }

    }

    public function xoaDanhMucVinhVien(int $id){
        $danh_muc=DanhMuc::onlyTrashed()->find($id);
        if($danh_muc){
            $danh_muc->forceDelete();
            if($danh_muc->hinh_anh){
                Storage::disk('public')->delete($danh_muc->hinh_anh);
            }

        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
        return redirect()->route('danh-muc.danh-sach-danh-muc-da-xoa')->with('success', 'Một mục đã bị xóa vĩnh viễn !');
    }

    public function khoiPhucDanhMuc(int $id){
        $danh_muc=DanhMuc::onlyTrashed()->find($id);

        if($danh_muc){
            $danh_muc->restore();
        }else{
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại !');
        }
        return redirect()->route('danh-muc.danh-sach-danh-muc-da-xoa')->with('success', 'Một mục đã được khôi phục !');
    }

}
