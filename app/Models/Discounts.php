<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products;
use App\Models\Category;
//use App\Models\Discounts;

class Discounts extends Model
{
  
    protected $table = 'discounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'discount',
        'status',
        'max_time',
        'created_at',
        'updated_at',
    ];

 
}
