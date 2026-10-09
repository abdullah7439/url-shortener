<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
       
        User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => 'Pass@123', // hashed automatically by the User model
                'role' => User::ROLE_SUPER_ADMIN,
            ]
        );
    }
}
