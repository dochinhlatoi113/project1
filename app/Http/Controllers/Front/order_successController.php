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
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Users;
use App\Models\Discounts;
use App\Models\OrderProduct;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Customer_info;
use Illuminate\Support\Facades\Auth;
class order_successController extends Controller
{
    public function Pay(){
        
        return view('front.cart.success_order');
    }

   
}    