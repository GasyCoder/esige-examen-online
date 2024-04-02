<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSujetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_sujets')->insert([
            [
                'type' => 'qcm',
                'label' => 'QCM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'textarea',
                'label' => 'Texte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'file',
                'label' => 'Fichier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
