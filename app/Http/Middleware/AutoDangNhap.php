<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AutoDangNhap
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && Cookie::has('remember_cookie')) {
            $email = Cookie::get('remember_cookie');

            // Thực hiện tự động đăng nhập nếu tìm thấy email trong cookie
            $user = User::where('email', $email)->where('trang_thai', 0)->first();
            if ($user) {
                Auth::login($user, true); // true để ghi nhớ đăng nhập
            }
        }

        return $next($request);
    }
}
