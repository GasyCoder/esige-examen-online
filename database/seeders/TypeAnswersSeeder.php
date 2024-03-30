<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeAnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_answers')->insert([
            [
                'type' => 'radio',
                'label' => 'Radio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'checkbox',
                'label' => 'Checkbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'textarea',
                'label' => 'Textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'file',
                'label' => 'File',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
