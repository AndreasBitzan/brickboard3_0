<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Pktharindu\NovaPermissions\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'slug' => 'superadmin',
                'name' => 'Superadmin',
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 2,
                'slug' => 'admin',
                'name' => 'Admin',
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 3,
                'slug' => 'moderator',
                'name' => 'Moderator',
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 4,
                'slug' => 'editor',
                'name' => 'Editor',
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 5,
                'slug' => 'regular',
                'name' => 'Brickboarder',
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
        ];

        Role::insert($roles);
    }
}
