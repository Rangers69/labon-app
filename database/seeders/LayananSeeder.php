<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Layanan::create([
            'nama' => 'Clean Antar-Jemput',
            'durasi' => 24,
            'harga' => 30000
        ]);

        Layanan::create([
            'nama' => 'Wash Antar-Jemput',
            'durasi' => 24,
            'harga' => 35000
        ]);

        Layanan::create(['nama' => 'Repair Antar-Jemput',
            'durasi' => 24,
            'harga' => 40000
        ]);

        Layanan::create(['nama' => 'Repaint Antar-Jemput',
            'durasi' => 24,
            'harga' => 50000
        ]);

        Layanan::create([
            'nama' => 'Deep Clean Antar-Jemput',
            'durasi' => 24,
            'harga' => 38000
        ]);
    }
}
