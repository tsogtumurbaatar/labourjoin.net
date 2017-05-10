<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('quiz_type');
            $table->integer('verb_numbers');
            $table->integer('quiz_numbers');
            $table->string('correct_answer');
            $table->string('percentage');
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
        Schema::dropIfExists('users_score');
    }
}
