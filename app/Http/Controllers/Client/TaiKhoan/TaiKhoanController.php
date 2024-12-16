<?php

namespace App\Http\Controllers\Client\TaiKhoan;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaiKhoan\DangKyRequest;
use App\Http\Requests\TaiKhoan\DangNhapRequest;
use App\Mail\OtpDoiMatKhau;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
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
        do {
            $email_verification_token = Str::random(10);
        } while (DB::table('users')->where('email_verification_token', $email_verification_token)->exists());

        $dataInsert = [
            'ho_va_ten' => $request->ho_va_ten,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => $email_verification_token,
            'vai_tro_id' => 3,
            'trang_thai' => 2,
            'created_at' => now()
        ];

        $user = User::create($dataInsert);

        if ($user) {
            Mail::to($user->email)->queue(new UserRegistered($user));

            Session::flash('success', 'Bạn đã đăng kí tài khoản thành công ! Vui lòng kiểm tra Email để xác nhận !');

            return response()->json([
                'success' => true,
                'redirect_url' => route('tai-khoan.dang-nhap'),
            ]);
        } else {

            Session::flash('error', 'Không thể đăng ký tài khoản. Vui lòng thử lại.');

            return response()->json([
                'success' => true,
                'redirect_url' => route('tai-khoan.dang-nhap'),
            ]);
        }
    }

    public function verifyEmail(string $token)
    {
        $user = User::where('email_verification_token', $token)
            ->whereNull('email_verified_at')
            ->first();
        if (!$user) {
            return redirect()->route('tai-khoan.dang-nhap')
                ->with('error', 'Xác thực email không hợp lệ hoặc đã được thực hiện.');
        }

        $result = $user->update(['email_verified_at' => now(), 'email_verification_token' => null, 'trang_thai' => 0]);
        if ($result) {
            return redirect()->route('tai-khoan.dang-nhap')
                ->with('success', 'Email đã được xác nhận thành công! Mời bạn đăng nhập.');
        }
    }

    public function guiLaiEmail($email)
    {
        $user = User::where('email', $email)->whereNull('email_verified_at')->first();

        if ($user) {
            do {
                $email_verification_token = Str::random(10);
            } while (DB::table('users')->where('email_verification_token', $email_verification_token)->exists());

            $user->email_verification_token = $email_verification_token;
            $user->save();

            Mail::to($user->email)->queue(new UserRegistered($user));

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
                // Kiểm tra nếu "Ghi nhớ" được chọn
                if ($request->has('remember')) {
                    Cookie::queue('remember_cookie', $request->email, 43200); // Lưu cookie trong 30 ngày
                } else {
                    Cookie::queue(Cookie::forget('remember_cookie'));
                }

                return response()->json([
                    'success' => true,
                    'redirect_url' => route('trang-chu.home'),
                ]);
            } elseif (Auth::user()->trang_thai == 2) {
                Auth::logout();

                Session::flash('error', 'Tài khoản của bạn chưa được xác thực !');
                Session::flash('_old_input', $request->only('email')); // Flash lại dữ liệu email
                Session::flash('resend_verification_url', route('tai-khoan.gui-lai-email', ['email' => $request->input('email')]));

                return response()->json([
                    'success' => true,
                    'redirect_url' => route('tai-khoan.dang-nhap'),
                ]);
            } else {
                Auth::logout();

                Session::flash('error', 'Tài khoản của bạn đã bị khóa ! Xin vui lòng đăng nhập bằng tài khoản khác.');

                return response()->json([
                    'success' => true,
                    'redirect_url' => route('tai-khoan.dang-nhap'),
                ]);
            }
        }

        Session::flash('error', 'Thông tin đăng nhập không chính xác');

        return response()->json([
            'success' => true,
            'redirect_url' => route('tai-khoan.dang-nhap'),
        ]);
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
        Mail::to($email)->queue(new OtpDoiMatKhau($otp, $email));

        $emailEncrypted = Crypt::encryptString($email);

        return response()->json([
            'success' => true,
            'redirect_url' => route('tai-khoan.form-otp', ['v' => $emailEncrypted]), // v là tên tự đặt để mã hóa email trên url
        ]);
    }

    public function guiLaiOtp(Request $request)
    {
        try {
            // Giải mã email từ URL
            $email = Crypt::decryptString($request->email);



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
            Mail::to($email)->queue(new OtpDoiMatKhau($otp, $email));

            return redirect()->back()->with('success', 'OTP đã được gửi lại thành công!');
        } catch (DecryptException $e) {
            // Bắt lỗi nếu email không thể giải mã
            return redirect()->back()->with('error', 'Liên kết không hợp lệ hoặc đã hết hạn!');
        }
    }

    public function showFormOtp()
    {
        return view('client.taiKhoan.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'otp' => 'required'
            ],
            [
                'email.required' => 'Email không hợp lệ !',
                'otp.required' => 'OTP không được bỏ trống !'
            ]
        );

        try {
            $email = Crypt::decryptString($request->email);
        } catch (DecryptException $e) {
            Session::flash('error', ['email' => 'Email không hợp lệ!']);

            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(),
            ]);
        }

        $otp = $request->otp;

        // Kiểm tra OTP
        $check = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$check || $check->token != $otp || Carbon::parse($check->created_at)->addMinutes(10)->isPast()) {
            Session::flash('error', ['otp' => 'Mã OTP không hợp lệ hoặc đã hết hạn !']);

            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(), // giống redirect()->back()
            ]);
        }

        DB::table('password_reset_tokens')->where('email', $email)->update(['is_verified' => true]); //Check xác nhận OTP

        $emailEncrypted = Crypt::encryptString($email);

        Session::flash('success', 'Xác nhận OTP thành công !');

        // v là tên tự đặt để mã hóa email trên url
        return response()->json([
            'success' => true,
            'redirect_url' => route('tai-khoan.dat-lai-mat-khau', ['v' => $emailEncrypted]),
        ]);
    }

    public function showDatLaiMatKhau()
    {
        return view('client.taiKhoan.datLaiMatKhau');
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
            Session::flash('error', ['email' => 'Email không hợp lệ!']);

            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(), // giống redirect()->back()
            ]);
        }

        $check = DB::table('password_reset_tokens')
            ->where([
                'email' => $email,
            ])
            ->first();

        if (!$check || !$check->is_verified) {
            Session::flash('error', ['error' => 'Email hoặc OTP không hợp lệ !']);

            return response()->json([
                'success' => true,
                'redirect_url' => url()->previous(), // giống redirect()->back()
            ]);
        }

        $user = User::where('email', $email)->update(['password' => Hash::make($request->password)]);

        if ($user) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            Session::flash('success', 'Bạn đã đổi mật khẩu thành công !');

            return response()->json([
                'success' => true,
                'redirect_url' => route('tai-khoan.dang-nhap'),
            ]);
        }

        // return redirect()->back()->with('error', 'Đã có lỗi xảy ra ! Vui lòng thử lại');
        Session::flash('error', ['error' => 'Đã có lỗi xảy ra ! Vui lòng thử lại !']);

        return response()->json([
            'success' => true,
            'redirect_url' => url()->previous(), // giống redirect()->back()
        ]);
    }

    public function dangXuat()
    {
        // Xóa cookie remember_cookie
        Cookie::queue(Cookie::forget('remember_cookie'));

        Auth::logout();

        return redirect()->route('tai-khoan.dang-nhap');
    }
}
