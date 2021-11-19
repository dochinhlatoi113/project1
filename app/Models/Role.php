<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Brands;
use App\Models\Products as ModelsProducts;
use App\Models\ProductsImg;
use App\Models\Order;
use App\Models\OrderProduct;

class Role extends Model
{
 
    protected $table = 'Role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
       'id',
       'guard',
       'name'
    ];

  
}
