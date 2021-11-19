<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [
               
            ],
        ]);
    }
}
