<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@bajupolos.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'admin',
        // ]);

        // User::create([
        //     'name' => 'User',
        //     'email' => 'user@bajupolos.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'user',
        // ]);
        User::create([
            'name' => 'salman',
            'email' => 'a@a.com',
            'password' => Hash::make('y'),
            'role' => 'user',
        ]);
    }
}