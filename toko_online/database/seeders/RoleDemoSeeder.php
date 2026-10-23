<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin (Trusted)
        User::create([
            'id_user' => 'U004', 
            'nama_lengkap' => 'Administrator',
            'email' => 'admin@example.com',       
            'username' => 'admin',
            'password' => 'password123', 
            'no_hp' => '081111111111',            
            'alamat' => 'Kantor Pusat',           
            'role' => 'admin',
        ]);

        // 2. Staff
        User::create([
            'id_user' => 'U005',
            'nama_lengkap' => 'Staff Toko',
            'email' => 'staff@example.com',      
            'username' => 'staff',
            'password' => 'password123',
            'no_hp' => '082222222222',            
            'alamat' => 'Gudang Toko',           
            'role' => 'staff',
        ]);

        // 3. Customer
        User::create([
            'id_user' => 'U006',
            'nama_lengkap' => 'Pelanggan Setia',
            'email' => 'customer@example.com',    
            'username' => 'customer',
            'password' => 'password123',
            'no_hp' => '083333333333',            
            'alamat' => 'Jl. Pelanggan No. 1',   
            'role' => 'customer',
        ]);
    }
}