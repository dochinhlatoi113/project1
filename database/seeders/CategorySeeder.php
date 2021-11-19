<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'parent_id' => NULL,
                'name' => 'Tui',
                'slug' => 'tui',
                'childs' => [
                    [
                        'name' => 'Tui nam',
                        'slug' => 'tui nam',
                    ]
                ]
            ],
            [
                'parent_id' => NULL,
                'name' => 'Giay',
                'slug' => 'giay'
            ]
        ];

        foreach($data as $item) {
            $parent = Category::where('slug')->first();
            if($parent === NULL) {
                $category = new Category();
                $category->parent_id = NULL;
                $category->name = $item['name'];
                $category->slug = $item['slug'];
                $category->save();
                if(isset($item['childs'])) {
                    foreach($item['childs'] as $child) {
                        $child = Category::where('slug')->first();
                        if($child === NUlL) {
                            $child = new Category();
                            $child->parent_id = $category->id;
                            $child->name = $item['name'];
                            $child->slug = $item['slug'];
                            $child->save();
                        }
                    }
                }
            }
        }
    }
}
