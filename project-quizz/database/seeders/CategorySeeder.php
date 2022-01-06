<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category([
            'name'=>'PHP'
        ]);
        $category->save();
        $category = new Category([
            'name'=>'Java'
        ]);
        $category->save();
        $category = new Category([
            'name'=>'JavaScript'
        ]);
        $category->save();
    }
}
