<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brands;
use Illuminate\Http\Request;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Request $request)
    {
        $list = new Brands();
        $list->name = $request->input('name');
        $list->slug = $request->name;
        $list->save();

    }
       
}
