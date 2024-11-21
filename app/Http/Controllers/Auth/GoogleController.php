<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect to Google login page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
        ->with(['prompt' => 'select_account']) // Yêu cầu Google hiển thị màn hình chọn tài khoản
        ->redirect();

    }

    /**
     * Handle Google callback.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            // Lấy thông tin người dùng từ Google
            $userGoogle = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $userGoogle->id)
                ->orWhere('email', $userGoogle->email)
                ->first();

            if ($finduser) {
                // Nếu người dùng tồn tại, đăng nhập
                $this->updateGoogleIdIfNeeded($finduser, $userGoogle->id);
                $this->loginUser($finduser, $userGoogle->email);
            } else {
                // Tạo tài khoản mới nếu người dùng chưa tồn tại
                $newUser = $this->createNewUser($userGoogle);
                $this->loginUser($newUser, $userGoogle->email);
            }

            return redirect()->route('trang-chu.home');
        } catch (Exception $e) {
            // Ghi log và chuyển hướng đến trang đăng nhập với thông báo lỗi
            report($e);
            return redirect()->route('tai-khoan.dang-nhap')
                ->with('error', 'Đăng nhập thất bại. Vui lòng thử lại sau!');
        }
    }

    /**
     * Update Google ID for existing user if needed.
     */
    private function updateGoogleIdIfNeeded($user, $googleId)
    {
        if (!$user->google_id) {
            $user->update(['google_id' => $googleId]);
        }
    }

    /**
     * Log in user and set remember cookie.
     */
    private function loginUser($user, $email)
    {
        Auth::login($user);
        Cookie::queue('remember_cookie', $email, 43200); // 30 ngày
    }

    /**
     * Create a new user from Google data.
     */
    private function createNewUser($userGoogle)
    {
        $randomPassword = Str::random(16); // Tạo mật khẩu mạnh hơn
        return User::create([
            'google_id' => $userGoogle->id,
            'ho_va_ten' => $userGoogle->name,
            'email' => $userGoogle->email,
            'password' => Hash::make($randomPassword),
            'vai_tro_id' => 3,
            'created_at' => now(),
        ]);
    }
}
