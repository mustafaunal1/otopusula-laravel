<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AraclarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('araclar')->insert([
            [
                'marka' => 'Toyota',
                'model' => 'Corolla 1.6 (E100)',
                'yil' => 1998,
                'yakit_turu' => 'Benzin/LPG',
                'motor_gucu' => '114 HP',
                'bakim_maliyeti' => 2500.00,
                'resim_url' => 'https://via.placeholder.com/300x200?text=Toyota+Corolla'
            ],
            [
                'marka' => 'Opel',
                'model' => 'Astra F 1.6 GLS',
                'yil' => 1997,
                'yakit_turu' => 'Benzin/LPG',
                'motor_gucu' => '100 HP',
                'bakim_maliyeti' => 3000.00,
                'resim_url' => 'https://via.placeholder.com/300x200?text=Opel+Astra+F'
            ]
        ]);
    }
}