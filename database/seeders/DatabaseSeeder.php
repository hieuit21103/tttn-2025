<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ClassSeeder::class,
            RoleSeeder::class,
            DefaultUserSeeder::class
        ]);
    }
}