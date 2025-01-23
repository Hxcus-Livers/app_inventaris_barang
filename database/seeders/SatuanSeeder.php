<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('satuans')->insert([
            ['satuan' => 'Unit'],
            ['satuan' => 'Parts'],
            ['satuan' => 'Meters'],
            ['satuan' => 'Kilogram'],
        ]);
    }
}
