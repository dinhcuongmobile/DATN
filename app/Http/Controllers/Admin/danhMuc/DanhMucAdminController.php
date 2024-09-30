<?php

namespace App\Http\Controllers\Admin\DanhMuc;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DanhMucAdminController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index(Request $request)
    {
        // Lấy tất cả danh mục bao gồm không bao gồm danh mục đã bị xóa
        $danhMucs = DanhMuc::all();
        
        $query = $request->input('kyw'); // Lấy từ khóa tìm kiếm từ request
        // Sử dụng phương thức search để lấy danh sách danh mục
        $danhMucs = DanhMuc::search($query);
        return view('admin.danhMuc.DSDanhMuc', compact('danhMucs'));
    }

    // Hiển thị form tạo mới danh mục
    public function create()
    {
        return view('admin.danhMuc.add');
    }

    // Xử lý lưu danh mục mới vào DB
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|max:2048', // Nếu có hình ảnh, yêu cầu là file ảnh
        ]);

        // Lưu hình ảnh (nếu có)
        if ($request->hasFile('hinh_anh')) {
            $path = $request->file('hinh_anh')->store('danh_muc_images', 'public');
            $validatedData['hinh_anh'] = $path;
        }

        // Tạo mới danh mục
        DanhMuc::create($validatedData);

        return redirect()->route('admin.danhMuc.DSDanhMuc')->with('success', 'Danh mục đã được thêm thành công!');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit(DanhMuc $danhMuc)
    {
        return view('admin.danhMuc.update', compact('danhMuc'));
    }

    // Cập nhật danh mục
    public function update(Request $request, DanhMuc $danhMuc)
    {
        $validatedData = $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|max:2048',
        ]);

        // Nếu có hình ảnh mới, lưu và cập nhật
        if ($request->hasFile('hinh_anh')) {
            $path = $request->file('hinh_anh')->store('danh_muc_images', 'public');
            $validatedData['hinh_anh'] = $path;
        }

        // Cập nhật danh mục
        $danhMuc->update($validatedData);

        return redirect()->route('admin.danhMuc.DSDanhMuc')->with('success', 'Danh mục đã được cập nhật!');
    }

    // Xóa danh mục (soft delete)
    public function destroy($id)
{
    // Tìm danh mục theo ID
    $danhMuc = DanhMuc::findOrFail($id);
    
    // Chỉ thực hiện xóa mềm
    $danhMuc->delete();

    return redirect()->route('admin.danhMuc.DSDanhMuc')->with('success', 'Danh mục đã được xóa mềm thành công.');
}
  

    //Lấy danh sách danh mục đã bị xóa
    public function trashed()
    {
        $trashedDanhMucs = DanhMuc::onlyTrashed()->get();
        return view('admin.danhMuc.trashed', compact('trashedDanhMucs'));
    }
    public function restore($id)
    {
    $danhMuc = DanhMuc::onlyTrashed()->find($id);
    $danhMuc->restore();

    return redirect()->route('admin.danhMuc.trashed')->with('success', 'Danh mục đã được khôi phục thành công.');
    }

    public function forceDelete($id)
    {
    $danhMuc = DanhMuc::onlyTrashed()->find($id);
    if ($danhMuc->hinh_anh) {
        Storage::disk('public')->delete($danhMuc->hinh_anh);
    }
    $danhMuc->forceDelete();

    return redirect()->route('admin.danhMuc.trashed')->with('success', 'Danh mục đã được xóa vĩnh viễn.');
    }

}
