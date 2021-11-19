<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Brands;
use App\Models\Products as ModelsProducts;
use App\Models\ProductsImg;
use App\Models\Order;
use App\Models\Customer;
class Products extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'category_id',
        'brands_id',
        'name',
        'soluong',
        'des',
        'img',
        'price',
        'slug',
        'created_at',
        'updated_at'
    ];

    public function formatPrice()
    {
        if ($this->price > 0) {
            return number_format($this->price);
        }
        return 'Lien hệ';
    }

    public function getImage($isThumb = true)
    {
        // Check empty
        if(empty($this->img)) {
            return '';
        }
        
        $mainPath = public_path($this->img);
       
        
        $basename = basename($this->img);
        $getThumbPath = 'product_images/thumb'.'/'.$basename; 
        // check ton tai
        if( ! file_exists($mainPath)) {
            return 'ko có avatar';
        }

        if($isThumb = true) {
            //return  $basename ;
            return '<img src="'.url('/'.$getThumbPath).'" />';
        }
        // return hinh goc
        return '<img src="'.url($this->img).'" />';
    }
  
    // relation ship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brands_id');
    }

    public function albums() {

        return $this->hasMany(ProductsImg::class, 'product_id', 'id');
    }
    public function order_products() {

        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    public function upNumber($id){
        $list = Products::get($id);
        $total = $list->total+1;
        Products::update($id, $total);
    }

    public function bienthe_product(){
       return $this->belongsTo(bienthe_product::class,'product-id');
    }
}
