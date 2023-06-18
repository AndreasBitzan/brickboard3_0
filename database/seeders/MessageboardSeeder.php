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
                'name' => json_encode(['de' => 'Neuigkeiten', 'en' => 'News']),
                'slug' => json_encode(['de' => 'neuigkeiten', 'en' => 'news']),
                'description' => json_encode(['de' => 'Neuigkeiten und Ankündigungen rund um brickboard.de', 'en' => 'News and announcements around the brickfilming world.']),
                'messageboard_group_id' => 1,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 2,
                'name' => json_encode(['de' => 'Steinerei und Wettbewerbe', 'en' => 'Steinerei and other contests']),
                'slug' => json_encode(['de' => 'steinerei-und-wettbewerbe', 'en' => 'steinerei-and-contests']),
                'description' => json_encode(['de' => 'Informationen und Diskussionen rund um die Steinerei - für andere Wettbewerbe ist natürlich auch Platz.', 'en' => 'Information and topics around the Steinerei, but also other contests']),
                'messageboard_group_id' => 1,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 3,
                'name' => json_encode(['de' => 'Brickfilme im Allgemeinen', 'en' => 'Brickfilms in general']),
                'slug' => json_encode(['de' => 'brickfilme-im-allgemeinen', 'en' => 'brickfilms-in-general']),
                'description' => json_encode(['de' => 'Alles rund ums Brickfilmen, die Werkzeuge und Techniken, bahnbrechende Einfälle und sogar Projektvorstellungen finden hier ihren Platz.', 'en' => 'Everything that happens in the brickfilming world, tools, techniques and project presentations.']),
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 4,
                'name' => json_encode(['de' => 'Filmvorstellungen', 'en' => 'Movie presentations']),
                'slug' => json_encode(['de' => 'filmvorstellungen', 'en' => 'movie-presentations']),
                'description' => json_encode(['de' => 'Hier könnt ihr eure fertigen Brickfilme vorstellen oder eine konstruktive Kritik zu anderen Filmen beitragen.', 'en' => 'This is the place to present your brickfilms and give feedback to other clips.']),
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 5,
                'name' => json_encode(['de' => 'Gemeinschaftsprojekte', 'en' => 'Group projects']),
                'slug' => json_encode(['de' => 'gemeinschaftsprojekte', 'en' => 'group-projects']),
                'description' => json_encode(['de' => 'Mach mit und beteilige dich an den Gemeinschaftsprojekten auf brickboard.de!', 'en' => 'Join us and participate in a brickboard.de group project!']),
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
            [
                'id' => 6,
                'name' => json_encode(['de' => 'Sonstiges', 'en' => 'Other stuff']),
                'slug' => json_encode(['de' => 'sonstiges', 'en' => 'other']),
                'description' => json_encode(['de' => 'Sonstige Themen, Fragen und Feedback!', 'en' => 'Other Topics, questions and feedback!']),
                'messageboard_group_id' => 2,
                'created_at' => now('Europe/Vienna'),
                'updated_at' => now('Europe/Vienna'),
            ],
        ];
        Messageboard::insert($messageboards);
    }
}
