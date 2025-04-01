<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolesPermisosSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles_permisos')->insert([
            ['rol_id' => 1, 'permiso_id' => 1],
            ['rol_id' => 1, 'permiso_id' => 2],
            ['rol_id' => 1, 'permiso_id' => 3],
        ]);
    }
}
