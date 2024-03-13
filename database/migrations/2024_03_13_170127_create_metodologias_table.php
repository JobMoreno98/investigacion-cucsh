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
        Schema::create('metodologias', function (Blueprint $table) {
            $table->id();
            $table->text('metodologia');
            $table->text('objetivos');
            $table->text('hipotesis');
            $table->text('criterios_eticos');
            $table->text('referecnias');
            $table->string('anexos',200);
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
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
        Schema::dropIfExists('metodologias');
    }
};
