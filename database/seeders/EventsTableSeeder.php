<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'name' => 'Batalha da aldeia',
            'description' => 'Evento de rima',
            'date_initial' => '2024-04-30 13:00:00',
            'date_final' => '2024-04-30 15:00:00',
        ]);

        DB::table('events')->insert([
            'name' => 'Festa de 15',
            'description' => 'Evento em prol da comemoração de aniversário',
            'date_initial' => '2024-05-06 22:30:00',
            'date_final' => '2024-05-07 05:00:00',
        ]);

        DB::table('events')->insert([
            'name' => 'Curso de Laravel',
            'description' => 'Curso de Laravel para novatos',
            'date_initial' => '2024-05-10 14:00:00',
            'date_final' => '2024-05-10 18:00:00',
        ]);
    }
}
