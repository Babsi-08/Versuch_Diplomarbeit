<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's roles.
     */
    public function run(): void
    {
        foreach (['Admin', 'Client'] as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
