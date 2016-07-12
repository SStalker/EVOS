<?php

use Illuminate\Database\Seeder;
use EVOS\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['title' => 'Mathe', 'user_id' => 1],
            ['title' => 'Mathematik für E - Beispiele', 'user_id' => 1]
        ];

        Category::buildTree($categories);
    }
}
