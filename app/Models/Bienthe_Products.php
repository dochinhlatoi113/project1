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
use App\Models\Products;
class Customer extends Model
{
    
    protected $table = 'bienthe_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'color',
       'size',
       'price',
       'quanity'
    ];

    public function Products(){
        return $this->belongsTo(Products::class, 'product_id');
    }

   
}
