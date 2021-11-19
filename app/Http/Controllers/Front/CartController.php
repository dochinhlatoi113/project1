<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Input;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Request;
class CartController extends Controller
{

    public function add(Request $request){
        
        $id = $request->get('productId');
        $quantityInput = $request->get('number');

        $product = Products::find($id);
        if($product === NULl) {
            return response()->json([
                'status' => 'Err',
                'result' => [],
                'mess' => 'Data not found'
            ]);
        };
        $sessionCart = session()->get('cart');
        if(session()->has('cart')) {
            $sessionCart = session()->get('cart');
        } else {
            $sessionCart = [];
        }
      
        if(isset($sessionCart[$id])) {
            if($quantityInput !== Null){
                $sessionCart[$id]['quantity'] = $sessionCart[$id]['quantity'] + $quantityInput;
            }else{
                $sessionCart[$id]['quantity'] = $sessionCart[$id]['quantity'] + 1;
            }
        } else {

            $sessionCart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
              
            ];
        }
           
        session(['cart' => $sessionCart]);      
        $sum = [];
        foreach($sessionCart as $item){
            array_push($sum,$item['quantity']);
            $res = array_sum($sum);           
            
        }
      
        // return json format
        return response()->json([
            'status' => 'OK',
            'result' => ['sum' => $res],
            'url' => ['url' => route('cart_list')],
            'mess' => ''
        ]);
        
    }    

    public function list(Request $request)
    {
        
        
        $cart = session('cart');

        $data = [
            'cart' => $cart
        ];
      
        return view('front.cart.index', $data);
    }    

    public function delete(Request $request){
  
        $productId = $request->get('proId');
        $cart = session('cart');
        if(isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        session(['cart' => $cart]);
  $request->session()->forget('name');
        return response()->json([
            'status' => 'OK',
            'result' => ['url' => route('cart_list')],
            'mess' => ''
        ]);    
    }

    
}
