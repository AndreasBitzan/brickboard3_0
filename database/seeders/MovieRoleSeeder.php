<?php

namespace Database\Seeders;

use App\Models\MovieRole;
use Illuminate\Database\Seeder;

class MovieRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movieRoles = [
            [
                'id' => 1,
                'name' => json_encode(['de' => 'Ersteller', 'en' => 'Creator']),
            ],
            [
                'id' => 2,
                'name' => json_encode(['de' => 'Animation', 'en' => 'Animation']),
            ],
            [
                'id' => 3,
                'name' => json_encode(['de' => 'Musik', 'en' => 'Music']),
            ],
            [
                'id' => 4,
                'name' => json_encode(['de' => 'Post-Production', 'en' => 'Post-Production']),
            ],
        ];

        MovieRole::insert($movieRoles);
    }
}
