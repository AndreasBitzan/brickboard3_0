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
                        'name' => 'Andreas',
                        'email' => 'andreas.bitzan@gmail.com',
                        'password' => bcrypt('P@ssw0rd'),
                    ],
                    [
                        'name' => 'Testuser',
                        'email' => 'test@gmail.com',
                        'password' => bcrypt('P@ssw0rd'),
                    ],
                ];

        User::insert($users);
    }
}
