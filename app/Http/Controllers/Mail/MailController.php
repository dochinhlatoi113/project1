<?php

namespace App\Http\Controllers\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderProduct;
class MailController extends Controller
{
    public function mail_order(){
        $list = OrderProduct::select(['order_products.*' ,'products.*'])
        ->Join('products', function ($join) {
            $join->on('order_products.product_id', '=', 'products.id');
        })
       
        ->get();
        
      
            $data = [
                'list' => $list
            ];
        
       mail::send('admin.mail.mail_order',$data,function($content){
            $content->from('dochinhlatoi113@gmail.com','new order');
            $content->to('dochinhlatoi113@gmail.com');
            $content->subject('new order');
       });
       
   
    
    }

   

    // .................cart........................

   
 
    
}
