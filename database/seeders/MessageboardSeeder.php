<?php

namespace Database\Seeders;

use App\Models\Messageboard;
use Illuminate\Database\Seeder;

class MessageboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messageboards = [
            [
                'id' => 1,
                'name' => 'News',
                'slug' => 'news',
                'description' => 'Neuigkeiten und Ankündigungen rund um brickboard.de',
                'messageboard_group_id' => 1,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 2,
                'name' => 'Steinerei und Wettbewerbe',
                'slug' => 'steinerei-und-wettbewerbe',
                'description' => 'Informationen und Diskussionen rund um die Steinerei - für andere Wettbewerbe ist natürlich auch Platz.',
                'messageboard_group_id' => 1,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 3,
                'name' => 'Brickfilme im Allgemeinen',
                'slug' => 'brickfilme-im-allgemeinen',
                'description' => 'Alles rund ums Brickfilmen, die Werkzeuge und Techniken, bahnbrechende Einfälle und sogar Projektvorstellungen finden hier ihren Platz.',
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 4,
                'name' => 'Filmvorstellungen',
                'slug' => 'filmvorstellungen',
                'description' => 'Hier könnt ihr eure fertigen Brickfilme vorstellen oder eine konstruktive Kritik zu anderen Filmen beitragen.',
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 5,
                'name' => 'Gemeinschaftsprojekte',
                'slug' => 'gemeinschaftsprojekte',
                'description' => 'Mach mit und beteilige dich an den Gemeinschaftsprojekten auf brickboard.de!',
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 6,
                'name' => 'Sonstiges',
                'slug' => 'sonstiges',
                'description' => 'Sonstige Themen, Fragen und Feedback!',
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
        ];
        Messageboard::insert($messageboards);
    }
}
