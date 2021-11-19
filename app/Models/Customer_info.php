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

class Customer_info extends Model
{
 
    protected $table = 'customer_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
        'sex',
        'name',
        'user_id',
        'phone',
        'delivery_type',  
        'address',
        'created_at',
        'updated_at'
    ];

    public function Customer(){
        return $this->hasmany(Order::class, 'customer_id');
    }

    public function User_id(){
        return $this->hasOne(Users::class,'user_id');
    }
}
