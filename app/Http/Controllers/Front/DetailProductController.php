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
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Illuminate\Database\Eloquent\Model;

class DetailProductController extends Controller
{
    public function detail(Request $request){
       
        $getID = $request->get('id');    
        $item = Products::select(['products.name','products.img','products.price' ,'brands.id','products.id as ids'])
        ->Join('brands', function ($join) {
            $join->on('products.brands_id', '=', 'brands.id');
        })
        ->where('brands.id','=',$getID)
        ->get();
        $products = Products::with('albums')->find($getID); 
        //echo'<pre>';print_r($item);exit;      
        $data = [
            'lists'  => $lists = Category::get() ,
            'brands' => $brands = Brands::get(),
            'products' => $products,
            'item' => $item 
            // 'keywork' => $keywork,           
            // 'lists' => $lists,
        ];
        return view('front.detail.detailProduct', $data );
    }
}
