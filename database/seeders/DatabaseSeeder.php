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
        if (! User::where('email', env('ADMIN_EMAIL', 'admin@ladiespg.com'))->exists()) {
            $password = env('ADMIN_PASSWORD');
            if (! $password || strlen($password) < 12) {
                throw new \RuntimeException('Set ADMIN_PASSWORD to at least 12 characters before seeding.');
            }
            $user = new User;
            $user->forceFill(['name' => env('ADMIN_NAME', 'Admin'), 'email' => env('ADMIN_EMAIL', 'admin@ladiespg.com'), 'password' => $password, 'is_admin' => true])->save();
        }
    }
}
