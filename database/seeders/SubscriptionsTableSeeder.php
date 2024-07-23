<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            'users_id' => '1',
            'eventos_id' => '1',
            'checkin' => true,
            'active' => true,
        ]);

        DB::table('subscriptions')->insert([
            'users_id' => '2',
            'eventos_id' => '1',
            'checkin' => false,
            'active' => true,
        ]);
    }
}
