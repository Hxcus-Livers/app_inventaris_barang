<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MutasiLokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mutasi_lokasis')->insert([
            ['id_lokasi' => 1, 'id_pengadaan' => 1, 'flag_lokasi' => 'Aktif', 'flag_pindah' => 'Tidak'],
        ]);
    }
}
