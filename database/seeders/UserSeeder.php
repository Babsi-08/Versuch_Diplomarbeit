<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's users.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Ba', 'email' => 'ba.test@aon.at', 'password' => 'testba'],
            ['name' => 'Be', 'email' => 'be.test@aon.at', 'password' => 'testbe'],
            ['name' => 'J', 'email' => 'j.test@aon.at', 'password' => 'testj'],
        ];

        foreach ($users as $user) {
            $model = User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'email_verified_at' => now(),
                ],
            );

            $model->assignRole('Admin');
        }
    }
}
