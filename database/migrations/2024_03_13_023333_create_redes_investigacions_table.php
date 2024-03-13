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
        Schema::create('redes_investigacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('nivel', 30);
            $table->unsignedBigInteger('proyecto_id')->nullable();

            $table
                ->foreign('proyecto_id')
                ->references('id')
                ->on('proyectos');
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
        Schema::dropIfExists('redes_investigacions');
    }
};
