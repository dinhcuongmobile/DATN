<?php

namespace App\Http\Controllers\Admin\TinTuc;

use App\Models\TinTuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TinTuc\StoreTinTucRequest;
use App\Http\Requests\TinTuc\UpdateTinTucRequest;
use App\Models\DanhMucTinTuc;
use Illuminate\Support\Facades\Auth;

class TinTucAdminController extends Controller
{
    protected $views;
    public function __construct()
    {
        $this->views = [];
    }

    //SHOW
    public function showDanhSach(Request $request)
    {
        $query = TinTuc::with('danhMucTinTuc', 'user');
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->where('tieu_de', 'LIKE', "%$keyword%")
                  ->orWhereHas('danhMucTinTuc', function($loc) use ($keyword) {
                      $loc->where('ten_danh_muc', 'LIKE', "%$keyword%");
                  })
                  ->orWhereHas('user', function($loc) use ($keyword) {
                    $loc->where('ho_va_ten', 'LIKE', "%$keyword%");
                });
        }

        $this->views['DSTinTuc'] = $query->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        return view('admin.tinTuc.DSTinTuc', $this->views);
    }

    //add
    public function viewAdd()
    {
        $this->views['dmTinTuc'] = DanhMucTinTuc::all();
        return view('admin.tinTuc.add', $this->views);
    }

    public function add(StoreTinTucRequest $request)
    {
        $danh_muc = $request->input('danh_muc_id');
        if ($request->hasFile('hinh_anh')) {
            $fileName = $request->file('hinh_anh')->store('uploads/tinTuc', 'public');
        } else {
            $fileName = null;
        }
        $dataInsert = [
            'danh_muc_id' => $danh_muc,
            'nguoi_dang' => Auth::guard('admin')->user()->id,
            'hinh_anh' => $fileName,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'ngay_dang' => now()
        ];
        $result = TinTuc::create($dataInsert);
        if ($result) {
            return redirect()->route('tin-tuc.danh-sach')->with('success','Bạn đã thêm thành công tin tức!');
        } else {
            return redirect()->back()->with('error','Thêm thất bại');
        }
    }

    //update
    public function viewUpdate(int $id)
    {
        $this->views['dmTinTuc'] = DanhMucTinTuc::all();
        $this->views['tin_tuc'] = TinTuc::find($id);
        return view('admin.tinTuc.update', $this->views);
    }

    public function update(UpdateTinTucRequest $request, int $id)
    {
        $tin_tuc = TinTuc::find($id);
        if ($request->hasFile('hinh_anh')) {
            $fileName = $request->file('hinh_anh')->store('uploads/tintuc', 'public');

            if ($tin_tuc->hinh_anh) {
                Storage::disk('public')->delete($tin_tuc->hinh_anh);
            }
        } else {
            $fileName = $tin_tuc->hinh_anh;
        }

        $dataUpdate = [
            'danh_muc_id' => $request->danh_muc_id,
            'hinh_anh' => $fileName,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'ngay_cap_nhat' => now()
        ];

        $result = $tin_tuc->update($dataUpdate);
        if ($result) {
            return redirect()->route('tin-tuc.danh-sach')->with('success', 'Cập nhật tin tức thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại');
        }
    }

    public function delete(int $id)
    {
        $tin_tuc = TinTuc::find($id);
        if ($tin_tuc) {
            $tin_tuc->delete();
            if ($tin_tuc->hinh_anh) {
                Storage::disk('public')->delete($tin_tuc->hinh_anh);
            }
            return redirect()->route('tin-tuc.danh-sach')->with('success', 'Bạn đã xóa thành công 1 tin tức.');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại');
        }
    }

    public function xoaNhieuTinTuc(Request $request)
    {
        foreach ($request->select as $id) {
            $tin_tuc = TinTuc::find($id);
            if ($tin_tuc) {
                $tin_tuc->delete();
                if ($tin_tuc->hinh_anh) {
                    Storage::disk('public')->delete($tin_tuc->hinh_anh);
                }
            } else {
                break;
            }
        }
        return redirect()->route('tin-tuc.danh-sach')->with('success', 'Bạn đã xóa thành công nhiều tin tức.');
    }
}
