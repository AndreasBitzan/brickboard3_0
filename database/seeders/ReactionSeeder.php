<?php

namespace Database\Seeders;

use App\Models\ReactionType;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reactions = [
            [
                'id' => 1,
                'name' => json_encode(['de' => 'Find ich toll!', 'en' => 'I like it!']),
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
        ];

        ReactionType::insert($reactions);
    }
}
