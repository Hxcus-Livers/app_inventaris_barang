<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('kategori_assets')->insert([
            ['kode_kategori_asset' => 'IT', 'kategori_asset' => 'Peralatan IT'],
            ['kode_kategori_asset' => 'GD', 'kategori_asset' => 'Gedung & Bangunan'],
            ['kode_kategori_asset' => 'MP', 'kategori_asset' => 'Mesin & Peralatan'],
        ]);
    }
}
