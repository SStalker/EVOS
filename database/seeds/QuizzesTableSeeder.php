<?php

use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->insert([
            'title' => 'Einfach',
            'category_id' => 1
        ]);

        DB::table('quizzes')->insert([
            'title' => 'Schwer',
            'category_id' => 1
        ]);

        DB::table('quizzes')->insert([
            'title' => 'Guck mal rein',
            'category_id' => 2
        ]);
        
        DB::table('quizzes')->insert([
            'title' => 'Oder lass es sein',
            'category_id' => 2
        ]);
    }
}
