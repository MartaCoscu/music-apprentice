<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciceSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercice_session', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exercice_id')->unsigned();
            $table->integer('session_id')->unsigned(); 
            $table->integer('tempo');
            $table->integer('seconds');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercice_session');
    }
}
