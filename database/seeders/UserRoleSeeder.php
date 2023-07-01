<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_user = [['role_id' => 1, 'user_id' => 1]];
        DB::table('role_user')->insert($role_user);
    }
}
