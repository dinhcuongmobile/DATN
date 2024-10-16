<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaiKhoan\DangNhapRequest;
use App\Mail\OtpDoiMatKhau;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthAdminController extends Controller
{
    public function showDangNhapAdmin()
    {
        return view('auth.admin.dangNhapAdmin');
    }

    // Đăng nhập

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

    // Quên mật khẩu

    public function showQuenMatKhau()
    {
        return view('auth.admin.quenMatKhauAdmin');
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

        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && ($user->vai_tro_id == 1 || $user->vai_tro_id == 2)) {
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

            $emailEncrypted = Crypt::encryptString($email);
    
            return redirect()->route('auth.form-otp-admin', ['v' => $emailEncrypted]); //v là tên tự đặt để mã hóa email trên url
        }

        return redirect()->back()->with('error', 'Tài khoản với địa chỉ Email này không đủ quyền truy cập !');

    }

    public function guiLaiOtp(Request $request)
    {
        try {
            // Giải mã email từ URL
            $email = Crypt::decryptString($request->email);
    
            // Kiểm tra người dùng có tồn tại và có vai trò hợp lệ
            $user = DB::table('users')->where('email', $email)->first();
    
            if ($user && ($user->vai_tro_id == 1 || $user->vai_tro_id == 2)) {
                // Tạo OTP mới
                $otp = rand(1000, 9999);
    
                // Lưu OTP vào DB
                DB::table('password_reset_tokens')->updateOrInsert(
                    [
                        'email' => $email
                    ],
                    [
                        'token' => $otp,
                        'created_at' => Carbon::now()
                    ]
                );
    
                // Gửi OTP qua email
                Mail::to($email)->send(new OtpDoiMatKhau($otp, $email));
    
                return redirect()->back()->with('success', 'OTP đã được gửi lại thành công!');
            }
    
            return redirect()->back()->with('error', 'Tài khoản với địa chỉ Email này không đủ quyền truy cập !');
        } catch (DecryptException $e) {
            // Bắt lỗi nếu email không thể giải mã
            return redirect()->back()->with('error', 'Liên kết không hợp lệ hoặc đã hết hạn!');
        }
    }

    public function showFormOtp()
    {
        return view('auth.admin.otpAdmin');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',

                'otp' => 'required'
            ],
            [
                'email.required' => 'Email không được bỏ trống !',

                'otp' => 'OTP không được bỏ trống !'
            ]
        );

        // Giải mã Email

        try {
            $email = Crypt::decryptString($request->email);
        } catch (DecryptException $e) {
            return redirect()->back()->withErrors(['email' => 'Email không hợp lệ!']);
        }

        $otp = $request->otp;

        // Kiểm tra OTP
        $check = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$check || $check->token != $otp || Carbon::parse($check->created_at)->addMinutes(5)->isPast()) { // OTP sẽ không dùng được sau 5 phút
            return redirect()->back()->withErrors(['otp' => 'Mã OTP không hợp lệ hoặc đã hết hạn']);
        }

        DB::table('password_reset_tokens')->where('email', $email)->update(['is_verified' => true]); //Check xác nhận OTP

        $emailEncrypted = Crypt::encryptString($email);

        return redirect()->route('auth.dat-lai-mat-khau-admin', ['v' => $emailEncrypted]); //v là tên tự đặt để mã hóa email trên url
    }

    public function showDatLaiMatKhau()
    {
        return view('auth.admin.datLaiMatKhauAdmin');
    }

    public function datLaiMatKhau(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required|string|min:6',
                'confirm_password' => 'same:password',
            ],
            [
                'email.required' => 'Email không hợp lệ !',

                'password.required' => 'Vui lòng nhập mật khẩu !',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự !',
                'confirm_password.same' => 'Mật khẩu xác nhận không khớp !',
            ]
        );

        try {
            $email = Crypt::decryptString($request->email);
        } catch (DecryptException $e) {
            return redirect()->back()->withErrors(['email' => 'Email không hợp lệ!']);
        }

        $check = DB::table('password_reset_tokens')
            ->where([
                'email' => $email,
            ])
            ->first();

        if (!$check || !$check->is_verified) { //Nếu đã xác nhận OTP thì cho qua
            return redirect()->back()->with('error', 'Email hoặc OTP không hợp lệ !');
        }

        $user = User::where('email', $email)->update(['password' => Hash::make($request->password)]);

        if ($user) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            return redirect()->route('auth.dang-nhap-admin')->with('success', 'Bạn đã đặt lại mật khẩu thành công !');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra ! Vui lòng thử lại');

    }


    public function dangXuatAdmin()
    {
        Auth::logout();

        return redirect()->route('auth.dang-nhap-admin');
    }
}
