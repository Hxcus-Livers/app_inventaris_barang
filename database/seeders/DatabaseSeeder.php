<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepresiasiSeeder::class,
            DistributorSeeder::class,
            // KategoriAssetSeeder::class,
            // LokasiSeeder::class,
            // MasterBarangSeeder::class,
            MerkSeeder::class,
            SatuanSeeder::class,
            // SubKategoriAssetSeeder::class,
            // PengadaanSeeder::class,
            // MutasiLokasiSeeder::class,
            // OpnameSeeder::class,
            // HitungDepresiasiSeeder::class,
        ]);
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Account',
            'email' => 'admin@example.com',
            'role' => '0',
            'password' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Accountant',
            'email' => 'accountant@example.com',
            'role' => '1',
            'password' => 'accountant',
        ]);
    }
}
