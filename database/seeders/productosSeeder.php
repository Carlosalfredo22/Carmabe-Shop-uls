<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productosSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Smartphone',
                'descripcion' => 'Teléfono inteligente',
                'precio' => 299.99,
                'stock' => 10,
                'categoria_id' => 1,
                'imagen_url' => 'smartphone.jpg',
                'created_at' => now(),
            ],
            [
                'nombre' => 'Camiseta',
                'descripcion' => 'Camiseta de algodón',
                'precio' => 19.99,
                'stock' => 50,
                'categoria_id' => 2,
                'imagen_url' => 'camiseta.jpg',
                'created_at' => now(),
            ],
        ]);
    }
}
