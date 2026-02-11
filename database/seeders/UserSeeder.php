<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // user admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        // user petugas
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'petugas'
        ]);

        // user peminjam
        User::create([
            'name' => 'Peminjam',
            'email' => 'peminjam@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'peminjam'
        ]);
    }
}
