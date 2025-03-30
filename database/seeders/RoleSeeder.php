<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'admin' => 'Quản trị viên',
            'user' => 'Người dùng'
        ];

        foreach ($roles as $key => $value) {
            Role::create(['name' => $key, 'display_name' => $value]);
        }
    }
}