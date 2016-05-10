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
            'title' => 'Mathematik für E - Differentialgleichungen',
            'category_id' => 2
        ]);

        DB::table('quizzes')->insert([
            'title' => 'Mathematik für E - Reihen',
            'category_id' => 2
        ]);

        DB::table('quizzes')->insert([
            'title' => 'Mathematik für E - Komplexe Zahlen',
            'category_id' => 2
        ]);

        DB::table('quizzes')->insert([
            'title' => 'Mathematik für E - Funktionen mit mehreren Veränderlichen',
            'category_id' => 2
        ]);

    }
}
