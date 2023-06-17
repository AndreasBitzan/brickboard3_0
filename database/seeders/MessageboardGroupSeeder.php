<?php

namespace Database\Seeders;

use App\Models\MessageboardGroup;
use Illuminate\Database\Seeder;

class MessageboardGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'id' => 1,
                'name' => 'Ankündigungen',
                'position' => 1,
                'active' => true,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 2,
                'name' => 'Das Board',
                'position' => 2,
                'active' => true,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
        ];

        MessageboardGroup::insert($groups);
    }
}
