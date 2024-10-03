<?php

namespace App\Http\Controllers\Admin\DanhMuc;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DanhMucAdminController extends Controller
{
    // Hiển thị danh sách các danh mục
    public function showDanhSach()
    {
        $danhMucs = DanhMuc::all();
        return view('admin.danhMuc.danhSach', compact('danhMucs'));
    }

    // Hiển thị trang thêm danh mục
    public function viewAdd()
    {
        return view('admin.danhMuc.them');
    }

    // Xử lý thêm danh mục
    public function add(Request $request)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Xác thực file ảnh
        ]);

        $hinhAnhPath = null;

        if ($request->hasFile('hinh_anh')) {
            $hinhAnhPath = $request->file('hinh_anh')->store('danh_muc_images', 'public'); // Lưu ảnh vào thư mục 'public/storage/danh_muc_images'
        }

        DanhMuc::create([
            'ten_danh_muc' => $request->ten_danh_muc,
            'hinh_anh' => $hinhAnhPath,
        ]);

        return redirect()->route('danh-muc.danh-sach')->with('success', 'Thêm danh mục thành công!');
    }

    // Hiển thị trang sửa danh mục
    public function viewUpdate($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        return view('admin.danhMuc.sua', compact('danhMuc'));
    }

    // Xử lý cập nhật danh mục
    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Xác thực file ảnh
        ]);

        $danhMuc = DanhMuc::findOrFail($id);

        // Kiểm tra xem có file ảnh mới không
        if ($request->hasFile('hinh_anh')) {
            // Xóa ảnh cũ nếu có
            if ($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)) {
                Storage::disk('public')->delete($danhMuc->hinh_anh);
            }

            // Lưu ảnh mới
            $hinhAnhPath = $request->file('hinh_anh')->store('danh_muc_images', 'public');
            $danhMuc->hinh_anh = $hinhAnhPath;
        }

        $danhMuc->update([
            'ten_danh_muc' => $request->ten_danh_muc,
            'hinh_anh' => $danhMuc->hinh_anh,
        ]);

        return redirect()->route('danh-muc.danh-sach')->with('success', 'Sửa danh mục thành công!');
    }

    // Xóa danh mục
    public function delete($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);

        // Xóa ảnh nếu có
        if ($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)) {
            Storage::disk('public')->delete($danhMuc->hinh_anh);
        }

        $danhMuc->delete();

        return redirect()->route('danh-muc.danh-sach')->with('success', 'Xóa danh mục thành công!');
    }
}
