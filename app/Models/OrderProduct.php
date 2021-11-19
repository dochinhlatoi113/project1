<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Brands;
use App\Models\Products as ModelsProducts;
use App\Models\ProductsImg;
use App\Models\Orther;
use App\Models\Customer;
class OrderProduct extends Model
{
    use SoftDeletes;

    protected $table = 'order_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
        'product_id',
        'order_id',     
        'delete_at',
        'created_at',
        'updated_at'
      
    ];
  
    public function order(){
        return $this->belongto(Order::class, 'order_id','id');
    }

    public function Products(){
        return $this->belongto(Products::class, 'product_id','id');
    }



}
