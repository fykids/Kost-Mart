<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin/seller users
        User::create([
            'name' => 'Toko Makanan',
            'email' => 'toko_makanan@example.com',
            'password' => bcrypt('password'),
            'phone' => '081234567890',
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Toko Elektronik',
            'email' => 'toko_elektronik@example.com',
            'password' => bcrypt('password'),
            'phone' => '082234567890',
            'role' => 'seller',
        ]);

        // Create customer users
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
            'phone' => '083234567890',
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Siti Nur',
            'email' => 'siti@example.com',
            'password' => bcrypt('password'),
            'phone' => '084234567890',
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Ahmad Ridho',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password'),
            'phone' => '085234567890',
            'role' => 'customer',
        ]);
    }
}
