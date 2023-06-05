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
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class ListOrderController extends Controller
{
    public function list_order(Request $request){
      
       $list = Order::select(['order.id' ,'customer.name','order.created_at'])
        ->Join('customer', function ($join) {
            $join->on('order.customer_id', '=', 'customer.id');
        })
       
        ->get();
      //foreach($list as $item){
        // echo"<pre>"; print_r($item);
      //}exit;
      $data = [
          'list' => $list
      ];
        return view('admin.report.list_order',$data);
    }

   

    // .................cart........................

   
 
    
}
