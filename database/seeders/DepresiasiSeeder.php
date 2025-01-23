<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepresiasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('depresiasis')->insert([
            ['lama_depresiasi' => 60, 'keterangan' => 'Depresiasi standar 5 tahun'],
        ]);
    }
}
