<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('merks')->insert([
            ['merk' => 'Lenovo', 'keterangan' => 'Brand Internasional'],
            ['merk' => 'Dell', 'keterangan' => 'Brand Internasional'],
            ['merk' => 'Axioo ', 'keterangan' => 'Produk Lokal'],
        ]);
    }
}
