<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Category;
use App\Models\Brands;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $data = [
            'categories' => $this->loadCategory(),
            'brands' => $this->loadBrand()
        ];
        
        view()->share('global_data', $data);
    }

    protected function loadCategory()
    {
        $categories = Category::select(['category.*', DB::raw('COUNT(products.id) AS total_product')])
        ->leftJoin('products', function ($join) {
            $join->on('category.id', '=', 'products.category_id');
        })
        ->groupBy('category.id')
        ->get();

        return Category::makeCategoryStep($categories);
    }

    protected function loadBrand()
    {
        //$brands = Brands::get();
     
        $brands = Brands::select(['brands.*', DB::raw('COUNT(products.id) AS res_product')])
        ->leftJoin('products', function ($join) {
            $join->on('brands.id', '=', 'products.brands_id');
        })
        ->groupBy('brands.id')
        ->get();

        return $brands;

        /*
        foreach($brands as $item){
            if($item->parent_id == ''){
                $arr1[$item->id] = [
                    'id' => $item->id,
                    'name' =>$item->name,
                    'parent_id' => $item->parent_id,
                    'childs' => [],
                    'sum' => 0
                ];
            }else{
                $arr1[$item->parent_id]['sum'] = $arr1[$item->parent_id]['sum'] + $item->res_product;
                $arr1[$item->parent_id]['childs'][$item->id] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'parent_id'=> $item->parent_id,
                ];
                if(isset($item['res_product'])) {
                    $arr[$item->parent_id]['childs'][$item->id]['res_product'] = $item['res_product'];
                }
            }
        }  */
      
    }
}
