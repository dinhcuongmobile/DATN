<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Http\Controllers\Controller;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdminVaiTroTaiKhoanController extends Controller
{
    public function danhSachVaiTroTaiKhoan()
    {
        $vai_tros = VaiTro::query()->get();

        return view('admin.vaiTroTaiKhoan.danhSachVaiTroTaiKhoan', compact('vai_tros'));
    }

    public function hienThiTrangThemVaiTroTaiKhoan()
    {
        return view('admin.vaiTroTaiKhoan.themVaiTroTaiKhoan');
    }

    public function themVaiTroTaiKhoan(Request $request)
    {
        $request->validate(
            [
                'vai_tro' => 'required|string|max:50|unique:vai_tros,vai_tro'
            ],
            [
                'vai_tro.required' => 'Vai trò tài khoản không được bỏ trống',
                'vai_tro.max' => 'Vai trò tài khoản không quá 50 kí tự',
                'vai_tro.unique' => 'Vai trò tài khoản đã tồn tại'
            ]
        );

        VaiTro::query()->create([
            'vai_tro' => $request->vai_tro
        ]);

        Session::flash('success', 'Thêm vai trò tài khoản thành công');

        return redirect('/admin/vai-tro-tai-khoan/danh-sach');
    }

    public function hienThiTrangSuaVaiTroTaiKhoan(string $id)
    {
        $vai_tros = VaiTro::query()->findOrFail($id);

        return view('admin.vaiTroTaiKhoan.suaVaiTroTaiKhoan', compact('vai_tros'));
    }

    public function suaVaiTroTaiKhoan(Request $request, string $id)
    {
        $request->validate(
            [
                'vai_tro' => 'required|string|max:50|unique:vai_tros,vai_tro,' .$id
            ],
            [
                'vai_tro.required' => 'Vai trò tài khoản không được bỏ trống',
                'vai_tro.max' => 'Vai trò tài khoản không quá 50 kí tự',
                'vai_tro.unique' => 'Vai trò tài khoản đã tồn tại'
            ]
        );

        $vai_tros = VaiTro::query()->findOrFail($id);

        $vai_tros->update([
            'vai_tro' => $request->vai_tro
        ]);

        Session::flash('success', 'Sửa vai trò tài khoản thành công');

        return redirect('/admin/vai-tro-tai-khoan/danh-sach');
    }
}
