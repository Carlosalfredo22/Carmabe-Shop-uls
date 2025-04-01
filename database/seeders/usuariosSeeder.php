<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usuariosSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Admin',
                'email' => 'admin@example.com',
                'contraseña' => Hash::make('admin123'),
                'direccion' => 'Calle 123',
                'telefono' => '123456789',
                'rol_id' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Cliente',
                'email' => 'cliente@example.com',
                'contraseña' => Hash::make('cliente123'),
                'direccion' => 'Avenida 456',
                'telefono' => '987654321',
                'rol_id' => 2,
                'created_at' => now(),
            ],
        ]);
    }
}
