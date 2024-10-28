<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlace_modulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',100);
            $table->string('enlace',100);
            $table->string('parametro',100)->nullable();
            $table->string('estilo')->default('btn btn-sm m-1 btn-outline-success');
            $table->string('permiso',100);
            $table->unsignedBigInteger('modulo_id')->nullable();
            $table->foreign('modulo_id')->references('id')->on('modulos');
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
        Schema::dropIfExists('enlace_modulos');
    }
};
