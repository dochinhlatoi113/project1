<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products;

class Brands extends Model
{
    use SoftDeletes;
    protected $table = 'brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'brands_id');
    }
  
}
