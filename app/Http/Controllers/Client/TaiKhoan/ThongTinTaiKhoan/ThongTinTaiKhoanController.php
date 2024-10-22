<?php

namespace App\Http\Controllers\Client\TaiKhoan\ThongTinTaiKhoan;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaiKhoan\UpdateThongTinTaiKhoanRequest;
use App\Models\PhuongXa;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ThongTinTaiKhoanController extends Controller
{
    protected $views;

    public function __construct()
    {
        $this->views = [];
    }

    public function showThongTinTaiKhoan()
    {
        $tai_khoan = Auth::user();
        $this->views['tai_khoan'] = $tai_khoan;
        $this->views['tinh_thanh_pho'] = TinhThanhPho::orderBy('ma_tinh_thanh_pho', 'ASC')->get();

        if ($tai_khoan->dia_chi) {
            $dia_chi_full = explode(', ', $tai_khoan->dia_chi);
            if (count($dia_chi_full) == 4) {
                $dia_chi_chi_tiet = $dia_chi_full[0];
                $phuong_xa_one = $dia_chi_full[1];
                $quan_huyen_one = $dia_chi_full[2];
                $tinh_thanh_pho_one = $dia_chi_full[3];
            } else {
                $dia_chi_chi_tiet = "";
                $phuong_xa_one = $dia_chi_full[0];
                $quan_huyen_one = $dia_chi_full[1];
                $tinh_thanh_pho_one = $dia_chi_full[2];
            }
            $load_one_tinh_thanh_pho = TinhThanhPho::Where('ten_tinh_thanh_pho', 'LIKE', "%$tinh_thanh_pho_one%")->first();
            $quan_huyens = QuanHuyen::where('ma_tinh_thanh_pho', $load_one_tinh_thanh_pho->ma_tinh_thanh_pho)->orderBy('ma_quan_huyen', 'ASC')->get();
            $load_one_quan_huyen = QuanHuyen::where('ten_quan_huyen', 'LIKE', "%$quan_huyen_one%")
                ->where('ma_tinh_thanh_pho', $load_one_tinh_thanh_pho->ma_tinh_thanh_pho)->first();
            $phuong_xas = PhuongXa::where('ma_quan_huyen', $load_one_quan_huyen->ma_quan_huyen)->get();
        } else {
            $dia_chi_chi_tiet = "";
            $phuong_xa_one = "";
            $quan_huyen_one = "";
            $tinh_thanh_pho_one = "";
            $quan_huyens = [];
            $phuong_xas = [];
        }
        $this->views['dia_chi_chi_tiet'] = $dia_chi_chi_tiet;
        $this->views['phuong_xa_one'] = $phuong_xa_one;
        $this->views['quan_huyen_one'] = $quan_huyen_one;
        $this->views['tinh_thanh_pho_one'] = $tinh_thanh_pho_one;
        $this->views['quan_huyen'] = $quan_huyens;
        $this->views['phuong_xa'] = $phuong_xas;

        return view('client.taiKhoan.thongTinTaiKhoan', $this->views);
    }

    public function updateThongTinTaiKhoan(UpdateThongTinTaiKhoanRequest $request)
    {
        $user = Auth::user();

        if ($request->tinh_thanh_pho) {
            $tinh_thanh_pho = TinhThanhPho::where('ma_tinh_thanh_pho', $request->tinh_thanh_pho)->first();
            $quan_huyen = QuanHuyen::where('ma_quan_huyen', $request->quan_huyen)->first();
            $phuong_xa = PhuongXa::where('ma_phuong_xa', $request->phuong_xa)->first();
            $dia_chi = trim(implode(', ', array_filter([
                $request->dia_chi_chi_tiet,
                $phuong_xa->ten_phuong_xa,
                $quan_huyen->ten_quan_huyen,
                $tinh_thanh_pho->ten_tinh_thanh_pho
            ])));
        } else {
            $dia_chi = null;
        }

        $dataUpdate = [
            'ho_va_ten' => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $dia_chi,
            'updated_at' => now()
        ];

        if ($user instanceof User) {
            // instanceof kiểm tra xem biến $user có thuộc class User trong model ko
            $user->update($dataUpdate);

            Session::flash('success', 'Cập nhật thông tin tài khoản thành công.');

            // return redirect()->back()
            //     ->with('success', 'Cập nhật thông tin tài khoản thành công.');
            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(),
            ]);
        } else {
            Session::flash('error', 'Không thể cập nhật thông tin tài khoản. Vui lòng thử lại.');
            // return redirect()->back()
            //     ->with('error', 'Không thể cập nhật thông tin tài khoản. Vui lòng thử lại.');
            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(),
            ]);
        }
    }
}
