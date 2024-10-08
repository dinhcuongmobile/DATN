<?php

namespace App\Http\Controllers\Client\TaiKhoan;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaiKhoan\DangKyRequest;
use App\Http\Requests\TaiKhoan\DangNhapRequest;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TaiKhoanController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    // Đăng ký 

    public function showDangKy()
    {
        return view('client.taiKhoan.dangKy');
    }

    public function dangKy(DangKyRequest $request)
    {
        $dataInsert = [
            'ho_va_ten' => $request->ho_va_ten,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => Str::random(10),
            'vai_tro_id' => 3,
            'trang_thai' => 2,
            'created_at' => now()
        ];

        $user = User::create($dataInsert);

        if ($user) {
            Mail::to($user->email)->send(new UserRegistered($user));

            return redirect()->route('tai-khoan.dang-nhap')->with('success', 'Bạn đã đăng kí tài khoản thành công ! Vui lòng kiểm tra Email để xác nhận');
        } else {
            return redirect()->back()->with('error', 'Không thể đăng ký tài khoản. Vui lòng thử lại.');
        }
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)
            ->whereNull('email_verified_at')
            ->firstOrFail();

        if (!$user) {
            return redirect()->route('tai-khoan.dang-nhap')
                ->with('error', 'Xác thực email không hợp lệ hoặc đã được thực hiện.');
        }

        if (User::where('email_verification_token', $token)
            ->whereNull('email_verified_at')->update(['email_verified_at' => now(), 'email_verification_token' => null, 'trang_thai' => 0])
        ) {
            return redirect()->route('tai-khoan.dang-nhap')
                ->with('success', 'Email đã được xác nhận thành công! Mời bạn đăng nhập.');
        }
    }

    public function guiLaiEmail($email)
    {
        $user = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();

        if ($user) {
            $user->email_verification_token = Str::random(10);
            $user->save();

            Mail::to($user->email)->send(new UserRegistered($user));

            return redirect()->back()->with('success', 'Email xác thực đã được gửi lại. Vui lòng kiểm tra email của bạn.');
        }

        return redirect()->back()->with('error', 'Không tìm thấy tài khoản với email này.');
    }

    // Đăng nhập

    public function showDangNhap()
    {
        return view('client.taiKhoan.dangNhap');
    }

    public function dangNhap(DangNhapRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->trang_thai == 0) {
                return redirect()->route('trang-chu.home');
            } elseif (Auth::user()->trang_thai == 2) {
                Auth::logout();

                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được xác thực !')->withInput();
            } else {
                Auth::logout();

                return redirect()->back()->with('error', 'Tài khoản của bạn đã bị khóa ! Xin vui lòng đăng nhập bằng tài khoản khác.');
            }
        }

        return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác');
    }

    public function showQuenMatKhau()
    {
        return view('client.taiKhoan.quenMatKhau');
    }
    public function showThongTinTaiKhoan()
    {
        return view('client.taiKhoan.thongTinTaiKhoan');
    }

    public function dangXuat()
    {
        Auth::logout();

        return redirect()->route('tai-khoan.dang-nhap');
    }
}
