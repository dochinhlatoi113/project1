<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;


class UserAuthenticated extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (auth()->guard('web')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                //return response('xxxxx.', 401)s
                return response()->json([
                    'status' => 'ERR',                        
                    'mess' => 'đăng nhập để sử dụng mã code'
                ]);
            }
            return redirect(route('auth_login'));
        }
        return $next($request);
    }
}
