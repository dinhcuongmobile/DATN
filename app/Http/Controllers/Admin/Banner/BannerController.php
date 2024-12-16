<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
{
    protected $banner;
    protected $views;
    public function __construct()
    {
        $this->banner = new Banner();
        $this->views = [];
    }

    public function danhSachBanner(Request $request)
    {
        $keyword = $request->input('kyw');
        $bannersQuery = Banner::query();
        if ($keyword) {
            $search =
                $this->views['DSBanner'] = Banner::where('ten_anh', 'like', '%' . $keyword . '%')
                ->orWhere('trang_thai', 'like', '%' . $keyword . '%')
                ->orWhere('ten_anh', 'like', '%' . $keyword . '%')
                ->paginate(5);
        } else {
            $this->views['DSBanner'] = $bannersQuery->paginate(5);
        }
        return view('admin.banner.DsBanner', $this->views);
    }

    public function viewAdd()
    {
        return view('admin.banner.CreateBanner');
    }
    public function storeAdd(Request $request)
    {
        $oldBanner = Banner::all();
        $request->validate([
            'ten_anh' => 'required | string | min:6 | max:255 ',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8000',
            'trang_thai' => 'required',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau'
        ]);
       
        if ($request->hasFile('hinh_anh')) {
            $filesName = $request->file('hinh_anh')->store('uploads/banners', 'public');
        } else {
            $filesName = null;
        }
        $titleBanner = $oldBanner->firstWhere('ten_anh', $request->input('ten_anh'));
        if ($titleBanner) {
            return redirect()->route('banner.viewAdd')->with('error', 'Tên hình ảnh đã tồn tại');
        } else {
            $data = [
                'ten_anh' => $request->input('ten_anh'),
                'hinh_anh' => $filesName,
                'trang_thai' => $request->input('trang_thai'),
                'ngay_bat_dau' => $request->input('ngay_bat_dau'),
                'ngay_ket_thuc' => $request->input('ngay_ket_thuc')
            ];
        }

        $res = Banner::insert($data);
        if ($res) {
            return redirect()->route('banner.dsBanner')->with('success', 'Thêm mới hình ảnh thành công');
        } else {
            return redirect()->route('banner.viewAdd')->with('error', 'Thêm mới hình ảnh không thành công');
        }
    }

    public function viewUpdate(Request $request ,int $id)
    {
        $old_banner = Banner::where('id', $id)->first();
        return view('admin.banner.UpdateBanner', compact('old_banner'));
    }

    public function Update(Request $request, $id)
    {
        $old = Banner::where('id', $id)->first();

        $request->validate([
            'ten_anh' => 'required | string | min:6 | max:255 ',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trang_thai' => 'required',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau'
        ]);
        if ($request->hasFile('hinh_anh')) {

            if ($old->hinh_anh) {
                Storage::disk('public')->delete($old->hinh_anh);
            }

            $filesName = $request->file('hinh_anh')->store('uploads/banners', 'public');
        } else {
            $filesName = $old->hinh_anh;
        }

        $data = [
            'ten_anh' => $request->input('ten_anh'),
            'hinh_anh' => $filesName,
            'trang_thai' => $request->input('trang_thai'),
            'ngay_bat_dau' => $request->input('ngay_bat_dau'),
            'ngay_ket_thuc' => $request->input('ngay_ket_thuc')
        ];

        $res = Banner::where('id', $id)->update($data);
        if ($res) {
            return redirect()->route('banner.dsBanner')->with('success', 'Cập nhật hình ảnh thành công');
        } else {
            return redirect()->route('banner.dsBanner')->with('error', 'Cập nhật hình ảnh không thành công');
        }
    }

    public function Delete($id)
    {

        $old = Banner::where('id', $id)->first();
        if ($old && $old->hinh_anh) {
            Storage::disk('public')->delete($old->hinh_anh);
            Banner::where('id', $id)->delete();
            return redirect()->route('banner.dsBanner')->with('success', 'Xóa thành công');
        } else {
            return redirect()->route('banner.dsBanner')->with('error', 'Xóa không thành công');
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->has('select') && is_array($request->select)) {
            foreach ($request->select as $id) {
                $oldbanner = Banner::where('id', $id)->first();
                if ($oldbanner) {
                    if ($oldbanner->hinh_anh) {
                        Storage::disk('public')->delete($oldbanner->hinh_anh);
                    }
                    Banner::where('id', $id)->delete();
                }
            }
            return redirect()->route('banner.dsBanner')->with('success', 'Xóa thành công');
        }
        return redirect()->route('banner.dsBanner')->with('error', 'Không có bản ghi nào được chọn');
    }
}
