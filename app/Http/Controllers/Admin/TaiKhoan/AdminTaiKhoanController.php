<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Models\User;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaiKhoan\AdminSuaTaiKhoanRequest;
use App\Http\Requests\Admin\TaiKhoan\AdminThemTaiKhoanRequest;
use Illuminate\Support\Facades\Session;


class AdminTaiKhoanController extends Controller
{
    protected $taiKhoan;

    protected $vaiTro;

    protected $views;

    public function __construct()
    {
        $this->taiKhoan = new User();

        $this->vaiTro = new VaiTro();

        $this->views = [];
    }

    public function danhSachQuanTriVien(Request $request)
    {
        $key = $request->input('kyw');

        if ($key) {
            $this->views['taiKhoan'] = $this->taiKhoan->timKiemTaiKhoan($key);
        } else {
            $this->views['taiKhoan'] = $this->taiKhoan->danhSachTaiKhoan();
        }

        return view('admin.taiKhoan.danhSachQuanTriVien', $this->views);
    }

    public function danhSachNhanVien(Request $request)
    {
        $key = $request->input('kyw');

        if ($key) {
            $this->views['taiKhoan'] = $this->taiKhoan->timKiemTaiKhoan($key);
        } else {
            $this->views['taiKhoan'] = $this->taiKhoan->danhSachTaiKhoan();
        }

        return view('admin.taiKhoan.danhSachNhanVien', $this->views);
    }

    public function danhSachNguoiDung(Request $request)
    {
        $key = $request->input('kyw');

        if ($key) {
            $this->views['taiKhoan'] = $this->taiKhoan->timKiemTaiKhoan($key);
        } else {
            $this->views['taiKhoan'] = $this->taiKhoan->danhSachTaiKhoan();
        }

        return view('admin.taiKhoan.danhSachNguoiDung', $this->views);
    }

    public function danhSachTaiKhoanBiKhoa(Request $request)
    {
        $key = $request->input('kyw');

        if ($key) {
            $this->views['taiKhoan'] = $this->taiKhoan->timKiemTaiKhoan($key);
        } else {
            $this->views['taiKhoan'] = $this->taiKhoan->danhSachTaiKhoan();
        }

        return view('admin.taiKhoan.danhSachTaiKhoanBiKhoa', $this->views);
    }

    public function formThemTaiKhoan()
    {
        $vaiTro = $this->vaiTro->all();

        return view('admin.taiKhoan.themTaiKhoan', compact('vaiTro'));
    }

    public function them(AdminThemTaiKhoanRequest $request) //Validate ở trong AdminThemTaiKhoanRequest
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');

            $taiKhoan = $this->taiKhoan->themTaiKhoan($params);

            if ($taiKhoan) {
                Session::flash('success', 'Thêm tài khoản thành công');
    
                if ($taiKhoan->vai_tro_id == 1) {
                    return redirect('/admin/tai-khoan/danh-sach-quan-tri-vien');
                } elseif ($taiKhoan->vai_tro_id == 2) {
                    return redirect('/admin/tai-khoan/danh-sach-nhan-vien');
                } else {
                    return redirect('/admin/tai-khoan/danh-sach-nguoi-dung');
                }
            } else {
                Session::flash('error', 'Thêm tài khoản không thành công, vui lòng thử lại');

                return back();
            }

        }
    }

    public function formSuaTaiKhoan(string $id)
    {
        $taiKhoan = $this->taiKhoan->find($id);

        $vaiTro = $this->vaiTro->all();

        return view('admin.taiKhoan.suaTaiKhoan', compact('taiKhoan', 'vaiTro'));
    }

    public function sua(AdminSuaTaiKhoanRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');

            $taiKhoan = $this->taiKhoan->find($id);

            if ($taiKhoan) {
                $this->taiKhoan->suaTaiKhoan($params, $id);

                Session::flash('success', 'Sửa tài khoản thành công');
    
                if ($taiKhoan->vai_tro_id == 1) {
                    return redirect('/admin/tai-khoan/danh-sach-quan-tri-vien');
                } elseif ($taiKhoan->vai_tro_id == 2) {
                    return redirect('/admin/tai-khoan/danh-sach-nhan-vien');
                } else {
                    return redirect('/admin/tai-khoan/danh-sach-nguoi-dung');
                }
            } else {
                Session::flash('error', 'Sửa tài khoản không thành công, vui lòng thử lại');

                return back();
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
