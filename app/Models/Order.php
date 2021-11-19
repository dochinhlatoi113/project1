<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Brands;
use App\Models\Products as ModelsProducts;
use App\Models\ProductsImg;
use App\Models\OtherProduct;
use App\Models\Customer;
class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'discount',
        'customer_id',
        'delete_at',
        'created_at',
        'updated_at'
      
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'customer_id');
    }
    
    public function order_product(){
        return $this->hasMany(OtherProduct::class, 'order_id');
    }
}
