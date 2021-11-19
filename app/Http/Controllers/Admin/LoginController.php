<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class LoginController extends Controller
{
    public function admin(Request $request)
    {
        //var_dump( Hash::make(123456));
        //exit;
        $message = '';
        if ($request->method() === 'POST') {
            $check = $request->validate([
                'name' => 'required',
                'password' => 'required'
                
            ]);
            
            if (Auth::guard('admin')->attempt($check)) {
                
              
                $request->session()->regenerate();

                Session::flash('thanhcong', 'Ban da dang nhap thành công'); 
                
                //return redirect()->intended('home');
                return redirect()->route('admin.category.index');
            }

            $message = 'Sai mật khẩu hoặc tài khoản';
        }

        $data = array(
            'message' => $message
        );

        return view('admin.auth.login', $data);
    }  
    
    
  
    
   

}


