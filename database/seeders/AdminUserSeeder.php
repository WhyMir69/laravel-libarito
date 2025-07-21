<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@libretto.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@libretto.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]);
        }

        if (!User::where('email', 'user@libretto.com')->exists()) {
            User::create([
                'name' => 'Regular User',
                'email' => 'user@libretto.com',
                'password' => Hash::make('user123'),
                'is_admin' => false,
            ]);
        }
    }
}