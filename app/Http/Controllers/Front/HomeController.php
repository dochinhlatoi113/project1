<?php

namespace App\Http\Controllers\Front;
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
class HomeController extends Controller
{
    public function index(){
     

        $products = Products::paginate(10);

        $data = [
            
            'products' => $products,
        ];
       
   
        return view('front.home.index', $data);
    }

   

    // .................cart........................

   
 
    
}
