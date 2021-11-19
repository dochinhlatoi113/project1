<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\Discounts;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class DiscountController extends Controller
{
    public function Discount_index(Request $request)
    {
        
        $defaultSort = 'ASC';
        $sort_type = $request->get('sort_by', $defaultSort);
        $keywork = $request->get('keywork');

        
        $lists = Discounts::where('code', 'LIKE', "%".$keywork."%")->orderBy('code', $sort_type)->paginate(10);
        //$lists = Discounts::get();

        $paramSort = ($sort_type === $defaultSort) ? 'DESC' : $defaultSort;

        // Set danh sách sản phẩm ra ngoài view
        $data = [
            'keywork' => $keywork,
            'sort_by' => $paramSort,
            'lists' => $lists,
        ];
    
        return view('admin.discount.lists', $data,[
           
        ]);
    }  
    
    
    public function Discount_insert(Request $request)
    {
        if ($request->method() === 'POST') {
            
            $request->validate([
                'name' => 'required|numeric|',
                'dis_money' =>'required'
            ]);
            $list = new Discounts();
            $list->code = $request->input('name');
            $list->discount =  $request->input('dis_money');
            $list->status =  1;
            $list->max_time =  $request->input('max_time');
            $list->save();
            $request->session()->flash('oke', 'bạn đã thêm thành công!');
            return redirect()->route('admin.index_insert');
        // $name = 'giày nam thể thao';
        // $slug = Str::slug($name, '-----');
        // //var_dump($slug);exit;
        };

        return view('admin.discount.insert');
    }
    // ----------------edit------------------------
  

        public function Discount_edit($id, Request $request)
        {
         
            $lists = Discounts::find($id);
            if($lists === NULL){
                throw ValidationException::withMessages(['id' => 'không có sản phẩm!']);
            }
    
                 
            if ($request->method() === 'POST') {
    
                $request->validate([
                    'name' => 'required',             
                ]);         
                $lists->name = $request->input('name');
                $lists->slug =  Str::slug($request->input('name'));
                
                $lists->save();
                $request->session()->flash('status', 'thành công!');
    
            }
    
            $data = [
                'lists' => $lists
            ];
        
        return view ('',$data,[]);
    }

    ///////////////////delete/////////////////////////
    public function Discount_delete(Request  $request, $id)
    {
       
      
        $lists = Discounts::find($id);
           
        if($lists === NULL){
            throw ValidationException::withMessages(['id' => 'không có sản phẩm!']);
        }
      
        //$category->forceDelete();//xóa vĩnh viển khỏi db
        $lists->delete(); // xoa tam trong table
       
        $request->session()->flash('delete', 'bạn đã xóa thành công!');
        return redirect()->route('admin.index');
    }


    ///////////////////soft-delte///////////////////////////////
    public function Discount_soft_delete(Request  $request){
        
        $lists = Discounts::onlyTrashed()->orderBy('name', 'ASC')->paginate(5);
        // dd($brands);exit;
        $data = [
            'lists' => $lists
        ];
      
        return view('admin.discount.softdelete', $data);
    }

    /////////////////////////delete-all///////////////////////
    public function Discount_deleteall(Request  $request)
    {
    
        $ids = $request->post('ids');
        $array_ids = array($ids);
        $dem = 0;
        if (count($array_ids)) {
            foreach($array_ids as $id) {
                $lists = Discounts::find($id);
                if($lists !== NULL) {
                    $lists->delete();
                    $dem ++;
                }
            }
        }

        $request->session()->flash('delete', sprintf('Ban da xoa thanh cong %s item', $dem));
        return redirect()->route('admin.index');
    }

    // ................restore........
    public function Discount_restore(Request $request) {

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
        return redirect()->route('admin.discount_soft_delete');
      
    
        }  

    public function Discount_check_dis(Request $request ){
      
            
        /*
            $checkDis = $request->get('disCheck');
            $list = Discounts::where('code', $checkDis)->first();
            if($list === NULL) {
                // ma code khong dung
                return response()->json([
                    'status' => 'ERR',
                    'result' => [],
                    'mess' => 'Ma code khong dung'
                    
                ]);
            }else{
                    if (Auth::check()) {
                    $res = $list['discount'];
                    $id = $list['id'];
                    return response()->json([
                        'status' => 'OK',
                        'result' => $res,
                        'mess' => ''
                    ]);
                }else{
                    return response()->json([
                        'status' => 'E',                        
                        'mess' => 'đăng nhập để sử dụng mã code'
                    ]);
                }
            
             }*/
        
        /*
        foreach($list as $item){
            if(isset($item['code'])){
                
               
            }
        }*/
    
       
        
    }
    
}
