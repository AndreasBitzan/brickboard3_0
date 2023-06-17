<?php

namespace Database\Seeders;

use App\Models\TopicTypes;
use Illuminate\Database\Seeder;

class TopicTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topic_types = [[
            'id' => 1,
            'name' => 'normal',
        ], [
            'id' => 2,
            'name' => 'video',
        ]];

        TopicTypes::insert($topic_types);
    }
}
