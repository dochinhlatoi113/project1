<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class ProductsImg extends Model
{
    protected $table = 'products_img';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'images_path',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
