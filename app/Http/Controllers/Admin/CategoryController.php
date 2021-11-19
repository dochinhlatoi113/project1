<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    public function Category_index(Request $request)
    {
     
        $defaultSort = 'ASC';
        $sort_type = $request->get('sort_by', $defaultSort);
        $keywork = $request->get('keywork');

       
        $lists = Category::where('name', 'LIKE', "%".$keywork."%")->orderBy('name', $sort_type)->paginate(10);


        $arr = [];
        foreach($lists as $list) {
            if($list->parent_id == '') {
                $arr[$list['id']] = [
                    'id' => $list->id,
                    'name' => $list->name,
                    'parent_id'=> $list->parent_id,
                    'childs' => []
                ];
            } else {
               $arr[$list->parent_id]['childs'][$list->id] = [
                    'id' => $list->id,
                    'name' => $list->name,
                    'parent_id'=> $list->parent_id,
               ];    
            }
        };

        $paramSort = ($sort_type === $defaultSort) ? 'DESC' : $defaultSort;

        // Set danh sách sản phẩm ra ngoài view
        $data = [
            'keywork' => $keywork,
            'sort_by' => $paramSort,
            'lists' => $lists,
            'arr' => $arr,
        ];
    

        
        return view('admin.category.lists', $data,[
           
        ]);
    }  
    
    
    public function Category_insert(Request $request)
    {
        if ($request->method() === 'POST') {
            $request->validate([
                'name' => 'required',
                
            ]);
            $category = new Category();
            $category->name = $request->input('name');
            $category->slug =  Str::slug($request->input('name'));
            $category->parent_id = $request->input('select');
          
            $category->save();
            //$request->session()->flash('oke', 'bạn đã thêm thành công!');
            //return redirect()->route('admin.category.insert');
       
        };
      
       
        return view('admin.category.insert');
    }

    
    // ----------------edit------------------------
    public function  Category_edit($id, Request $request)
    {
     
        $category = Category::find($id);
        if($category === NULL){
            throw ValidationException::withMessages(['id' => 'không có sản phẩm!']);
        }

             
        if ($request->method() === 'POST') {

            $request->validate([
                'name' => 'required',             
            ]);         
            $category->name = $request->input('name');
            $category->slug =  Str::slug($request->input('name'));
            
            $category->save();
            $request->session()->flash('status', 'thành công!');

        }

        $data = [
            'category' => $category 
        ];
        return view('admin.category.edit', $data);
    }

    // .................delete.............................

    public function Category_delete(Request  $request, $id)
    {
       
      
        $category = category::find($id);
             
        if($category === NULL){
            throw ValidationException::withMessages(['id' => 'không có sản phẩm!']);
        }
      
        //$category->forceDelete();//xóa vĩnh viển khỏi db
        $category->delete(); // xoa tam trong table
       
        $request->session()->flash('delete', 'bạn đã xóa thành công!');
        return redirect()->route('admin.category.index');
    }


// .......................xóa tạm thời........................................
    public function Category_soft_delete(Request  $request)
    {
        $lists = Category::onlyTrashed()->orderBy('name', 'ASC')->paginate(20);
        $data = [
            'lists' => $lists,
        ];
      
        return view('admin.category.softdelete', $data);
    }



// ................xoa het...........................
    public function Category_deleteall(Request  $request)
    {
        $ids = $request->post('ids');
        $array_ids = array($ids);
        $dem = 0;
        if (count($array_ids)) {
            foreach($array_ids as $id) {
                $category = Category::find($id);
                if($category !== NULL) {
                    $category->delete();
                    $dem ++;
                }
            }
        }

        $request->session()->flash('delete', sprintf('Ban da xoa thanh cong %s item', $dem));
        return redirect()->route('admin.category.index');
    }


    public function Category_restore(Request $request) {
        $ids = $request->post('ids');
        // .....
        $dem = 0;
        if (is_array($ids) && count($ids)) {
            foreach($ids as $id) {
                $category = Category::onlyTrashed()->where('id', $id)->first();
                if($category !== NULL) {
                    $category->restore();
                    $dem ++;
                }
            }
        }


        $request->session()->flash('loi', sprintf('không có items nào được chon'));
        $request->session()->flash('delete', sprintf('Ban da restore thanh cong %s item', $dem));
        return redirect()->route('soft_delete');
      
    
    }

   
}


