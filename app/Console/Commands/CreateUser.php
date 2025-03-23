<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:create {name} {username} {password} {email?} {role_id?}';
    protected $description = 'Create a new user';

    public function handle()
    {
        User::create([
            'name' => $this->argument('name'),
            'username' => $this->argument('username'),
            'password' => Hash::make($this->argument('password')),
            'email' => $this->argument('email') ?? null,
            'role_id' => $this->argument('role_id') ?? "1",
        ]);

        $this->info('User created successfully.');
    }
}

