<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin/dev account
        $admin = User::updateOrCreate(
            ['email' => 'charles.gauthier99@gmail.com'],
            [
                'firstname' => 'Charles',
                'lastname'  => 'Gauthier',
                'password'  => Hash::make('Bordeaux2025@'),
                'phone'     => null,
                'is_b2b'    => false,
                'company_name' => null,
                'address' => '34 Rue du Vélodrome',
                'city'    => 'Bordeaux',
                'zip'     => '33200',
                'email_verified_at' => now(),
            ]
        );

        // Attach admin role (idempotent)
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        // Random users (no roles)
        User::factory()->count(10)->create();
    }
}
