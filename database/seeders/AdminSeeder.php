<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rbac.com'],
            [
                'name'           => 'Super Admin',
                'email'          => 'admin@rbac.com',
                'password'       => Hash::make('Admin@12345'),
                'role'           => 'admin',
                'user_uid'       => 'ADM-000001',
                'is_first_login' => false,
            ]
        );
    }
}
