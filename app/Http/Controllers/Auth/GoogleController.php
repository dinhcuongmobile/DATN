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
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function handleGoogleCallback(Request $request)
    {
        try {
            $userGooge = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $userGooge->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                Cookie::queue('remember_cookie', $request->email, 43200); // Lưu cookie trong 30 ngày

                return redirect()->route('trang-chu.home');
            } else {
                $randomPassword = Str::random(20);

                $newUser = User::updateOrCreate(['email' => $userGooge->email], [
                    'ho_va_ten' => $userGooge->name,
                    'google_id' => $userGooge->id,
                    'vai_tro_id' => 3,
                    'password' => bcrypt($randomPassword)
                ]);

                Auth::login($newUser);

                Cookie::queue('remember_cookie', $request->email, 43200); // Lưu cookie trong 30 ngày

                return redirect()->route('trang-chu.home');
            }
        } catch (Exception $e) {
            return redirect()->route('tai-khoan.dang-nhap')->with('error', 'Đăng nhập thất bại. Vui lòng thử lại!');
        }
    }
}
