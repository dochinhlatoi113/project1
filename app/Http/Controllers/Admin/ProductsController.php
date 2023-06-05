<?php

namespace App\Http\Controllers\Admin;
use Intervention\Image\ImageManager;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Bienthe_Products;
use App\Models\Category;
use App\Models\ProductsImg;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Illuminate\Database\Eloquent\Model;

class ProductsController extends Controller
{
    public function Products_index(Request $request)
    {
      
      
        return view('admin.products.lists');
    }  

    public function Products_indexAjax(Request $request) {
        $defaultSort = 'ASC';
        $sort_type = $request->get('sort_by', $defaultSort);
        $keywork = $request->get('keywork', NULL);
        
        $lists = Products::where('name', 'LIKE', '%' .$keywork. '%')->orderBy('name', $sort_type)->paginate(1);
        $nofi = '';
         if((count($lists)==0)){
            $nofi = 'khong co data';
         }   
        $data = [
            'lists' => $lists,
            'keywork' => $keywork,
        ];

        $html = view('admin.products.lists_ajax', $data)->render();

        return response()->json([
            'status' => 'OK',
            'result' => ['html' => $html, 'keywork' => $keywork, 'result_total' => $lists->total()],
            'mess' => ''
        ]);
    }
    
    
    public function Products_insert(Request $request)
    {
      
        $categories = Category::get();
        $brands = Brands::get();
        
      
        $arr = [];
        foreach($categories as $list) {
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
        
        $data = array(
            
            'brands' => $brands,
            'arr' => $arr
        );
        
        return view('admin.products.insert', $data);
    }

    public function Products_upload_des_img(Request $request){
        $fileName=$request->file('file')->getClientOriginalName();
        $path=$request->file('file')->storeAs('des_img', $fileName, 'public');
        return response()->json(['location'=>"/des_img/$fileName"]); 
    }
  
    public function Products_post_product(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            //'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brands_id' => 'required|exists:brands,id',
            'category_id' =>'required',
            
           
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            return response()->json([
                'status' => 'ERR',
                'result' => [],
                'messages' => $errors
            ]);
        }

        $albums = $request->post('albums');

     
        $products = new Products();
        $products->name = $request->input('name');
        $products->price = $request->input('price');
        $products->brands_id = $request->input('brands_id');
        $products->category_id = $request->input('category_id');        
        $products->slug =  Str::slug($request->input('name'));
        $products->img = $request->input('hinh_dai_dien', NULL);
        $products->soluong = $request->input('number', 1);
         $products->des = $request->input('des-longs');
        $products->des_img = $request->input('des_img');
      
        
        $products->save();
      
        // lap images post tu ben ngoai
        if (count((array)$albums)) {
            // loopp
            $albumTams = array();
            foreach($albums as $album) {
                $albumTams[] = new ProductsImg(['images_path' => $album, 'created_at' => date('Y-m-d H:i:s')]);
            }
            // end loop

            $products->albums()->saveMany($albumTams);
        }
     
        return response()->json([
            'status' => 'OK',
            'result' => ['url' => route('admin.products.insert' )],
            'mess' => 'Bạn đã thêm thành công!'
        ]);

        // insert product annd image


      
    }

    protected function uploadResizeImage($request, $imagex)
    {
        $filename = $imagex->getclientoriginalname(); 
        $thumbPath = public_path('product_images/thumb');
        $image_resize = Image::make($imagex->getRealPath());
        $image_resize->resize(400,300, function($xxx){
                $xxx->aspectRatio();
        })->save($thumbPath.'/'.$filename);
      
        $newFile = time().$filename;

        $mainPath = public_path('image');
        $imagex->move($mainPath,  $newFile);        

        $old = $filename; 
        rename( $thumbPath . "/" . $old, $thumbPath . "/" . $newFile );

        $getPathThumb = url('product_images/thumb/'.$newFile);
        $getPathMain =  url('image'.'/'.$newFile);
       
        
        return [
            'initialPreview' => [
                $getPathThumb
            ],
            'initialPreviewConfig' => [
                [
                    'caption' => $newFile,
                    'url' => route('admin.products.del_editAvatarImage'),
                    'extra' => [
                        'url_hinh' => 'image/' . $newFile,
                        'product_id' => $request->get('id')
                    ],
                    'zoomData' =>  $getPathMain
                ],
            ],
            'append' => true
        ];
          
    }
 


    public function Products_post_image(Request $request) {
     
      
            if ( ! $request->hasFile('image')) {
                return response()->json([
                    'error' => 'This is loi asasfas',
                    'initialPreview' => [],
                    'initialPreviewConfig' => [],
                    'append' => true
                ]);
            }
            $imagex = $request->file('image'); 
         
            $arrData = $this->uploadResizeImage($request, $imagex, false);
         
             return response()->json($arrData);
    }

    public function Products_post_images(Request $request) {
    
        if ( ! $request->hasFile('images')) {
            return response()->json([
                'error' => 'This is loi asasfas',
                'initialPreview' => [],
                'initialPreviewConfig' => [],
                'append' => true
            ]);
        }

        $images = $request->file('images');
        
        $arrData = [];
        foreach($images as $image) {
            
            $arrData = $this->uploadResizeImage($request, $image);

            // insert product images
            if( ! empty($request->get('id'))) {
                $productImage = new ProductsImg();
                $productImage->product_id = $request->get('id');
                $productImage->images_path = $arrData['initialPreviewConfig'][0]['extra']['url_hinh'];
                $productImage->save();
            }

        }
        
        return response()->json($arrData);
    }
  

    public function Products_del_image(Request $request) {
       
            // Nhan id tu hinh
        
        $urlImg = basename($request->get('url_hinh'));
       
        
        $imageThumb = public_path('/product_images/thumb');
        $imgPath = public_path('image');
        $delfile = $imgPath."/".$urlImg;
       
        $delfileThumb = $imageThumb."/".$urlImg;
       
        unlink($delfile);
        unlink($delfileThumb);
        

        return response()->json();
    }

    /**
     * Xoa 1 file voi duong dan tuong ung
     * 
     * @param string $filePath duong dan cua file
     * @return boolean true|false true: success, false: not exist
     * 
     */
    // protected function delFile($param1, $param2) 
    // {
    //     if(file_exists($param1, $param2)) {
    //         $files = array($param1, $param2);
    //         File::delete($files);
    //         return true;
    //     }
    //     return false;
    // }

    // ------------...................................----edit------------------------
  

    public function Products_edit($id, Request $request)
    {
        $products = Products::with('albums')->find($id);

        
        $albumPreview = [];
        $albumPreviewConfig = [];

        foreach ($products->albums as $album) {
           
            $fileNameThumb = basename($album->images_path); 
            $albumPreview[] = url('product_images/thumb/'. $fileNameThumb);

            $albumPreviewConfig[] = [
                'caption' => $fileNameThumb,
                'url' => route('admin.products.del_editAvatarImage'),
                'extra' => [
                    'product_id' => $products->id,
                    'url_hinh' => 'image/'. $fileNameThumb,     
                ],
                'zoomData' =>  url('image/'. $fileNameThumb)
            ];
        }
         /////////////////////////////////////////////////////////////
     

         $brands     = Brands::get();
         $categories = Category::get();

         $getPathThumb       = [];
         $getPathThumbConfig = [];

         if ( ! empty($products->img) && $products->img !== '' && file_exists(public_path($products->img))) {
            $fileName     = basename($products->img);
            $getPathThumb = [ url('/product_images/thumb/'.$fileName) ]; 
            $getPathMain  =  url($fileName);

            $getPathThumbConfig = [
                'caption' => $fileName,
                'url' => route('admin.products.del_editAvatarImage'),
                'extra'   => [
                    'product_id' => $products->id,
                    'url_hinh' => $products->img,                          
                ],
                'zoomData' =>  $getPathMain
            ];
         }
        
         $data = [
            'brands'            => $brands,
            'categories'        => $categories,
            'products'          => $products,
           
            'initPreview'       => $getPathThumb,
            'initPreviewConfig' => $getPathThumbConfig,
            'AlPreview'         => $albumPreview,
            'AlConfig'          => $albumPreviewConfig,

        ];
         
        return view ('admin.products.edit_ajax' ,$data);
    }

    
    public function Products_post_editAjax(Request $request){
        
        $productId = $request->post('hidenID');
        $products = Products::with('albums')->find($productId);
        if(!(isset($products['id']))){
            echo 'ko có id';
            exit;
        };
     
        $products->name = $request->input('name');
        $products->price = $request->input('price');
        $products->brands_id = $request->input('brands_id');
        $products->category_id = $request->input('category_id');        
        $products->slug =  Str::slug($request->input('name'));
        $products->soluong = $request->input('number', 1);
        // co the co url hinh hoac khong co url hinh        
        $products->img = $request->input('hinh_dai_dien', NULL);
        $products->save();



        $products->albums()->delete(); 
        if($request->post('albums')){

           $albums = $request->post('albums');

                // lap images post tu ben ngoai
                
                if (count((array)$albums)) {
                    
                    $albumTams = array();
                    foreach($albums as $album) {
                    
                        $albumTams[] = new ProductsImg(['images_path' => $album, 'created_at' => date('Y-m-d H:i:s')]);
                    }
                    // end loop

                    $products->albums()->saveMany($albumTams);
                }   
        
        }
        return response()->json([
            'status' => 'OK',

            'mess' => 'Bạn đã sửa thành công!'
        ]);
    }
    
    

    public function Products_del_editAllAlbums(Request $request){
       
        $id = $request->get('id');
        $products = Products::with('albums')->find($id);

        foreach($products->albums as $row){
            $fileNameThumb = basename($row->images_path); 
            $albumPreview[] = url('product_images/thumb/'. $fileNameThumb);
        }    

        $urlImg = basename($request->get('url_hinh'));
        
        $imageThumb = public_path('/product_images/thumb');
        $delfileThumb = $imageThumb."/".$urlImg;
        $files = array( $delfileThumb);
        File::delete($files);
        
        $products->albums()->delete();            

        return response()->json();
    }

    public function Products_del_editAvatarImage(Request $request)
    {
        $this->del_image($request);

        $productId = $request->post('product_id');
        $delUrl = $request->post('url_hinh');
       
        $products = Products::find($productId);

        $products->albums()->where('images_path', $delUrl)->delete();
     
       
        // xoa file trong table
        $products->img = NULL;
        $products->save();   
         
        return response()->json();
    }

    ///////////////////////////////////////////////////////////////////delete/////////////////////////
    public function Products_delete(Request  $request, $id)
    {
       
      
        $Products = Products::find($id);
           
        if($Products === NULL){
            throw ValidationException::withMessages(['id' => 'không có sản phẩm!']);
        }
      
        //$category->forceDelete();//xóa vĩnh viển khỏi db
        $Products->delete(); // xoa tam trong table
       
        $request->session()->flash('delete', 'bạn đã xóa thành công!');
        return redirect()->route('admin.products.index');
    }


    ///////////////////soft-delte///////////////////////////////
    public function Products_soft_delete(Request  $request){
        
        $Products = Products::onlyTrashed()->orderBy('name', 'ASC')->paginate(5);
        // dd($brands);exit;
        $data = [
            'Products' => $Products
        ];
      
        return view('admin.products.softdelete', $data);
    }

    /////////////////////////delete-all///////////////////////
    public function Products_deleteall(Request  $request)
    {
    
        $array_ids = $request->post('ids', array());
        $dem = 0;
        if (count($array_ids)) {
            foreach($array_ids as $id) {
                $product = Products::find($id);
                if($product !== NULL) {
                    $product->delete();
                    $dem ++;
                }
            }
        }

        $request->session()->flash('delete', sprintf('Ban da xoa thanh cong %s item', $dem));
        return redirect()->route('admin.products.index');
    }

    // ................restore........
    public function Products_restore(Request $request) {

        $ids = $request->post('ids');
        $array_ids = array($ids);
        $dem = 0;
        if (count($array_ids)) {
            foreach($array_ids as $id) {
                $products = products::onlyTrashed()->where('id', $id)->first();
                if($products !== NULL) {
                    $products->restore();
                    $dem ++;
                }
            }
        }

        $request->session()->flash('delete', sprintf('Ban da restore thanh cong %s item', $dem));
        return redirect()->route('admin.products.soft_delete');
      
    }  
    // upload_des_img
   
}

