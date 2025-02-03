<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengadaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengadaans')->insert([
            [
                'id_master_barang' => 1,
                'id_depresiasi' => 1,
                'id_merk' => 1,
                'id_satuan' => 1,
                'id_sub_kategori_asset' => 1,
                'id_distributor' => 1,
                'kode_pengadaan' => 'PO2024001',
                'no_invoice' => 'INV001',
                'no_seri_barang' => 'SN001',
                'tahun_produksi' => '2023',
                'tgl_pengadaan' => '2025-01-01',
                'jumlah_barang' => 1,
                'harga_barang' => 1000000,
                'depresiasi_barang' => 0,
                'nilai_barang' => 0,
                'fb' => '1',
                'keterangan' => 'Pembelian Langsung',
            ],
        ]);
    }
}
