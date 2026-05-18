<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate(
            ['login' => 'admin'],
            [
                'name' => 'Администратор',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'administrator',
                'is_blocked' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}
