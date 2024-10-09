<?php

namespace App\Http\Controllers\Client\TaiKhoan;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaiKhoan\DangKyRequest;
use App\Http\Requests\TaiKhoan\DangNhapRequest;
use App\Mail\OtpDoiMatKhau;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    // Quên mật khẩu và đổi mật khẩu

    public function showQuenMatKhau()
    {
        return view('client.taiKhoan.quenMatKhau');
    }

    public function guiOtp(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email'
            ],
            [
                'email.required' => 'Email không được bỏ trống !',
                'email.email' => 'Email không hợp lệ !',
                'email.exists' => 'Email không tồn tại !',
            ]
        );

        $email = $request->email;
        $otp = rand(1000, 9999); //Tạo otp ngẫu nhiên

        // Lưu otp vào DB
        DB::table('password_reset_tokens')->updateOrInsert(
            [
                'email' => $email
            ],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        //Gửi Otp qua mail
        Mail::to($email)->send(new OtpDoiMatKhau($otp, $email));

        return redirect()->route('tai-khoan.form-otp')->with('email', $email);
    }

    public function showFormOtp()
    {
        return view('client.taiKhoan.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'otp' => 'required'
            ],
            [
                'email.required' => 'Email không được bỏ trống !',
                'email.email' => 'Email không hợp lệ !',
                'email.exists' => 'Email không tồn tại !',

                'otp' => 'OTP không được bỏ trống !'
            ]
        );

        $email = $request->email;
        $otp = $request->otp;

        // Kiểm tra OTP
        $check = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$check || $check->token != $otp || Carbon::parse($check->created_at)->addMinutes(10)->isPast()) {
            return redirect()->back()->withErrors(['otp' => 'Mã OTP không hợp lệ hoặc đã hết hạn']);
        }

        return redirect()->route('tai-khoan.dat-lai-mat-khau', ['email' => $email]);
    }

    public function showDatLaiMatKhau()
    {
        return view('client.taiKhoan.datLaiMatKhau');
    }

    public function doiLaiMatKhau(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string|min:6',
                'confirm_password' => 'same:password',
            ],
            [
                'email.required' => 'Vui lòng không bỏ trống email !',
                'email.email' => 'Địa chỉ email không hợp lệ !',
                'email.exists' => 'Email đã được sử dụng!',

                'password.required' => 'Vui lòng nhập mật khẩu !',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự !',
                'confirm_password.same' => 'Mật khẩu xác nhận không khớp !',
            ]
        );

        $check = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
            ])
            ->first();

        if (!$check) {
            return redirect()->back()->with('error', 'Email không hợp lệ !');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        if ($user) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return redirect()->route('tai-khoan.dang-nhap')->with('success', 'Bạn đã đổi mật khẩu thành công !');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra ! Vui lòng thử lại');

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
