<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@toko.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Membuat Akun Customer
        User::create([
            'name' => 'Budi Customer',
            'email' => 'budi@toko.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}