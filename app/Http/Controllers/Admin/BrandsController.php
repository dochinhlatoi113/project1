<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandsController extends Controller
{
    public function index(Request $request)
    {
      
        $defaultSort = 'ASC';
        $sort_type = $request->get('sort_by', $defaultSort);
        $keywork = $request->get('keywork');

        $lists = Brands::where('name', 'LIKE', "%".$keywork."%")->orderBy('name', $sort_type)->paginate(10);


        $paramSort = ($sort_type === $defaultSort) ? 'DESC' : $defaultSort;

        // Set danh sách sản phẩm ra ngoài view
        $data = [
            'keywork' => $keywork,
            'sort_by' => $paramSort,
            'lists' => $lists,
        ];
        

        
        return view('admin.brands.lists', $data,[
           
        ]);
    }  
    
    
    public function insert(Request $request)
    {
        if ($request->method() === 'POST') {
            $request->validate([
                'name' => 'required',
            ]);
            $category = new Brands();
            $category->name = $request->input('name');
            $category->slug =  Str::slug($request->input('name'));

            $category->save();
            $request->session()->flash('oke', 'bạn đã thêm thành công!');
            return redirect()->route('admin.brands_insert');
        // $name = 'giày nam thể thao';
        // $slug = Str::slug($name, '-----');
        // //var_dump($slug);exit;
        };

        return view('admin.brands.insert');
    }
    // ----------------edit------------------------
  

        public function edit($id, Request $request)
        {
         
            $brands = brands::find($id);
            if($brands === NULL){
                throw ValidationException::withMessages(['id' => 'không có sản phẩm!']);
            }
    
                 
            if ($request->method() === 'POST') {
    
                $request->validate([
                    'name' => 'required',             
                ]);         
                $brands->name = $request->input('name');
                $brands->slug =  Str::slug($request->input('name'));
                
                $brands->save();
                $request->session()->flash('status', 'thành công!');
    
            }
    
            $data = [
                'brands' => $brands
            ];
        
        return view ('admin.brands_edit',$data,[]);
    }

    ///////////////////delete/////////////////////////
    public function delete(Request  $request, $id)
    {
       
      
        $brands = brands::find($id);
           
        if($brands === NULL){
            throw ValidationException::withMessages(['id' => 'không có sản phẩm!']);
        }
      
        //$category->forceDelete();//xóa vĩnh viển khỏi db
        $brands->delete(); // xoa tam trong table
       
        $request->session()->flash('delete', 'bạn đã xóa thành công!');
        return redirect()->route('admin.brands');
    }


    ///////////////////soft-delte///////////////////////////////
    public function soft_delete(Request  $request){
        
        $brands = Brands::onlyTrashed()->orderBy('name', 'ASC')->paginate(5);
        // dd($brands);exit;
        $data = [
            'brands' => $brands
        ];
      
        return view('admin.brands.softdelete', $data);
    }

    /////////////////////////delete-all///////////////////////
    public function deleteall(Request  $request)
    {
    
        $ids = $request->post('ids');
        $array_ids = array($ids);
        $dem = 0;
        if (count($array_ids)) {
            foreach($array_ids as $id) {
                $brands = brands::find($id);
                if($brands !== NULL) {
                    $brands->delete();
                    $dem ++;
                }
            }
        }

        $request->session()->flash('delete', sprintf('Ban da xoa thanh cong %s item', $dem));
        return redirect()->route('admin.brands');
    }

    // ................restore........
    public function restore(Request $request) {

        $ids = $request->post('ids');
        $array_ids = array($ids);
        $dem = 0;
        if (count($array_ids)) {
            foreach($array_ids as $id) {
                $brands = brands::onlyTrashed()->where('id', $id)->first();
                if($brands !== NULL) {
                    $brands->restore();
                    $dem ++;
                }
            }
        }

        $request->session()->flash('delete', sprintf('Ban da restore thanh cong %s item', $dem));
        return redirect()->route('admin.brands_soft_delete');
      
    
        }  
    
}
