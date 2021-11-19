<?php

namespace App\Http\Controllers\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Products;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class DetailController extends Controller
{
    public function index_detail_order(Request $request){
        $id = $request->input('id');
        //var_dump($ids);exit;
        //$orPro = OrderProduct::where('order_id',$ids)->first();
       
            /*
            $list = OrderProduct::select(['order.discount' ,'order_products.quantity','order_products.order_id','order_products.product_id','products.name','products.price','order.id as ids'])
            ->join("order","order.id","=","order_products.order_id")
            ->Join('products', function ($join) {
                $join->on('order_products.order_id', '=', 'products.id');
               
            })
            ->where('order_products.order_id','=',$ids)
            ->get();
            */
            /*
            $order = Order::find($id);
            var_dump('order_id = ', $order->id);
            echo '<br/>';
            var_dump('discount = ', $order->discount);

            echo '<br/>';
            var_dump('khach hang = ', $order->customer);
*/

            $order = Order::select(['order.id' ,'order.discount', 'customer.name'])
            ->join("customer", "customer.id", "=", "order.customer_id")
            ->where('order.id','=',$id)
            ->first();

            $listProducts = OrderProduct::select(['order_products.quantity' ,'products.id', 'products.name', 'products.price'])
            ->join("products", "products.id", "=", "order_products.product_id")
            ->where('order_products.order_id', $id)
            ->get();


            
      $data = [
          'order' => $order,
          'products' => $listProducts
      ];
        
        return view('admin.report.detail',$data);
    }

   

    // .................cart........................

   
 
    
}
