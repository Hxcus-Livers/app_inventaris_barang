<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HitungDepresiasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hitung_depresiasis')->insert([
            ['id_pengadaan' => 1, 'tgl_hitung_depresiasi' => '2025-01-01', 'bulan' => 'Januari', 'durasi' => 60, 'nilai_barang' => 10000000],
        ]);
    }
}
