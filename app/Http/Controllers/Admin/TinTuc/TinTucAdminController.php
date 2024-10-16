<?php

namespace App\Http\Controllers\Admin\TinTuc;

use App\Models\TinTuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TinTuc\StoreTinTucRequest;
use App\Http\Requests\TinTuc\UpdateTinTucRequest;



class TinTucAdminController extends Controller
{
    protected $views;
    protected $tin_tucs;
    public function __construct() {
        $this->views=[];
        $this->tin_tucs=new TinTuc();
    }

    //SHOW
    public function showDanhSach(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSTinTuc'] = $this->tin_tucs->searchTinTuc($keyword);
        } else {
            $this->views['DSTinTuc'] = $this->tin_tucs->loadAllTinTuc();
        }
        return view('admin.tinTuc.DSTinTuc',$this->views);
    }

    //add
    public function viewAdd(){
        return view('admin.tinTuc.add');
    }

    public function add(StoreTinTucRequest $request){
        if($request->hasFile('hinh_anh')){
            $fileName=$request->file('hinh_anh')->store('uploads/tinTuc','public');
        }else{
            $fileName=null;
        }
        $dataInsert=[
            'hinh_anh' => $fileName,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'created_at' => now()
       ];
       $result= $this->tin_tucs->addTinTuc($dataInsert);
       if(!$result){
            return redirect()->route('tin-tuc.danh-sach');
       }else{
        return "<script>alert('Đã xảy ra lỗi !')</script>";
       }
    }

    //update
    public function viewUpdate(int $id){
        $this->views['tin_tuc']=$this->tin_tucs->loadOneTinTuc($id);
        return view('admin.tinTuc.update',$this->views);
    }

    public function update(UpdateTinTucRequest $request, int $id){
        $tin_tuc=$this->tin_tucs->loadOneTinTuc($id);
        if($tin_tuc){
            if($request->hasFile('hinh_anh')){
                $fileName=$request->file('hinh_anh')->store('uploads/tinTuc','public');

                if ($tin_tuc->hinh_anh) {
                    Storage::disk('public')->delete($tin_tuc->hinh_anh);
                }
            }else{
                $fileName=$tin_tuc->hinh_anh;
            }

            $dataUpdate=[
                'hinh_anh' => $fileName,
                'tieu_de' => $request->tieu_de,
                'noi_dung' => $request->noi_dung,
                'updated_at' => now()
            ];
            $result=$this->tin_tucs->updateTinTuc($dataUpdate,$id);
            if(!$result){
                return redirect()->route('tin-tuc.danh-sach');
            }
        }else{
            return redirect()->route('tin-tuc.danh-sach')->withErrors('Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function delete(int $id){
        $tin_tuc=$this->tin_tucs->loadOneTinTuc($id);
        if($tin_tuc){
            $this->tin_tucs->deleteTinTuc($id);
            if ($tin_tuc->hinh_anh) {
                Storage::disk('public')->delete($tin_tuc->hinh_anh);
            }
            return redirect()->route('tin-tuc.danh-sach');
        }else{
            return redirect()->route('tin-tuc.danh-sach')->withErrors('Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function xoaNhieuTinTuc(Request $request){
        foreach($request->select as $id){
            $tin_tuc=$this->tin_tucs->loadOneTinTuc($id);
            if($tin_tuc){
                $this->tin_tucs->deleteTinTuc($id);
                if ($tin_tuc->hinh_anh) {
                    Storage::disk('public')->delete($tin_tuc->hinh_anh);
                }
            }else{
                break;
            }
        }
        return redirect()->route('tin-tuc.danh-sach');
    }
}
