<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('master_barangs')->insert([
            [
                'kode_barang' => 'IT-PC02-001',
                'nama_barang' => 'Laptop Dell XPS 15',
                'spesifikasi_teknis' => 'Intel Core i7, 16GB RAM, 512GB SSD',
            ],
            [
                'kode_barang' => 'IT-PC02-002',
                'nama_barang' => 'Laptop Lenovo Thinkpad X1 Carbon Generasi 10',
                'spesifikasi_teknis' => 'Processor Intel Core i7-12700H, RAM 16GB DDR5, SSD 512GB NVMe',
            ],
            [
                'kode_barang' => 'GD-P001-001',
                'nama_barang' => 'AC Daikin 1 PK Inverter',
                'spesifikasi_teknis' => 'Daya 800 Watt, Freon R32, BTU 9000',
            ],
        ]);
    }
}
