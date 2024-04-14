<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('calendars')->insert([
            [
                'dateStart' => now(),
                'dateEnd' => now(),
                'note'    => 'note 1'
            ],

            [
                'dateStart' => now(),
                'dateEnd' => now(),
                'note'    => 'note 2'
            ]
        ]);
    }
}