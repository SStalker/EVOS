<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'question' => 'Bist du sicher?',
            'quiz_id' => 1,
            'answerA' => 'test',
            'answerB' => 'test',
            'answerC' => '',
            'answerD' => '',
            'correct_answers' => '{"a": false, "b": true, "c": false, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Alles klar?',
            'quiz_id' => 1,
            'answerA' => 'test',
            'answerB' => 'test',
            'answerC' => '',
            'answerD' => '',
            'correct_answers' => '{"a": false, "b": true, "c": false, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Kiffen?',
            'quiz_id' => 1,
            'answerA' => 'test',
            'answerB' => 'test',
            'answerC' => '',
            'answerD' => '',
            'correct_answers' => '{"a": false, "b": true, "c": false, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Was ist was?',
            'quiz_id' => 1,
            'answerA' => 'test',
            'answerB' => 'test',
            'answerC' => '',
            'answerD' => '',
            'correct_answers' => '{"a": false, "b": true, "c": false, "d": false}'
        ]);
    }
}
