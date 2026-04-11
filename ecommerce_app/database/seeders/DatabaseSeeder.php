<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barang;
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
        // Buat 5 customer dummy
        User::factory(5)->create(['role' => 'customer']);

        // Buat 20 barang dummy
        Barang::factory(20)->create();

        $this->command->info('✅ Seeder selesai! Admin: admin@example.com | password: password');
    }
}
