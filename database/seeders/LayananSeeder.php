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
            'nama' => 'Wash',
            'durasi' => 24,
            'harga' => 35000
        ]);

        Layanan::create([
            'nama' => 'Deep Clean',
            'durasi' => 24,
            'harga' => 40000
        ]);

        Layanan::create([
            'nama' => 'Repair',
            'durasi' => 24,
            'harga' => 50000
        ]);

        Layanan::create([
            'nama' => 'Repaint',
            'durasi' => 24,
            'harga' => 60000
        ]);
    }
}
