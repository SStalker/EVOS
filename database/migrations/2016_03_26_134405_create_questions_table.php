<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->text('title');
            $table->text('question');
            $table->text('answerA');
            $table->text('answerB');
            $table->text('answerC');
            $table->text('answerD');
            $table->string('correct_answers')->default('{a: false, b: false, c: false, d: false}');
            $table->integer('countdown')->default(30);
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
