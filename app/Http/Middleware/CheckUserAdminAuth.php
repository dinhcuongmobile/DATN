<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->user()) {
            if (Auth::guard('admin')->user()->vai_tro_id == 1 || Auth::guard('admin')->user()->vai_tro_id == 2) {
                return redirect()->route('admin.index');
            }
        }

        return $next($request);
    }
}
