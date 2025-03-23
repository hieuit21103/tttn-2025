<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteUser extends Command
{
    protected $signature = 'user:delete {username}';
    protected $description = 'Delete a user by username';

    public function handle()
    {
        $username = $this->argument('username');

        $user = User::where('username', $username)->first();

        if (!$user) {
            $this->error("User with username '{$username}' not found.");
            return 1;
        }

        $user->delete();

        $this->info("User '{$username}' has been deleted successfully.");
        return 0;
    }
}
