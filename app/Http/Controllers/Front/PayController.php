<?php

namespace App\Http\Controllers\Front;
use Intervention\Image\ImageManager;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Category;
use App\Models\ProductsImg;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Models\order_success;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Users;
use App\Models\Discounts;
use App\Models\OrderProduct;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Customer_info;
use Illuminate\Support\Facades\Auth;
class PayController extends Controller
{
    public function Pay(){
        
        return view('front.cart.pay');
    }

    public function Order(Request $request){  
       
        $checkDiscount = $request->get('check');
        $disCount = Discounts::where('code', $checkDiscount)->first();
        
        //..........dang nhap mua hang................................................
        $login = Users::first();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            //'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sex' => 'required',
            'phone' =>'required',            
            
           
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            return response()->json([
                'status' => 'ERR',
                'result' => [],
                'messages' => $errors
            ]);
        }
        
        //............vali...........................................

        $checkPhone = $request->get('phone');
        $customer = Customer::where('phone', $checkPhone)->first();

        if($customer === NUll) {
            $customer = new Customer();
        }
        $customer->user_id = auth('web')->id();
        $customer->sex = $request->input('sex');
        $customer->delivery_type = $request->input('deli');
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->address = ($request->input('deli') == 1) ? $request->input('address') : NULL;
        $customer->save();
        

        /*
        $cusHistory = new Customer_info();
        $cusHistory->user_id = 1;
        $cusHistory->sex = $request->input('sex');
        $cusHistory->delivery_type = $request->input('deli');
        $cusHistory->name = $request->input('name');
        $cusHistory->phone = $request->input('phone');
        $cusHistory->address = $request->input('address');
        $cusHistory->save();*/

        $order = new Order();
        $order->discount = isset($disCount['discount']) ? $disCount['discount'] : 0;
        $order->user_id = $customer->user_id ? $customer->user_id : "" ;
        $order->customer_id = $customer->id ;
        $order->Save();


        $cart = session('cart');
       
        foreach($cart as $val){                   
        
            $data[] = [
                'order_id' => $order->id,
                'product_id' => $val['id'],
                'quantity' => $val['quantity']
            ];
        }
               
        OrderProduct::insert($data);
    

        // remove session cart
       $request->session()->forget('cart');


       $request->session()->flash('SUCCESS', 'bạn đã dat hang thành công!');

       return response()->json([
            'status' => 'ok',
            'result' => ['url' => route('order_success')], 
        ]);
    }

    public function order_success(Request $request)
    {
        return view('front.cart.sucess_order');
    }
}    