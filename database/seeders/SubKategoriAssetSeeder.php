<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKategoriAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('sub_kategori_assets')->insert([
            ['id_kategori_asset' => 1, 'kode_sub_kategori_asset' => 'PC01', 'sub_kategori_asset' => 'Personal Computer'],
            ['id_kategori_asset' => 1, 'kode_sub_kategori_asset' => 'PC02', 'sub_kategori_asset' => 'Laptop'],
            ['id_kategori_asset' => 1, 'kode_sub_kategori_asset' => 'PC03', 'sub_kategori_asset' => 'Server'],
            ['id_kategori_asset' => 2, 'kode_sub_kategori_asset' => 'GD01', 'sub_kategori_asset' => 'AC'],
        ]);
    }
}
