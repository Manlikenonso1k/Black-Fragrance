<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignRole extends Command
{
    protected $signature = 'user:role {email} {role}';
    protected $description = 'Assign a role to a user. Roles: super_admin, staff';

    public function handle(): int
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        if (! in_array($role, [User::ROLE_SUPER_ADMIN, User::ROLE_STAFF])) {
            $this->error("Invalid role. Use: super_admin or staff");
            return 1;
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("User with email [{$email}] not found.");
            return 1;
        }

        $user->update(['role' => $role, 'is_admin' => true]);

        $this->info("✅ {$user->name} ({$email}) is now: {$role}");
        return 0;
    }
}
