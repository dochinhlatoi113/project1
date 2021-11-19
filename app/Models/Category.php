<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products;
use App\Models\Category;
class Category extends Model
{
    use SoftDeletes;
    protected $table = 'category';

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

    public function products() {
        return $this->hasMany(Products::class, 'category_id');
    }

    public static function makeCategoryStep($lists) {
        $arr = [];
        foreach($lists as $list) {
            if($list->parent_id == '') {
                $arr[$list['id']] = [
                    'id' => $list->id,
                    'name' => $list->name,
                    'parent_id'=> $list->parent_id,
                    'childs' => [],
                    'sum' => 0
                ];             
            } else {
                
                $arr[$list->parent_id]['sum'] = $arr[$list->parent_id]['sum'] + $list->total_product;
                $arr[$list->parent_id]['childs'][$list->id] = [
                        'id' => $list->id,
                        'name' => $list->name,
                        'parent_id'=> $list->parent_id,
                ];  
                if(isset($list['total_product'])) {
                    $arr[$list->parent_id]['childs'][$list->id]['total_product'] = $list['total_product'];
                }  

            }
        };
        return $arr;
    }
}
