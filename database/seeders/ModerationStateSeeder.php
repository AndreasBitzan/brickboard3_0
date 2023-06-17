<?php

namespace Database\Seeders;

use App\Models\ModerationState;
use Illuminate\Database\Seeder;

class ModerationStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moderationStates = [
            [
                'id' => 1,
                'name' => 'approved',
            ],
            [
                'id' => 2,
                'name' => 'pending_moderation',
            ],
            [
                'id' => 2,
                'name' => 'blocked',
            ],
        ];

        foreach ($moderationStates as $state) {
            ModerationState::updateOrCreate($state);
        }
    }
}
