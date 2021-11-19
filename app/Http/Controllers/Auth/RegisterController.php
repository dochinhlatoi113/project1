<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Users;

class RegisterController extends Controller
{
    public function index(Request $request)
    {   
        $nofi = '';
        if ($request->method() === 'POST') {
            $check = $request->validate([
                'name' =>'required|min:4|max:35',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|max:20|min:5|regex:/^.+$/i|confirmed',
                'phone' => 'required|numeric'
            ]);

            // ..... 
            $user = Users::create(request(['name', 'email', 'password', 'phone']));
            
            Auth::guard('web')->login($user);
          

            Session::flash('nofi', 'Ban da đang ký thành công'); 
                
            return redirect()->intended('home' );
        } ; 
        
            
       
        return view('auth.register'); 
    }    
}