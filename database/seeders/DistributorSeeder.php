<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('distributors')->insert([
            [
                'nama_distributor' => 'PT Maju Jaya',
                'alamat' => 'Jl. Sudirman No.1',
                'no_telp' => '081234567890',
                'email' => 'info@elektronikjaya.com',
                'keterangan' => 'Distributor Resmi',
            ],
            [
                'nama_distributor' => 'CV Berkah Abadi',
                'alamat' => 'Jl. Thamrin No.20',
                'no_telp' => '081987654321',
                'email' => 'support@furnituremart.com',
                'keterangan' => 'Distributor Tunggal',
            ],
        ]);
    }
}
