<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'MODULOS#ver']);
        Permission::create(['name' => 'USUARIOS#ver']);
        Permission::create(['name' => 'ROLES#ver']);
        Permission::create(['name' => 'PERMISOS#ver']);
        Permission::create(['name' => 'PROYECTOS#ver']);
        Permission::create(['name' => 'EVALUADOR#ver']);
        Permission::create(['name' => 'ESTADISTICAS#ver']);
        Permission::create(['name' => 'CICLOS#ver']);

        $role = Role::create(['name' => 'investigador']);
        $role->givePermissionTo('PROYECTOS#ver');

        $role = Role::create(['name' => 'evaluador']);
        $role->givePermissionTo('EVALUADOR#ver');



        $role = Role::create(['name' => 'investigador-evaluador']);
        $role->givePermissionTo(['PROYECTOS#ver','EVALUADOR#ver']);


        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole('admin');
    }
}
