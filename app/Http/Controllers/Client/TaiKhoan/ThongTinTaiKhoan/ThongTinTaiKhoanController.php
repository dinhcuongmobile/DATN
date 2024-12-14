<?php

namespace App\Http\Controllers\Client\TaiKhoan\ThongTinTaiKhoan;

use Carbon\Carbon;
use App\Models\Coin;
use App\Models\User;
use App\Models\DiaChi;
use App\Models\DanhGia;
use App\Models\DonHang;
use App\Models\PhuongXa;
use App\Models\YeuThich;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaiKhoan\UpdateThongTinTaiKhoanRequest;
use App\Models\ThongBao;

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
        $this->views['dia_chi'] = DiaChi::where('user_id', $tai_khoan->id)->orderBy('trang_thai', 'ASC')->first();

        if ($this->views['dia_chi']) {
            $this->views['quan_huyen'] = QuanHuyen::where('ma_tinh_thanh_pho', $this->views['dia_chi']->tinhThanhPho->ma_tinh_thanh_pho)
                ->orderBy('ma_quan_huyen', 'ASC')->get();
            $this->views['phuong_xa'] = PhuongXa::where('ma_quan_huyen', $this->views['dia_chi']->quanHuyen->ma_quan_huyen)
                ->orderBy('ma_phuong_xa', 'ASC')->get();
        } else {
            $this->views['quan_huyen'] = [];
            $this->views['phuong_xa'] = [];
        }

        // tap dia chi
        $this->views['dia_chis'] = DiaChi::where('user_id', $tai_khoan->id)->get();

        $this->views['tai_khoan'] = $tai_khoan;
        $this->views['tinh_thanh_pho'] = TinhThanhPho::orderBy('ma_tinh_thanh_pho', 'ASC')->get();

        $this->views['tongCoin'] = Coin::where('user_id', $tai_khoan->id)->sum('coin');
        $this->views['countDonHang'] = DonHang::where('user_id', $tai_khoan->id)->count();

        //yeu thich
        $this->views['yeu_thichs'] = [];

        if (Auth::check()) {
            $yeu_thichs = YeuThich::with('user', 'sanPham')->where('user_id', Auth::user()->id)
                                ->orderBy('id', 'desc')
                                ->get();

            $this->views['yeu_thichs'] = $yeu_thichs;
        }

        //thong bao
        $thong_baos = ThongBao::where('user_id', Auth::id())
                                ->orderBy('created_at', 'desc')
                                ->get();
        $this->views['thong_baos'] = $thong_baos;
        
        // don hang
        $don_hangs = [
            'trang_thai_all' => DonHang::with('user', 'diaChi')->where('user_id', Auth::user()->id)->orderBy('ngay_cap_nhat', 'desc')->get(),
            //chua duyet
            'trang_thai_0' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 0)->orderBy('ngay_cap_nhat', 'desc')->get(),
            //dang chuan bi hang
            'trang_thai_1' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 1)->orderBy('ngay_cap_nhat', 'desc')->get(),
            //dang giao
            'trang_thai_2' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 2)->orderBy('ngay_cap_nhat', 'desc')->get(),
            //da giao
            'trang_thai_3' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 3)->orderBy('ngay_cap_nhat', 'desc')->get(),
            //da huy
            'trang_thai_4' => DonHang::where('user_id', Auth::user()->id)->where('trang_thai', 4)->orderBy('ngay_cap_nhat', 'desc')->get(),
        ];

        $chi_tiet_don_hangs = [];
        $chua_danh_gia = [];
        $checkChiTietDanhGia = [];
        $ngayQuyDinh = Carbon::now()->subDays(3);

        foreach ($don_hangs as $items) {
            foreach ($items as $item) {
                $chi_tiet_don_hangs[$item->id] = ChiTietDonHang::with('sanPham', 'bienThe')
                                                ->where('don_hang_id', $item->id)
                                                ->get();

                // Kiểm tra xem đơn hàng đã được đánh giá hết chưa
                $checkChiTietDanhGia[$item->id] = ChiTietDonHang::with('sanPham', 'bienThe')
                                                ->where('don_hang_id', $item->id)
                                                ->where('updated_at', '>=', $ngayQuyDinh)
                                                ->get();
                $danh_gia = DanhGia::whereIn('san_pham_id', $checkChiTietDanhGia[$item->id]
                                    ->pluck('san_pham_id'))->where('user_id', Auth::id())->where('don_hang_id',$item->id)
                                    ->withTrashed()
                                    ->get();

                // Nếu có ít nhất một sản phẩm chưa được đánh giá, thì lưu lại
                $chua_danh_gia[$item->id] = $checkChiTietDanhGia[$item->id]->count() > $danh_gia->count();
            }
        }
        $this->views['don_hangs'] = $don_hangs;
        $this->views['chi_tiet_don_hangs'] = $chi_tiet_don_hangs;
        $this->views['chua_danh_gia'] = $chua_danh_gia;
        return view('client.taiKhoan.thongTinTaiKhoan', $this->views);
    }

    public function suaThongTin(Request $request)
    {
        if ($request->has('ho_va_ten')) {
            $result = User::where('id', $request->input('user_id'))->update(['ho_va_ten' => $request->input('ho_va_ten')]);
            if ($result) {
                $user = User::find($request->input('user_id'));
                return response()->json(['success' => true, 'user' => $user]);
            } else {
                return response()->json(['success' => false]);
            }
        }
        if ($request->has('so_dien_thoai')) {
            $result = User::where('id', $request->input('user_id'))->update(['so_dien_thoai' => $request->input('so_dien_thoai')]);
            if ($result) {
                $user = User::find($request->input('user_id'));
                return response()->json(['success' => true, 'user' => $user]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function layDiaChiSua(Request $request)
    {

        $dia_chi = DiaChi::with('user', 'tinhThanhPho', 'quanHuyen', 'phuongXa')->find($request->input('dia_chi_id'));
        $tinh_thanh_pho = TinhThanhPho::orderBy('ma_tinh_thanh_pho', 'ASC')->get();
        $quan_huyen = QuanHuyen::where('ma_tinh_thanh_pho', $dia_chi->ma_tinh_thanh_pho)->orderBy('ma_quan_huyen', 'ASC')->get();
        $phuong_xa = PhuongXa::where('ma_quan_huyen', $dia_chi->ma_quan_huyen)->orderBy('ma_phuong_xa', 'ASC')->get();
        if ($dia_chi) {
            return response()->json(
                [
                    'success' => true,
                    'dia_chi' => $dia_chi,
                    'tinh_thanh_pho' => $tinh_thanh_pho,
                    'quan_huyen' => $quan_huyen,
                    'phuong_xa' => $phuong_xa
                ]
            );
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function thietLapDiaChiMacDinh(Request $request)
    {
        DiaChi::where('user_id', Auth::user()->id)->where('trang_thai', 1)->update(['trang_thai' => 2]);
        $result = DiaChi::where('id', $request->input('dia_chi_id'))->where('user_id', Auth::user()->id)->update(['trang_thai' => 1]);
        if ($result) {
            $dia_chi = DiaChi::with('user', 'tinhThanhPho', 'quanHuyen', 'phuongXa')->find($request->input('dia_chi_id'));
            return response()->json(['success' => true, 'dia_chi' => $dia_chi]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function suaDiaChi(Request $request)
    {
        $dataUpdate = [
            'ho_va_ten_nhan' => $request->input('ho_va_ten_nhan'),
            'so_dien_thoai_nhan' => $request->input('so_dien_thoai_nhan'),
            'ma_tinh_thanh_pho' => $request->input('ma_tinh_thanh_pho'),
            'ma_quan_huyen' => $request->input('ma_quan_huyen'),
            'ma_phuong_xa' => $request->input('ma_phuong_xa'),
            'dia_chi_chi_tiet' => $request->input('dia_chi_chi_tiet')
        ];

        $result = DiaChi::where('id', $request->input('dia_chi_id'))
            ->where('user_id', Auth::user()->id)
            ->update($dataUpdate);

        $dia_chi = DiaChi::with('user', 'tinhThanhPho', 'quanHuyen', 'phuongXa')->find($request->input('dia_chi_id'));

        if ($result) {
            return response()->json(['success' => true, 'dia_chi' => $dia_chi]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function doiMatKhau(Request $request)
    {
        $user = Auth::user();

        $validate = Validator::make(
            $request->all(),
            [
                'current_password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        // $attribute: tên của trường (trong trường hợp này là 'current_password')
                        // $value: giá trị mà người dùng đã nhập (mật khẩu hiện tại)
                        // $fail: closure để thông báo lỗi nếu mật khẩu không đúng
                        if (!Hash::check($value, Auth::user()->password)) {
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

        // if (!Hash::check($request->current_password, Auth::user()->password)) {
        //     Session::flash('error', ['current_password' => 'Mật khẩu hiện tại không đúng !']);

        //     return response()->json([
        //         'success' => true,
        //         'redirect_url' => url()->previous(), // giống redirect()->back()
        //     ]);
        // }

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
                'success' => false,
                'redirect_url' => url()->previous(), // giống redirect()->back()
            ]);
        }
    }

    public function addDiaChi(Request $request)
    {
        $request->validate(
            [
                'ho_va_ten' => 'required|string|max:255',
                'so_dien_thoai' => 'required|numeric|regex:/^0[1-9][0-9]{8}$/',
                'tinh_thanh_pho' => 'required',
                'quan_huyen' => 'required_with:tinh_thanh_pho',
                'phuong_xa'     => 'required_with:quan_huyen',
            ],
            [
                'ho_va_ten.required' => 'Vui lòng không bỏ trống Họ và Tên!',
                'ho_va_ten.max' => 'Họ và tên quá dài!',
                'so_dien_thoai.required' => 'Vui lòng không bỏ trống Số điện thoại!',
                'so_dien_thoai.numeric' => 'Số điện thoại phải là số!',
                'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ!',
                'tinh_thanh_pho.required' => 'Vui lòng chọn Tỉnh/Thành Phố!',
                'quan_huyen.required_with' => 'Vui lòng chọn Quận Huyện!',
                'phuong_xa.required_with' => 'Vui lòng chọn Phường Xã!',
            ]
        );
        $user = Auth::user();
        if (!DiaChi::where('user_id', $user->id)->exists()) {
            $trang_thai = 1;
        } else {
            $trang_thai = 2;
        }
        $dataInsert = [
            'user_id' => $user->id,
            'ho_va_ten_nhan' => $request->ho_va_ten,
            'so_dien_thoai_nhan' => $request->so_dien_thoai,
            'ma_tinh_thanh_pho' => $request->tinh_thanh_pho,
            'ma_quan_huyen' => $request->quan_huyen,
            'ma_phuong_xa' => $request->phuong_xa,
            'dia_chi_chi_tiet' => $request->dia_chi_chi_tiet,
            'trang_thai' => $trang_thai,
        ];
        if ($user instanceof User) {
            // instanceof kiểm tra xem biến $user có thuộc class User trong model ko
            DiaChi::create($dataInsert);
            $dia_chi = DiaChi::with('user', 'tinhThanhPho', 'quanHuyen', 'phuongXa')->where('user_id', $user->id)->orderBy('id', 'desc')->first();

            Session::flash('success', 'Bạn đã thêm thành công địa chỉ mới.');
            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(),
                'dia_chi' => $dia_chi
            ]);
        } else {
            Session::flash('error', 'Không thể cập nhật thông tin tài khoản. Vui lòng thử lại.');
            // return redirect()->back()
            //     ->with('error', 'Không thể cập nhật thông tin tài khoản. Vui lòng thử lại.');
            return response()->json([
                'success' => false,
                'redirect_url' => url()->previous(),
            ]);
        }
    }

    public function xoaDiaChi(Request $request)
    {
        $dia_chi_id = $request->input('dia_chi_id');
        $result = DiaChi::where('user_id', Auth::user()->id)->where('id', $dia_chi_id)->delete();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
