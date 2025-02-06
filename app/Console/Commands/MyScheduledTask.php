<?php

namespace App\Console\Commands;

use App\Models\HitungDepresiasi;
use App\Models\Pengadaan;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class MyScheduledTask extends Command
{
    protected $signature = 'depreciation:increment-month';
    protected $description = 'Increment the month value for all depreciation calculations';

    public function handle()
    {
        $depreciations = HitungDepresiasi::all();
        $today = Carbon::now();

        foreach ($depreciations as $depreciation) {
            $calculationDate = Carbon::parse($depreciation->tgl_hitung_depresiasi);
            
            // Calculate months difference and round to nearest integer
            $monthsDiff = (int)round($calculationDate->diffInMonths($today));
            
            if ($monthsDiff > 0 && $depreciation->bulan < $depreciation->durasi) {
                $pengadaan = Pengadaan::find($depreciation->id_pengadaan);
                $initialValue = $pengadaan->harga_barang;

                // Calculate new month value (don't exceed duration)
                $newMonth = min($depreciation->bulan + $monthsDiff, $depreciation->durasi);

                // Calculate new depreciated value
                $monthlyDepreciation = $initialValue / $depreciation->durasi;
                $remainingValue = round($initialValue - ($monthlyDepreciation * $newMonth));
                $remainingValue = max(0, $remainingValue);

                // Update fb status based on remaining value
                $fbStatus = $remainingValue < 10000 ? '0' : '1';

                // Update depreciation record
                $depreciation->update([
                    'bulan' => $newMonth,
                    'nilai_barang' => $remainingValue,
                    'tgl_hitung_depresiasi' => $today->format('Y-m-d'),
                    'last_edited_at' => now(),
                    'last_edited_by' => 1
                ]);

                // Update procurement status
                $pengadaan->update([
                    'depresiasi_barang' => round($monthlyDepreciation),
                    'fb' => $fbStatus
                ]);

                $this->info("Updated depreciation ID {$depreciation->id_hitung_depresiasi} - Month: {$newMonth}");
            }
        }

        $this->info('Depreciation check completed.');
    }
}