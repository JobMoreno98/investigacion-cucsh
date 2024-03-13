<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('evaluador_id')->constrained('users')->default('0');
            $table->foreignId('ciclo_id')->constrained('ciclos');

            $table->string('tipo_registro',30);
            $table->string('tipo_proyecto',30);
            $table->string('sector',30);
            $table->string('otras_instituciones')->default('No aplica');

            $table->string('titulo_proyecto');
            $table->string('fecha_inicio',10);
            $table->string('fecha_fin',10);
            $table->text('abstract');
            $table->text('personal');
            $table->string('recursos_concurrentes')->default('No aplica');

            $table->string('divulgacion');
            $table->string('otros')->default('No aplica');
            $table->string('vinculacion_ca')->default('No aplica');
            $table->string('vinculacion_redes')->default('No aplica');

            $table->foreignId('recursos_id')->constrained('recursos');


            $table->string('anexo')->default('No aplica');
            $table->string('cronograma')->default('No aplica');
            
            $table->tinyInteger('definitivo')->default('0');
            $table->tinyInteger('activo')->default('1');
 
            
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
        Schema::dropIfExists('proyectos');
    }
}
