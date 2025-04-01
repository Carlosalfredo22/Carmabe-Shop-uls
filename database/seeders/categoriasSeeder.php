<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriasSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Electrónica', 'descripcion' => 'Productos electrónicos', 'created_at' => now()],
            ['nombre' => 'Ropa', 'descripcion' => 'Prendas de vestir', 'created_at' => now()],
        ]);
    }
}
