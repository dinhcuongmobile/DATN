<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Kiểm tra trạng thái của tài khoản
            $user = Auth::guard('admin')->user();
            if ($user->trang_thai == 1) {
                // Đăng xuất người dùng
                Auth::logout();

                // Chuyển hướng đến trang đăng nhập hoặc thông báo
                return redirect()->route('auth.dang-nhap-admin')->with('error', 'Tài khoản của bạn đã bị khóa !');
            } elseif ($user->trang_thai == 2) {

                // Đăng xuất người dùng
                Auth::logout();

                // Chuyển hướng đến trang đăng nhập hoặc thông báo
                return redirect()->route('auth.dang-nhap-admin')->with('error', 'Phiên đăng nhập đã hết hạn !');
            }
        }

        return $next($request);
    }
}
