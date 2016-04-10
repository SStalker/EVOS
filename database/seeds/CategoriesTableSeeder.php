<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Mathe',
            'user_id' => 1
        ]);

        DB::table('categories')->insert([
            'title' => 'Sinnlos',
            'user_id' => 1
        ]);
    }
}
