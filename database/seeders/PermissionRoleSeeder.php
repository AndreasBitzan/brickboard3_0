<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Pktharindu\NovaPermissions\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::find(1);
        $superAdmin->setPermissions(collect(config('nova-permissions.permissions'))->keys()->toArray());
    }
}
