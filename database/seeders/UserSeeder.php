<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@jomp.com',
            'email_verified_at' => now(),
            'password'  => bcrypt('password123'),
        ]);
    }
}
