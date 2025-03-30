<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        $role = Role::where('name', 'admin')->first();
        
        if (!$role) {
            $role = Role::create([
                'name' => 'admin',
            ]);
        }

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'username' => 'admin',
            'role_id' => $role->id
        ]);
    }
}