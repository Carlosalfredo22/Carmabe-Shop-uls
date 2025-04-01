<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permisosSeeder extends Seeder
{
    public function run()
    {
        DB::table('permisos')->insert([
            ['nombre' => 'gestionar_usuarios', 'descripcion' => 'Permiso para gestionar usuarios'],
            ['nombre' => 'gestionar_productos', 'descripcion' => 'Permiso para gestionar productos'],
            ['nombre' => 'gestionar_pedidos', 'descripcion' => 'Permiso para gestionar pedidos'],
        ]);
    }
}
