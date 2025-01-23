<?php

namespace App\Services;

use App\Models\Pengadaan;
use Carbon\Carbon;

class DepreciationService
{
    const MINIMUM_VALUE_THRESHOLD = 10000;

    public function updateAllDepreciations()
    {
        $items = Pengadaan::with('depresiasi')->get();
        
        foreach ($items as $item) {
            $this->updateItemDepreciation($item);
        }
    }

    public function updateItemDepreciation(Pengadaan $item)
    {
        if (!$item->depresiasi || !$item->tgl_pengadaan) {
            return;
        }

        // Get initial price and depreciation period
        $initial_price = $item->harga_barang;
        $depreciation_years = $item->depresiasi->lama_depresiasi;
        $total_months = $depreciation_years * 12;
        
        // Calculate monthly depreciation rate
        $monthly_rate = $initial_price / $total_months;
        
        // Calculate months passed since procurement
        $procurement_date = Carbon::parse($item->tgl_pengadaan);
        $months_passed = $procurement_date->diffInMonths(Carbon::now());
        
        // Calculate current value
        $total_depreciation = $monthly_rate * $months_passed;
        $current_value = max(0, $initial_price - $total_depreciation);
        
        // Update item
        $updateData = [
            'nilai_barang' => $current_value,
            'depresiasi_barang' => $monthly_rate
        ];

        // Check if value is at or below threshold
        if ($current_value <= self::MINIMUM_VALUE_THRESHOLD) {
            $updateData['fb'] = '0'; // Set as not worth using
            $updateData['keterangan'] = $item->keterangan . "\nBarang tidak layak pakai per " . Carbon::now()->format('d-m-Y') . " (Nilai dibawah Rp. " . number_format(self::MINIMUM_VALUE_THRESHOLD, 0, ',', '.') . ")";
        }

        // Update item
        $item->update($updateData);
    }
    public function checkItemStatus(Pengadaan $item)
    {
        if ($item->nilai_barang <= self::MINIMUM_VALUE_THRESHOLD && $item->fb != '0') {
            $item->update([
                'fb' => '0',
                'keterangan' => $item->keterangan . "\nBarang tidak layak pakai per " . Carbon::now()->format('d-m-Y') . " (Nilai dibawah Rp. " . number_format(self::MINIMUM_VALUE_THRESHOLD, 0, ',', '.') . ")"
            ]);
            return true;
        }
        return false;
    }

}