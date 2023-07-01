<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =
                [
                    [
                        'name' => 'A&M Studios',
                        'email' => 'andreas.bitzan@gmail.com',
                        'password' => bcrypt('P@ssw0rd'),
                        'slug' => 'a-u-m-studios',
                    ],
                    [
                        'name' => 'Testuser',
                        'slug' => 'testuser',
                        'email' => 'test@gmail.com',
                        'password' => bcrypt('P@ssw0rd'),
                    ],
                ];

        User::insert($users);
    }
}
