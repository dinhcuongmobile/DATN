<?php

namespace App\Http\Controllers\Admin\TaiKhoan\ThongTinTaiKhoan;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaiKhoan\UpdateThongTinTaiKhoanRequest;
use App\Models\DiaChi;
use App\Models\PhuongXa;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ThongTinTaiKhoanAdminController extends Controller
{
    protected $views;

    public function __construct()
    {
        $this->views = [];
    }

    public function showThongTinTaiKhoanAdmin()
    {
        $tai_khoan = Auth::guard('admin')->user();

        $this->views['dia_chi'] = DiaChi::with('tinhThanhPho','quanHuyen','phuongXa')
                        ->where('user_id',$tai_khoan->id)
                        ->orderBy('trang_thai','ASC')->first();

        if($this->views['dia_chi']){
            $this->views['quan_huyen'] = QuanHuyen::where('ma_tinh_thanh_pho',$this->views['dia_chi']->tinhThanhPho->ma_tinh_thanh_pho)
                                                    ->orderBy('ma_quan_huyen', 'ASC')->get();
            $this->views['phuong_xa'] = PhuongXa::where('ma_quan_huyen',$this->views['dia_chi']->quanHuyen->ma_quan_huyen)
                                                ->orderBy('ma_phuong_xa', 'ASC')->get();
        }else{
            $this->views['quan_huyen']=[];
            $this->views['phuong_xa']=[];
        }

        $this->views['tai_khoan'] = $tai_khoan;
        $this->views['tinh_thanh_pho'] = TinhThanhPho::orderBy('ma_tinh_thanh_pho', 'ASC')->get();
        return view('admin.taiKhoan.thongTinTaiKhoan', $this->views);
    }

    public function updateThongTinTaiKhoanAdmin(UpdateThongTinTaiKhoanRequest $request)
    {
        $user = Auth::guard('admin')->user();
        $dia_chi = DiaChi::where('user_id',$user->id)->orderBy('trang_thai','ASC')->first();
        $dataUpdate = [
            'ho_va_ten' => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'updated_at' => now()
        ];

        $dataUpdateDiaChi = [
            'user_id' => Auth::guard('admin')->user()->id,
            'ho_va_ten_nhan' => $request->ho_va_ten,
            'so_dien_thoai_nhan' => $request->so_dien_thoai,
            'ma_tinh_thanh_pho' => $request->tinh_thanh_pho,
            'ma_quan_huyen' => $request->quan_huyen,
            'ma_phuong_xa' => $request->phuong_xa,
            'dia_chi_chi_tiet' => $request->dia_chi_chi_tiet,
            'trang_thai' => 1,
        ];

        if ($user instanceof User) {
            // instanceof kiểm tra xem biến $user có thuộc class User trong model ko
            $user->update($dataUpdate);
            if ($dia_chi) {
                $dia_chi->update($dataUpdateDiaChi);
            } else {
                DiaChi::create($dataUpdateDiaChi);
            }


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

    public function doiMatKhauAdmin(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $validate = Validator::make(
            $request->all(),
            [
                'current_password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        // $attribute: tên của trường (trong trường hợp này là 'current_password')
                        // $value: giá trị mà người dùng đã nhập (mật khẩu hiện tại)
                        // $fail: closure để thông báo lỗi nếu mật khẩu không đúng
                        if (!Hash::check($value, Auth::guard('admin')->user()->password)) {
                            $fail('Mật khẩu hiện tại không đúng !');
                        }
                    }
                    // Kiểm tra mật khẩu cũ
                ],
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'same:new_password',
            ],
            [
                'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại !',
                'new_password.required' => 'Vui lòng nhập mật khẩu mới !',
                'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự !',
                'confirm_password.same' => 'Mật khẩu xác nhận không khớp !',
            ]
        );

        // Check validate
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        if ($user instanceof User) {
            // instanceof kiểm tra xem biến $user có thuộc class User trong model ko
            $user->update(['password' => Hash::make($request->new_password)]);

            Session::flash('success', 'Bạn đã đổi mật khẩu thành công !');

            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(), // giống redirect()->back()
            ]);
        } else {
            Session::flash('error', 'Đã có lỗi xảy ra. Vui lòng thử lại !');

            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(), // giống redirect()->back()
            ]);
        }
    }
}
