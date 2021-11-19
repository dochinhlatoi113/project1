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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
    public function index_report_order(Request $request){
      
        
        return view('admin.report.index');
    }

   

    // .................cart........................

   
 
    
}
