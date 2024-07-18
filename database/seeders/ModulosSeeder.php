<?php

namespace Database\Seeders;

use App\Models\EnlaceModulo;
use App\Models\Modulos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $modulo = Modulos::create([
            'nombre' => 'MODULOS',
            'permiso' => 'MODULOS'
        ]);
        EnlaceModulo::create([
            'titulo' => 'Ver modulos',
            'enlace' => 'modulos.index',
            'modulo_id' => $modulo->id
        ]);

        $modulo = Modulos::create([
            'nombre' => 'USUARIOS',
            'permiso' => 'USUARIOS'
        ]);
        EnlaceModulo::create([
            'titulo' => 'Ver usuarios',
            'enlace' => 'usuarios.index',
            'modulo_id' => $modulo->id
        ]);


        $modulo = Modulos::create([
            'nombre' => 'PERMISOS',
            'permiso' => 'PERMISOS'
        ]);
        EnlaceModulo::create([
            'titulo' => 'Ver permisos',
            'enlace' => 'permisos.index',
            'modulo_id' => $modulo->id
        ]);

        $modulo = Modulos::create([
            'nombre' => 'ROLES',
            'permiso' => 'ROLES'
        ]);
        EnlaceModulo::create([
            'titulo' => 'Ver roles',
            'enlace' => 'roles.index',
            'modulo_id' => $modulo->id
        ]);
    }
}
