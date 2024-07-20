<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW modulos_enlaces 
            AS
        SELECT
    `enlace_modulos`.`id` AS `enlace_id`,
    `enlace_modulos`.`titulo` AS `enlace_titulo`,
    `enlace_modulos`.`enlace` AS `enlace_enlace`,
    `enlace_modulos`.`parametro` AS `enlace_parametro`,
    `enlace_modulos`.`estilo` AS `enlace_estilo`,
    `enlace_modulos`.`permiso` AS `enlace_permiso`,
    `enlace_modulos`.`modulo_id` AS `modulo_id`,
    `modulos`.`nombre` AS `modulo_nombre`,
    `modulos`.`permiso` AS `modulos_permiso`,
    `modulos`.`color` AS `modulo_color`,
    `modulos`.`icono` AS `modulo_icono`,
    `modulos`.`orden` AS `modulo_orden`
FROM
    (
        `enlace_modulos`
    JOIN `modulos`
    )
WHERE
    (
        `enlace_modulos`.`modulo_id` = `modulos`.`id`
    )
ORDER BY
    `enlace_modulos`.`id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
