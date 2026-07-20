<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'is_admin' => false,
                'role' => User::ROLE_STAFF,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@blackfragrance.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'is_admin' => true,
                'role' => User::ROLE_SUPER_ADMIN,
            ]
        );

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
