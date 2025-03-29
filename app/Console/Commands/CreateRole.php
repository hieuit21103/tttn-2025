<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;

class CreateRole extends Command
{
    protected $signature = 'role:create';

    protected $description = 'Create default admin and user roles';

    public function handle()
    {
        // Create admin role
        Role::create(['name' => 'admin']);
        $this->info("Role 'admin' has been created successfully!");

        // Create user role
        Role::create(['name' => 'user']);
        $this->info("Role 'user' has been created successfully!");

        $this->info("Default roles have been created!");
    }
}