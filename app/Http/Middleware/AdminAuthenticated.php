<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use app\http\Middleware\Authenticate;

class AdminAuthenticated extends Middleware
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
        /*
        if (auth()->guard('admin')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                //return response('xxxxx.', 401)s
                return response()->json([
                    'status' => 'ERR',                        
                    'mess' => 'sai pass'
                ]);
            }
            return redirect(route('admin.login'));
            
        }*/
        return $next($request);
    }
}
