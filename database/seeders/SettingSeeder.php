<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name_app'          => 'Mon site',
            'is_disabled'       => true,
            'message_disabled'  => 'Le site est actuellement désactivé.',
            'logo'              => 'logo.jpg',
            'banner'            => 'banner.jpg',
            'year_period'       => '2023-2024',
        ]);
    }
}
