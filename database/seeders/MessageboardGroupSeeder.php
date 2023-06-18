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
                'name' => json_encode(['de' => 'Ankündigungen', 'en' => 'Announcements']),
                'position' => 1,
                'active' => true,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 2,
                'name' => json_encode(['de' => 'Das Board', 'en' => 'The forums']),
                'position' => 2,
                'active' => true,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
        ];

        MessageboardGroup::insert($groups);
    }
}
