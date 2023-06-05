<?php

namespace App\Http\Controllers\Front;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\Discounts;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class DiscountController extends Controller
{
    public function index(Request $request ){
      
        
        /*
            $checkDis = $request->get('disCheck');
            $list = Discounts::where('code', $checkDis)->first();
            if($list === NULL) {
                // ma code khong dung
                return response()->json([
                    'status' => 'ERR',
                    'result' => [],
                    'mess' => 'Ma code khong dung'
                    
                ]);
            }else{
                    if (Auth::check()) {
                    $res = $list['discount'];
                    $id = $list['id'];
                    return response()->json([
                        'status' => 'OK',
                        'result' => $res,
                        'mess' => ''
                    ]);
                }else{
                    return response()->json([
                        'status' => 'E',                        
                        'mess' => 'đăng nhập để sử dụng mã code'
                    ]);
                }
            
             }*/
        
        /*
        foreach($list as $item){
            if(isset($item['code'])){
                
               
            }
        }*/
    
        $checkDis = $request->get('disCheck');
            $list = Discounts::where('code', $checkDis)->first();
            if($list === NULL) {
                // ma code khong dung
                return response()->json([
                    'status' => 'ERR',
                    'result' => [],
                    'mess' => 'Ma code khong dung'
                    
                ]);
            }else{
                    if (Auth::check()) {
                    $res = $list['discount'];
                    $id = $list['id'];
                    return response()->json([
                        'status' => 'OK',
                        'result' => $res,
                        'mess' => ''
                    ]);
                }else{
                    return response()->json([
                        'status' => 'E',                        
                        'mess' => 'đăng nhập để sử dụng mã code'
                    ]);
                }
        
    }
    }
    
}
