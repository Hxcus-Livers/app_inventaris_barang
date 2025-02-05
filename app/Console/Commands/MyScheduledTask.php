<?php

namespace App\Console\Commands;

use App\Models\HitungDepresiasi;
use App\Models\Pengadaan;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon; 

class MyScheduledTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'depreciation:increment-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment the month value for all depreciation calculations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all depreciation records
        $depreciations = HitungDepresiasi::all();
        $today = Carbon::now();

        foreach ($depreciations as $depreciation) {
            // Parse the calculation date
            $calculationDate = Carbon::parse($depreciation->tgl_hitung_depresiasi);
            
            // Check if today is the monthly anniversary of the calculation date
            if ($today->day == $calculationDate->day && 
                $today->month != $calculationDate->month) {
                
                // Only increment if current month is less than duration
                if ($depreciation->bulan < $depreciation->durasi) {
                    // Get initial value from procurement
                    $pengadaan = Pengadaan::find($depreciation->id_pengadaan);
                    $initialValue = $pengadaan->harga_barang;

                    // Calculate new month value
                    $newMonth = $depreciation->bulan + 1;

                    // Calculate new depreciated value
                    $monthlyDepreciation = $initialValue / $depreciation->durasi;
                    $remainingValue = $initialValue - ($monthlyDepreciation * $newMonth);
                    $remainingValue = max(0, $remainingValue);

                    // Update fb status based on remaining value
                    $fbStatus = $remainingValue < 10000 ? '0' : '1';

                    // Update depreciation record
                    $depreciation->update([
                        'bulan' => $newMonth,
                        'nilai_barang' => $remainingValue,
                        'tgl_hitung_depresiasi' => $today->format('Y-m-d'), // Update calculation date
                        'last_edited_at' => now(),
                        'last_edited_by' => 1 // Assuming system user ID is 1
                    ]);

                    // Update procurement status
                    $pengadaan->update([
                        'depresiasi_barang' => $monthlyDepreciation,
                        'fb' => $fbStatus
                    ]);

                    $this->info("Updated depreciation ID {$depreciation->id_hitung_depresiasi} - Month: {$newMonth}");
                }
            }
        }

        $this->info('Depreciation check completed.');
    }
}
