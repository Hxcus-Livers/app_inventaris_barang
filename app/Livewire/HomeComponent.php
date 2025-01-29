<?php

namespace App\Livewire;

use App\Models\HitungDepresiasi;
use App\Models\KategoriAsset;
use App\Models\Pengadaan;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $data['title'] = "Home Inventaris Barang";
        $data['latestDepreciations'] = HitungDepresiasi::with('pengadaan')
            ->latest('tgl_hitung_depresiasi')
            ->take(5)
            ->get();

        // Only select the specific columns we need
        $data['categories'] = KategoriAsset::select(
                'kategori_assets.id_kategori_asset',
                'kategori_assets.kategori_asset',
                'kategori_assets.kode_kategori_asset'
            )
            ->selectRaw('COUNT(pengadaans.id_pengadaan) as asset_count')
            ->leftJoin('sub_kategori_assets', 'kategori_assets.id_kategori_asset', '=', 'sub_kategori_assets.id_kategori_asset')
            ->leftJoin('pengadaans', 'sub_kategori_assets.id_sub_kategori_asset', '=', 'pengadaans.id_sub_kategori_asset')
            ->groupBy(
                'kategori_assets.id_kategori_asset',
                'kategori_assets.kategori_asset',
                'kategori_assets.kode_kategori_asset'
            )
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id_kategori_asset,
                    'name' => $category->kategori_asset,
                    'code' => $category->kode_kategori_asset,
                    'count' => $category->asset_count
                ];
            });
            
        return view('livewire.home-component', $data);
    }
}