<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->integer('p_01')->default(0);
            $table->integer('p_02')->default(0);
            $table->integer('p_03')->default(0);
            $table->integer('p_04')->default(0);
            $table->integer('p_05')->default(0);
            $table->integer('p_06')->default(0);
            $table->integer('p_07')->default(0);
            $table->integer('p_08')->default(0);
            $table->integer('p_09')->default(0);
            $table->integer('p_10')->default(0);
            $table->integer('p_11')->default(0);
            $table->integer('p_12')->default(0);
            $table->integer('p_13')->default(0);
            $table->string('justificacion')->default('No aplica');
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
        Schema::dropIfExists('recursos');
    }
}
