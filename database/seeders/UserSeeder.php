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
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // user petugas
        User::create([
            'name' => 'Petugas Lab',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'petugas'
        ]);

        // user peminjam
        User::create([
            'name' => 'John Doe',
            'email' => 'peminjam@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'peminjam'
        ]);
    }
}
