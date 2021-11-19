<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $message = '';
        if ($request->method() === 'POST') {
            $check = $request->validate([
                'l_email' => 'required|email',
                'l_password' => 'required'
                
            ]);

            $checkConvert = array(
                'email' => $check['l_email'],
                'password' => $check['l_password'],
            );
            
            if (Auth::guard('web')->attempt($checkConvert)) {
                
              
                $request->session()->regenerate();

                Session::flash('thanhcong', 'Ban da dang nhap thành công'); 
                
                return redirect()->intended('home');
            }

            $message = 'sai mật khẩu hoặc tài khoản';
        }

        $data = array(
            'message' => $message
        );
        return view('auth.register', $data);
            
      
    }

    public function login_info(Request $request){
        return view('auth.login_info');
    }

    public function logout(Request $request){
        /*
        $authId =  Auth::id();
        if(isset($authId)){
            Auth::logout();
            return redirect()->route('home');
        }*/

        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}


