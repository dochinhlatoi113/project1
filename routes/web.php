<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front end
Route::group(['middleware' => 'userauth'], function () {

    Route::get('/test', [App\Http\Controllers\Front\TestController::class, 'index'])->name('test_index');

    //Route::get('/pay', [App\Http\Controllers\Front\PayController::class, 'pay'])->name('pay');
    Route::match(['POST','GET'],'/discount',[App\Http\Controllers\Front\DiscountController::class, 'index'])->name('discount_checkcode'); 
});

Route::get('/home', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
Route::get('/detail', [App\Http\Controllers\Front\DetailProductController::class, 'detail'])->name('detail');
//Route::get('/add-cart', [App\Http\Controllers\Front\CartController::class, 'add'])->name('cart_add');
Route::match(['get','post'],'/add-cart', [App\Http\Controllers\Front\CartController::class, 'add'])->name('cart_add');
Route::get('cart/list', [App\Http\Controllers\Front\CartController::class, 'list'])->name('cart_list');
Route::get('cart/delete', [App\Http\Controllers\Front\CartController::class, 'delete'])->name('cart_list_delete');

Route::get('/pay', [App\Http\Controllers\Front\PayController::class, 'pay'])->name('pay');
Route::post('pay/order', [App\Http\Controllers\Front\PayController::class, 'order'])->name('order');

Route::match(['POST','GET'],'/order_success',[App\Http\Controllers\Front\PayController::class, 'order_success'])->name('order_success');

Route::get('/post_ajax_tesdt', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('post_ajax_test');

Route::match(['GET', 'POST'],'/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('auth_register');

Route::match(['GET', 'POST'],'/forgot-password', [App\Http\Controllers\Auth\iForgotPasswordController::class, 'index'])->name('auth_forgot_password');

Route::match(['GET', 'POST'],'/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::match(['GET', 'POST'],'/reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'reset'])->name('password.reset');


Route::match(['GET', 'POST'],'/login',[App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth_login'); 

//Route::match(['GET', 'POST'],'/login-info',[App\Http\Controllers\Auth\LoginController::class, 'login_info'])->name('auth_login-info'); 

Route::match(['GET', 'POST'],'/user-info',[App\Http\Controllers\Front\UserController::class, 'update'])->name('user_update_info');


route::get('/shop',[App\Http\Controllers\Front\ShopController::class, 'index'])->name('shop_index');
route::get('/blog',[App\Http\Controllers\Front\BLogController::class, 'index'])->name('blog_index');
route::get('/contact',[App\Http\Controllers\Front\ContactController::class, 'contact'])->name('contact');

 






// admin
// {{ route('admin.category.index') }}


Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::match(['GET', 'POST'],'/login', [App\Http\Controllers\Admin\LoginController::class, 'admin'])->name('login');
        Route::match(['GET', 'POST'],'/home', [App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');

      
    
    // category
    Route::group(['middleware' => 'adminauth'], function (){ 
       

    Route::prefix('report')
        ->name('report.')
        ->group(function () {
            Route::match(['POST','GET'],'/list_order',[App\Http\Controllers\Report\listOrderController::class, 'list_order'])->name('list_order');

            Route::match(['POST','GET'],'/index_report',[App\Http\Controllers\Report\IndexController::class, 'index_report_order'])->name('index_report_order');

            Route::match(['POST','GET'],'/detail_report',[App\Http\Controllers\Report\DetailController::class, 'index_detail_order'])->name('index_detail_order');
    });   
     //..........rp................ 
    Route::prefix('category')
        ->name('category.')
        ->group( function () {

       
          
            
            Route::match(['GET','POST'],'/', [App\Http\Controllers\Admin\CategoryController::class, 'category_index'])->name('index');

            Route::match(['GET','POST'], '/insert', [App\Http\Controllers\Admin\CategoryController::class, 'Category_insert'])->name('insert'); 

            Route::match(['GET', 'POST'], '/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'Category_edit'])->name('edit');

            Route::get('/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'Category_delete'])->name('delete');

            Route::get('/soft_delete', [App\Http\Controllers\Admin\CategoryController::class, 'Category_soft_delete'])->name('soft_delete');

            Route::post('/deleteall', [App\Http\Controllers\Admin\CategoryController::class, 'Category_deleteall'])->name('del_all');

            Route::post('/restore-cate', [App\Http\Controllers\Admin\CategoryController::class, 'Category_restore'])->name('restore_cate'); 

        });
   
});  
    // ................brands................
Route::group(['middleware' => 'adminauth'], function (){ 
    Route::match(['POST','GET'],'/brands',[App\Http\Controllers\Admin\BrandsController::class, 'index'])->name('brands'); 

    Route::match(['POST','GET'],'/brands/insert',[App\Http\Controllers\Admin\BrandsController::class, 'insert'])->name('brands_insert'); 

    Route::match(['POST','GET'],'/brands/delete/{id}',[App\Http\Controllers\Admin\BrandsController::class, 'delete'])->name('brands_delete');

    Route::match(['POST','GET'],'/brands/soft_delete',[App\Http\Controllers\Admin\BrandsController::class, 'soft_delete'])->name('brands_soft_delete'); 

    Route::match(['POST','GET'],'/brands/deleteall',[App\Http\Controllers\Admin\BrandsController::class, 'deleteall'])->name('brands_deleteall'); 

    Route::match(['POST','GET'],'/brands/edit/{id}',[App\Http\Controllers\Admin\BrandsController::class, 'edit'])->name('brands_edit'); 

    Route::match(['POST','GET'],'/brands/restore',[App\Http\Controllers\Admin\BrandsController::class, 'restore'])->name('brands_restore'); 

    
//   .............products.................................................
Route::prefix('products')
->name('products.')
->group(function () {

        /*
        Route::get('/', [App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('index');

        Route::get('/create', [App\Http\Controllers\Admin\ProductsController::class, 'create'])->name('create');

        Route::get('/edit', [App\Http\Controllers\Admin\ProductsController::class, 'edit'])->name('edit');

        Route::get('/delete', [App\Http\Controllers\Admin\ProductsController::class, 'delete'])->name('delete');

        Route::get('/update-status', [App\Http\Controllers\Admin\ProductsController::class, 'updateStatus'])->name('update_status');
        */
        
    
        Route::get('/', [App\Http\Controllers\Admin\ProductsController::class, 'Products_index'])->name('index');

        Route::match(['POST','GET'],'/index_ajax', [App\Http\Controllers\Admin\ProductsController::class, 'Products_indexAjax'])->name('index_ajax');

        Route::POST('/upload_des_img', [App\Http\Controllers\Admin\ProductsController::class, 'Products_upload_des_img'])->name('upload_des_img');

        Route::match(['GET'], '/insert', [App\Http\Controllers\Admin\ProductsController::class, 'Products_insert'])->name('insert'); 

        Route::match(['POST'], '/post_product', [App\Http\Controllers\Admin\ProductsController::class, 'Products_post_product'])->name('post_product'); 

        Route::match(['POST'], '/post_image', [App\Http\Controllers\Admin\ProductsController::class, 'Products_post_image'])->name('post_image');

        Route::match(['POST'], '/post_images', [App\Http\Controllers\Admin\ProductsController::class, 'Products_post_images'])->name('post_images');

        Route::match(['POST'], '/del_image', [App\Http\Controllers\Admin\ProductsController::class, 'Products_del_image'])->name('del_image');

        Route::match(['GET','POST'], '/del_editAlbums', [App\Http\Controllers\Admin\ProductsController::class, 'Products_del_editAllAlbums'])->name('del_editAlbums');

        
        Route::match(['GET','POST'], '/del_editAvatarImage', [App\Http\Controllers\Admin\ProductsController::class, 'Products_del_editAvatarImage'])->name('del_editAvatarImage');
                    

        Route::match(['GET', 'POST'], '/edit/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'Products_edit'])->name('edit');

        Route::match(['GET', 'POST'], '/edit_ajax/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'Products_edit_ajax'])->name('edit_ajax');
        
        Route::match(['GET', 'POST'], '/post_editAjax', [App\Http\Controllers\Admin\ProductsController::class, 'Products_post_editAjax'])->name('post_editAjax');

        Route::match(['GET', 'POST'], '/edit_img', [App\Http\Controllers\Admin\ProductsController::class, 'Products_edit_img'])->name('edit_img');

        Route::get('/delete/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'Products_delete'])->name('delete');

        Route::get('/soft_delete', [App\Http\Controllers\Admin\ProductsController::class, 'Products_soft_delete'])->name('soft_delete');

        Route::post('/deleteall', [App\Http\Controllers\Admin\ProductsController::class, 'Products_deleteall'])->name('delete_all');

        Route::post('/restore-cate', [App\Http\Controllers\Admin\ProductsController::class, 'Products_restore'])->name('restore_products'); 
    // ..............pagination................
      

        Route::get('/pagination
        ', [App\Http\Controllers\Admin\ProductsController::class, 'pagination_ajax'])->name('pagination_ajax_products'); 
    });
    
//........mã giảm giá........................
    Route::match(['POST','GET'],'/discount',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_index'])->name('index'); 

    Route::match(['POST','GET'],'/discount/insert',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_insert'])->name('index_insert'); 

    Route::match(['POST','GET'],'/discount/delete/{id}',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_delete'])->name('discount_delete');

    Route::match(['POST','GET'],'/discount/soft_delete',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_soft_delete'])->name('discount_soft_delete'); 

    Route::match(['POST','GET'],'/discount/deleteall',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_deleteall'])->name('discount_deleteall'); 

    Route::match(['POST','GET'],'/brands/edit/{id}',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_edit'])->name('discount_edit'); 

    Route::match(['POST','GET'],'/brands/restore',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_restore'])->name('discount_restore'); 

    Route::match(['POST','GET'],'/check',[App\Http\Controllers\Admin\DiscountController::class, 'Discount_check_dis'])->name('check_dis');

  }); 
  Route::get('/mail', [App\Http\Controllers\Mail\MailController::class, 'mail_order'])->name('mail_order');

  //..........permission..............
  Route::prefix('permission')
        ->name('permission.')
        ->group( function () {    
          
        
            Route::match(['GET','POST'], '/permission-insert', [App\Http\Controllers\Admin\PermissionController::class, 'insert'])->name('permission.insert');

            Route::match(['GET','POST'], '/permission', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permission.index');
        });
//................post........................................
        Route::prefix('post')
        ->name('post.')
        ->group( function () {    
          
        
            Route::match(['GET','POST'], '/post-insert', [App\Http\Controllers\Admin\PostController::class, 'Post_insert'])->name('post.insert');

            Route::match(['GET','POST'], '/post', [App\Http\Controllers\Admin\PostController::class, 'Post_index'])->name('post.index');

            Route::match(['GET','POST'], '/post_softDelete', [App\Http\Controllers\Admin\PostController::class, 'Post_soft_delete'])->name('post_soft_delete');

            Route::match(['GET', 'POST'], '/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'Post_edit'])->name('edit');

            Route::get('/delete/{id}', [App\Http\Controllers\Admin\PostController::class, 'Post_delete'])->name('delete');

            Route::get('/soft_delete', [App\Http\Controllers\Admin\PostController::class, 'Post_soft_delete'])->name('soft_delete');

            Route::post('/deleteall', [App\Http\Controllers\Admin\CategoryController::class, 'Post_deleteall'])->name('del_all');

            Route::post('/restore-cate', [App\Http\Controllers\Admin\CategoryController::class, 'Post_restore'])->name('restore_cate'); 
        });    
});

