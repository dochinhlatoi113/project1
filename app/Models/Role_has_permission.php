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

class Role_has_permission extends Model
{
 
    protected $table = 'Role_has_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
       'role_id',
       'permission_id'
    ];

  
}
