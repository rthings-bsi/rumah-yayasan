<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Finance user
        User::create([
            'name' => 'Finance Yayasan',
            'email' => 'finance@rumahharapan.com',
            'password' => bcrypt('password'),
            'role' => 'finance',
        ]);

        // Create Director user
        User::create([
            'name' => 'Direktur Yayasan',
            'email' => 'direktur@rumahharapan.com',
            'password' => bcrypt('password'),
            'role' => 'director',
        ]);

        // Create Asrama Admin user (example)
        User::create([
            'name' => 'Admin Asrama',
            'email' => 'asrama@rumahharapan.com',
            'password' => bcrypt('password'),
            'role' => 'asrama_admin',
        ]);
    }
}
