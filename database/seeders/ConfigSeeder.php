<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ConfigSeeder extends Seeder
{
    public function run(): void
    {
        // Roles y permisos específicos
        $roles = [
            'admin' => ['crear'],
            'cliente' => ['ver', 'editar_datos']
        ];

        // Crear roles y permisos, y asignar permisos a cada rol
        foreach ($roles as $roleName => $permisos) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            foreach ($permisos as $permisoNombre) {
                $permiso = Permission::firstOrCreate(['name' => $permisoNombre]);
                if (!$role->hasPermissionTo($permiso)) {
                    $role->givePermissionTo($permiso);
                }
            }
        }

        // Crear usuario Carlos con rol admin
        $carlos = User::firstOrCreate(
            ['email' => 'carlosalfredo123@gmail.com'],
            [
                'name' => 'carlos',
                'password' => Hash::make('password1234'),
            ]
        );
        $carlos->assignRole('admin');

        // Crear usuario Mario con rol admin
        $mario = User::firstOrCreate(
            ['email' => 'mario@example.com'],
            [
                'name' => 'mario',
                'password' => Hash::make('password1234'),
            ]
        );
        $mario->assignRole('admin');

        // Crear usuario Cliente con rol cliente
        $cliente = User::firstOrCreate(
            ['email' => 'cliente@example.com'],
            [
                'name' => 'cliente',
                'password' => Hash::make('password1234'),
            ]
        );
        $cliente->assignRole('cliente');
    }
}
