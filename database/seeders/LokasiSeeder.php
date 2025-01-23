<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('lokasis')->insert([
            ['kode_lokasi' => 'LOC01', 'nama_lokasi' => 'Kantor Utama', 'keterangan' => 'Kantor pusat'],
            ['kode_lokasi' => 'LOC10', 'nama_lokasi' => 'Gudang Utama', 'keterangan' => 'Gudang pusat'],
            ['kode_lokasi' => 'LOC100', 'nama_lokasi' => 'Kantor Cabang', 'keterangan' => 'Gudang cabang'],
        ]);
    }
}
