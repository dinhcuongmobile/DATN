<?php

namespace App\Http\Controllers\Admin\TinTuc;

use App\Models\TinTuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TinTuc\StoreTinTucRequest;
use App\Http\Requests\TinTuc\UpdateTinTucRequest;
use App\Models\DanhMucTinTuc;

class TinTucAdminController extends Controller
{
    protected $views;
    protected $tin_tucs;
    public function __construct()
    {
        $this->views = [];
        $this->tin_tucs = new TinTuc();
    }

    //SHOW
    public function showDanhSach(Request $request)
    {
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSTinTuc'] = $this->tin_tucs->searchTinTuc($keyword);
        } else {
            $this->views['DSTinTuc'] = $this->tin_tucs->loadAllTinTuc();
        }
        return view('admin.tinTuc.DSTinTuc', $this->views);
    }

    //add
    public function viewAdd()
    {
        $dmTinTuc = DanhMucTinTuc::all();
        return view('admin.tinTuc.add', compact('dmTinTuc'));
    }

    public function add(StoreTinTucRequest $request)
    {
        $tinTuc = TinTuc::all();
        $danh_muc = $request->input('danh_muc_id');
        if ($request->hasFile('hinh_anh')) {
            $fileName = $request->file('hinh_anh')->store('uploads/tinTuc', 'public');
        } else {
            $fileName = null;
        }
        $dataInsert = [
            'danh_muc_id' => $danh_muc,
            'hinh_anh' => $fileName,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'created_at' => now()
        ];
        $result = $this->tin_tucs->addTinTuc($dataInsert);
        if (!$result) {
            return redirect()->route(route: 'tin-tuc.danh-sach');
        } else {
            return "<script>alert('Đã xảy ra lỗi !')</script>";
        }
    }

    //update
    public function viewUpdate(int $id)
    {
        $dmTinTuc = DanhMucTinTuc::all();
        $this->views['tin_tuc'] = $this->tin_tucs->loadOneTinTuc($id);
        return view('admin.tinTuc.update', $this->views, compact('dmTinTuc'));
    }

    public function update(UpdateTinTucRequest $request, int $id)
    {
        $tin_tuc = $this->tin_tucs->loadOneTinTuc($id);
        $danh_muc = $request->input('danh_muc_id');
        if ($request->hasFile('hinh_anh')) {
            $fileName = $request->file('hinh_anh')->store('uploads/tintuc', 'public');

            if ($tin_tuc->hinh_anh) {
                Storage::disk('public')->delete($tin_tuc->hinh_anh);
            }
        } else {
            $fileName = $tin_tuc->hinh_anh;
        }

        $dataUpdate = [
            'danh_muc_id' => $danh_muc,
            'hinh_anh' => $fileName,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'updated_at' => now()
        ];

        $result = $this->tin_tucs->updateTinTuc($dataUpdate, $id);
        if ($request) {
            return redirect()->route('tin-tuc.danh-sach')->with('success', 'Cập nhật tin tức thành công');
        } else {
            return redirect()->route('tin-tuc.danh-sach')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại');
        }
    }

    public function delete(int $id)
    {
        $tin_tuc = $this->tin_tucs->loadOneTinTuc($id);
        if ($tin_tuc) {
            $this->tin_tucs->deleteTinTuc($id);
            if ($tin_tuc->hinh_anh) {
                Storage::disk('public')->delete($tin_tuc->hinh_anh);
            }
            return redirect()->route('tin-tuc.danh-sach');
        } else {
            return redirect()->route('tin-tuc.danh-sach')->withErrors('Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function xoaNhieuTinTuc(Request $request)
    {
        foreach ($request->select as $id) {
            $tin_tuc = $this->tin_tucs->loadOneTinTuc($id);
            if ($tin_tuc) {
                $this->tin_tucs->deleteTinTuc($id);
                if ($tin_tuc->hinh_anh) {
                    Storage::disk('public')->delete($tin_tuc->hinh_anh);
                }
            } else {
                break;
            }
        }
        return redirect()->route('tin-tuc.danh-sach');
    }
}
