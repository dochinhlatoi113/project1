<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            [
                'title' =>'thêm',
                'group' =>'product',
                'guard' => 'admin',
                'name'  =>'Products_insert',
                'status' =>0 
            ],
            [
                'title' =>'sửa',
                'group' =>'product',
                'guard' => 'admin',
                'name'  =>'Products_edit',
                'status' =>0 
            ],
            [
                'title' =>'xóa',
                'group' =>'product',
                'guard' => 'admin',
                'name'  =>'Products_deleteall',
                'status' =>0 
            ],

            [
                'title' =>'xóa_tạm',
                'group' =>'product',
                'guard' => 'admin',
                'name'  =>'Products_soft_delete',
                'status' =>0 
            ],            

            [
                'title' =>'khôi phục',
                'group' =>'product',
                'guard' => 'admin',
                'name'  =>'Products_restore',
                'status' =>0 
            ],   

            [
                'title' =>'xem',
                'group' =>'product',
                'guard' => 'admin',
                'name'  =>'Products_index',
                'status' =>0 
            ],
//.......................category................
            [
                'title' =>'thêm',
                'group' =>'category',
                'guard' => 'admin',
                'name'  =>'Category_insert',
                'status' =>0 
            ],
            [
                'title' =>'sửa',
                'group' =>'category',
                'guard' => 'admin',
                'name'  =>'Category_edit',
                'status' =>0 
            ],
            [
                'title' =>'xóa_tạm',
                'group' =>'category',
                'guard' => 'admin',
                'name'  =>'Category_soft_delete',
                'status' =>0 
            ],            

            [
                'title' =>'khôi phục',
                'group' =>'product',
                'guard' => 'admin',
                'name'  =>'Category_restore',
                'status' =>0 
            ],   
            [
                'title' =>'xóa',
                'group' =>'category',
                'guard' => 'admin',
                'name'  =>'Category_delete',
                'status' =>0 
            ],
            [
                'title' =>'xem',
                'group' =>'category',
                'guard' => 'admin',
                'name'  =>'Category_index',
                'status' =>0 
            ],
            //........................mã giãm giá...
            [
                'title' =>'thêm',
                'group' =>'discount',
                'guard' => 'admin',
                'name'  =>'Discount_insert',
                'status' =>0 
            ],
            [
                'title' =>'sửa',
                'group' =>'discount',
                'guard' => 'admin',
                'name'  =>'Discount_edit',
                'status' =>0 
            ],
            [
                'title' =>'xóa',
                'group' =>'discount',
                'guard' => 'admin',
                'name'  =>'Discount_delete',
                'status' =>0 
            ],
            [
                'title' =>'xem',
                'group' =>'discount',
                'guard' => 'admin',
                'name'  =>'Discount_index',
                'status' =>0 
            ],
            //..............report.....................
            [
                'title' =>'thêm',
                'group' =>'report',
                'guard' => 'admin',
                'name'  =>'insert',
                'status' =>0 
            ],
            [
                'title' =>'sửa',
                'group' =>'report',
                'guard' => 'admin',
                'name'  =>'product_edit',
                'status' =>0 
            ],
            [
                'title' =>'xóa',
                'group' =>'report',
                'guard' => 'admin',
                'name'  =>'delete',
                'status' =>0 
            ],
            [
                'title' =>'xem',
                'group' =>'report',
                'guard' => 'admin',
                'name'  =>'index',
                'status' =>0 
            ],
            //......QTV................
            [
                'title' =>'thêm',
                'group' =>'permission',
                'guard' => 'admin',
                'name'  =>'Permission_insert',
                'status' =>0 
            ],
            [
                'title' =>'sửa',
                'group' =>'permission',
                'guard' => 'admin',
                'name'  =>'Permission_edit',
                'status' =>0 
            ],
            [
                'title' =>'xóa',
                'group' =>'permission',
                'guard' => 'admin',
                'name'  =>'Permission_delete',
                'status' =>0 
            ],
            [
                'title' =>'xem',
                'group' =>'permission',
                'guard' => 'admin',
                'name'  =>'Permission_index',
                'status' =>0 
            ],
            //.............post....................
            [
                'title' =>'thêm',
                'group' =>'post',
                'guard' => 'admin',
                'name'  =>'Post_insert',
                'status' =>0 
            ],
            [
                'title' =>'sửa',
                'group' =>'post',
                'guard' => 'admin',
                'name'  =>'Post_edit',
                'status' =>0 
            ],
            [
                'title' =>'xóa',
                'group' =>'post',
                'guard' => 'admin',
                'name'  =>'Post_delete',
                'status' =>0 
            ],
            [
                'title' =>'xem',
                'group' =>'post',
                'guard' => 'admin',
                'name'  =>'Post_index',
                'status' =>0 
            ],
            [
                'title' =>'xóa_tạm',
                'group' =>'post',
                'guard' => 'admin',
                'name'  =>'Post_soft_delete',
                'status' =>0 
            ],            

            [
                'title' =>'khôi phục',
                'group' =>'post',
                'guard' => 'admin',
                'name'  =>'Post_restore',
                'status' =>0 
            ],   
        ]);
    }
}
