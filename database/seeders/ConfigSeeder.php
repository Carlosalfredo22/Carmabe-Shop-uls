<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\password;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(["password" => Hash::make('password1234'),
        "name" => "carlos", "email" => "carlosalfredo123@gmail.com" ]);
    
        $role = Role::create([
            "name" => 'admin'
        ]);

        $permiso = Permission::create([
            "name" => 'crear'
        ]);

        $role->givePermissionTo($permiso);

        $user->assignRole($role->name);
        
    }
}
