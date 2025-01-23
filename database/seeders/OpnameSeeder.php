<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpnameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('opnames')->insert([
            ['id_pengadaan' => 1, 'tgl_opname' => '2025-01-01', 'kondisi' => 'Baik', 'keterangan' => 'Barang dalam kondisi baik'],
        ]);
    }
}
