<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user' => 'U001',
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'username' => 'budi',
            'password' => 'password123',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1, Jakarta',
        ]);

        User::create([
            'id_user' => 'U002',
            'nama_lengkap' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'username' => 'siti',
            'password' => 'password123',
            'no_hp' => '081298765432',
            'alamat' => 'Jl. Sudirman No. 2, Bandung',
        ]);
    }
}