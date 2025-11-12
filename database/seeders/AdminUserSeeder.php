<?php

namespace Database\Seeders;

use App\Models\User; // Pastikan menggunakan model User
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'zenzuken56@student.ub.ac.id',
            'password' => Hash::make('Harvey.33'),
            'role' => 'admin',
        ]);
    }
}
