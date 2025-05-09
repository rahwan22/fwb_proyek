<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa A',
                'password' => Hash::make('password123'), 
                'role' => 'siswas',
            ]
        );

        User::firstOrCreate(
            ['email' => 'guru@example.com'],
            [
                'name' => 'Guru A',
                'password' => Hash::make('password123'), 
                'role' => 'guru',
            ]
        );
    }
}
