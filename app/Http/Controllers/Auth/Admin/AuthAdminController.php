<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaiKhoan\DangNhapRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function showDangNhapAdmin()
    {
        return view('auth.admin.dangNhapAdmin');
    }

    public function dangNhapAdmin(DangNhapRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->trang_thai == 0) {
                if (Auth::user()->vai_tro_id == 1 || Auth::user()->vai_tro_id == 2) {
                    return redirect()->route('admin.index');
                }

                Auth::logout();
                 
                return redirect()->back()->with('error', 'Tài khoản này không đủ quyền truy cập !');

            } elseif (Auth::user()->trang_thai == 2) {
                Auth::logout();

                return redirect()->back()->with('error', 'Tài khoản này chưa được xác thực !');

            } else {
                Auth::logout();

                return redirect()->back()->with('error', 'Tài khoản này đã bị khóa !');
            }
        }

        return redirect()->back()->with('error', 'Thông tin tài khoản không chính xác !');
    }

    public function dangXuatAdmin()
    {
        Auth::logout();

        return redirect()->route('auth.dang-nhap-admin');
    }
}
