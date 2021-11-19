<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
class  UserController extends Controller
{
   public function update(Request $request){
        if($request->isMethod('post')) {
            $user = Users::find(auth('web')->id());
            if($user !== NULL) {

                $user->name = $request->input('name');
                $user->phone = $request->input('phone');
                $user->password = $request->input('pass');
                $user->save();

                return redirect()->route('user_update_info');
            }
        }
        $data = [
           
        ];
        return view('user.form', $data);
    }
}


