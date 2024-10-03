<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Models\User;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreTaiKhoanRequest;

class AdminTaiKhoanController extends Controller
{
    public function danhSachQuanTriVien()
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 0)->get(); // with('vaiTro) là eloquent bên Model User

        return view('admin.taiKhoan.danhSachQuanTriVien', compact('taiKhoan'));
    }

    public function danhSachNhanVien()
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 0)->get();

        return view('admin.taiKhoan.danhSachNhanVien', compact('taiKhoan'));
    }

    public function danhSachNguoiDung()
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 0)->get();

        return view('admin.taiKhoan.danhSachNguoiDung', compact('taiKhoan'));
    }

    public function danhSachTaiKhoanBiKhoa()
    {
        $taiKhoan = User::with('vaiTro')->where('trang_thai', 1)->get();

        return view('admin.taiKhoan.danhSachTaiKhoanBiKhoa', compact('taiKhoan'));
    }

    public function themTaiKhoan()
    {
        $vaiTro = VaiTro::all();

        return view('admin.taiKhoan.themTaiKhoan', compact('vaiTro'));
    }

    public function them(StoreTaiKhoanRequest $request) //Validate ở trong AdminTaiKhoanRequest
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');

            $taiKhoan = User::query()->create($params);

            Session::flash('success', 'Thêm tài khoản thành công');

            if ($taiKhoan->vai_tro_id == 1) {
                return redirect('/admin/tai-khoan/danh-sach-quan-tri-vien');
            } elseif ($taiKhoan->vai_tro_id == 2) {
                return redirect('/admin/tai-khoan/danh-sach-nhan-vien');
            } else {
                return redirect('/admin/tai-khoan/danh-sach-nguoi-dung');
            }
        }
    }

    public function suaTaiKhoan(string $id)
    {
        $taiKhoan = User::query()->findOrFail($id);

        $vaiTro = VaiTro::all();

        return view('admin.taiKhoan.suaTaiKhoan', compact('taiKhoan', 'vaiTro'));
    }

    public function sua(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');

            $request->validate([
                'ho_va_ten' => 'required|string|max:50',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users,email,' .$id,
                    'regex:/^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/',
                ],
                'password' => 'required|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/',
                'vai_tro_id' => 'required|exists:vai_tros,id',
                'so_dien_thoai' => 'required|regex:/^0\d{9}$/|unique:users,so_dien_thoai,' .$id,
            ], [
                'ho_va_ten.required' => 'Họ và tên không được trống',
                'ho_va_ten.max' => 'Họ và tên không quá 50 ký tự',

                'email.required' => 'Email không được trống',
                'email.regex' => 'Email không hợp lệ',
                'email.max' => 'Email không quá 255 ký tự',
                'email.unique' => 'Email đã tồn tại',
                'email.email' => 'Email sai định dạng',

                'password.required' => 'Mật khẩu không được trống',
                'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
                'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa, một chữ cái viết thường, một chữ số',

                'vai_tro_id.required' => 'Vai trò không được trống',
                'vai_tro_id.exists' => 'Vai trò không hợp lệ',

                'so_dien_thoai.required' => 'Số điện thoại không được trống',
                'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại',
                'so_dien_thoai.regex' => 'Số điện thoại phải là số và 10 chữ số  bắt đầu bằng số 0.',
            ]);

            $taiKhoan = User::query()->findOrFail($id);

            $taiKhoan->update($params);

            Session::flash('success', 'Sửa tài khoản thành công');

            if ($taiKhoan->vai_tro_id == 1) {
                return redirect('/admin/tai-khoan/danh-sach-quan-tri-vien');
            } elseif ($taiKhoan->vai_tro_id == 2) {
                return redirect('/admin/tai-khoan/danh-sach-nhan-vien');
            } else {
                return redirect('/admin/tai-khoan/danh-sach-nguoi-dung');
            }
        }
    }

    public function khoaTaiKhoan(Request $request, string $id)
    {
        $taiKhoan = User::query()->findOrFail($id);

        $taiKhoan->trang_thai = 1;

        $taiKhoan->save();

        Session::flash('success', 'Khóa tài khoản thành công');

        return redirect('/admin/tai-khoan/danh-sach-tai-khoan-bi-khoa');
    }

    public function moKhoaTaiKhoan(Request $request, string $id)
    {
        $taiKhoan = User::query()->findOrFail($id);

        $taiKhoan->trang_thai = 0;

        $taiKhoan->save();

        Session::flash('success', 'Mở khóa tài khoản thành công');

        if ($taiKhoan->vai_tro_id == 1) {
            return redirect('/admin/tai-khoan/danh-sach-quan-tri-vien');
        } elseif ($taiKhoan->vai_tro_id == 2) {
            return redirect('/admin/tai-khoan/danh-sach-nhan-vien');
        } else {
            return redirect('/admin/tai-khoan/danh-sach-nguoi-dung');
        }
    }
}
