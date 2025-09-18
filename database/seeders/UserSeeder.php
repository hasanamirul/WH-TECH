<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ubah email + password sesuai kebutuhan
        User::updateOrCreate(
            ['email' => 'admin@whtech.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('000'),
                'role' => 'superadmin'
            ]
        );
    }
}
