<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

use App\Models\Users;

class ForgotPasswordController extends Controller
{
    public function index(Request  $request)
    {
        if (($request->method() === 'POST')){
           
            $request->validate([
                'email' => 'required|email|exists:users,email'
            ]);

            
        
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // insert 1 dong vao table: password_reset
            // email, token, created_at

            // Gửi 1 link đến email của mình
            // $token = password_resets.token
            // Ban vui long click vao link den duoi de reset password
            // <a href="{{ route('password.reset', array('token' => $token)) }}">Link</a>
            // khuong.dev/reset-password/sdhgsd3463463463636346364dfhdfhdfhdhdf

            
            return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Success'])
            : back()->withErrors(['email' => __($status)]);
          
        }
        return view('auth.forgot_password');
    }

    public function reset(Request $request, $token)
    {
        $email = $request->get('email', NULL);

        if(($request->method() === 'POST')) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',             
                'password' => 'required|min:8|confirmed',
            ]);
        
            $status = Password::reset(
                $request->only('email', 'password', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
        
                    $user->save();
        
                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                        ? redirect()->route('password.reset', ['token' => $token])->with('status', __($status))
                        : back()->withErrors(['email' => [__($status)]]);
        }
        
        $data = [
            'token' => $token,
            'email' => $email,
        ];

        return view('auth.reset_password', $data);
    }
}    