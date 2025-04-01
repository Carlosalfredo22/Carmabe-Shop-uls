<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            rolesSeeder::class,
            permisosSeeder::class,
            rolesPermisosSeeder::class,
            usuariosSeeder::class,
            categoriasSeeder::class,
            productosSeeder::class,
            pedidosSeeder::class,
            detallespedidoSeeder::class,
            metodospagoSeeder::class,
            pagosSeeder::class,
        ]);
    }
}
