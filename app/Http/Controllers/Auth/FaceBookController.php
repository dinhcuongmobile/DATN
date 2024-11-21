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

class FaceBookController extends Controller
{
    /**
     * Redirect to FaceBook login page.
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle FaceBook callback.
     */
    public function handleFacebookCallback(Request $request)
    {
        try {
            // Lấy thông tin người dùng từ FaceBook
            $userFaceBook = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $userFaceBook->id)
                ->orWhere('email', $userFaceBook->email)
                ->first();

            if ($finduser) {
                // Nếu người dùng tồn tại, đăng nhập
                $this->updateFaceBookIdIfNeeded($finduser, $userFaceBook->id);
                $this->loginUser($finduser, $userFaceBook->email);
            } else {
                // Tạo tài khoản mới nếu người dùng chưa tồn tại
                $newUser = $this->createNewUser($userFaceBook);
                $this->loginUser($newUser, $userFaceBook->email);
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
     * Update FaceBook ID for existing user if needed.
     */
    private function updateFaceBookIdIfNeeded($user, $userFaceBook)
    {
        if (!$user->facebook_id) {
            $user->update(['facebook_id' => $userFaceBook]);
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
     * Create a new user from FaceBook data.
     */
    private function createNewUser($userFaceBook)
    {
        $randomPassword = Str::random(16); // Tạo mật khẩu mạnh hơn
        return User::create([
            'facebook_id' => $userFaceBook->id,
            'ho_va_ten' => $userFaceBook->name,
            'email' => $userFaceBook->email,
            'password' => Hash::make($randomPassword),
            'vai_tro_id' => 3,
            'created_at' => now(),
        ]);
    }
}
