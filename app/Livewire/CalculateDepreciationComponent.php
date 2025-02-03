<?php

namespace App\Livewire;

use App\Models\HitungDepresiasi;
use App\Models\Pengadaan;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class CalculateDepreciationComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $id_hitung_depresiasi, $id_pengadaan, $tgl_hitung_depresiasi, $bulan, $durasi, $nilai_barang;
    public $search = '';
    public $detailDepreciationData = [];
    public $selectedItemName = '';

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public function render()
    {
        if ($this->search != "") {
            $data['hitungdepresiasi'] = HitungDepresiasi::whereHas('pengadaan', function ($query) {
                $query->where('kode_pengadaan', 'like', '%' . $this->search . '%');
            })
                ->orWhere('tgl_hitung_depresiasi', 'like', '%' . $this->search . '%')
                ->orWhere('bulan', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data['hitungdepresiasi'] = HitungDepresiasi::orderBy('created_at', 'desc')->paginate(10);
        }
        $data['pengadaan'] = Pengadaan::all();
        return view('livewire.calculate-depreciation-component', $data);
    }
    public function mount()
    {
        $this->tgl_hitung_depresiasi = Carbon::now()->format('Y-m-d');
    }

    protected function calculateDepreciationValue($initialValue, $duration, $currentMonth)
    {
        // Calculate monthly depreciation rate
        $monthlyDepreciation = $initialValue / $duration;

        // Calculate remaining value after depreciation
        $remainingValue = $initialValue - ($monthlyDepreciation * $currentMonth);

        // Ensure the value doesn't go below 0
        return [
            'remainingValue' => max(0, $remainingValue),
            'monthlyDepreciation' => $monthlyDepreciation
        ];
    }
    protected function updateProcurementStatus($pengadaan, $remainingValue, $monthlyDepreciation)
    {
        // Update the fb status based on remaining value
        $fbStatus = $remainingValue < 10000 ? '0' : '1';

        $pengadaan->update([
            'depresiasi_barang' => $monthlyDepreciation,
            'fb' => $fbStatus
        ]);
    }

    public function showDetailModal($id_hitung_depresiasi)
    {
        // Find the depreciation record
        $hitungdepresiasi = HitungDepresiasi::findOrFail($id_hitung_depresiasi);

        // Get the initial value from the related procurement
        $pengadaan = Pengadaan::findOrFail($hitungdepresiasi->id_pengadaan);
        $initialValue = $pengadaan->harga_barang;
        $duration = $hitungdepresiasi->durasi;

        // Calculate monthly depreciation rate
        $monthlyDepreciation = $initialValue / $duration;

        // Generate detailed depreciation data
        $this->detailDepreciationData = [];
        $remainingValue = $initialValue;

        for ($month = 1; $month <= $duration; $month++) {
            // Calculate depreciation for this month
            $remainingValue -= $monthlyDepreciation;

            // Ensure the value doesn't go below 0
            $remainingValue = max(0, $remainingValue);

            // Format the values
            $this->detailDepreciationData[] = [
                'month' => $month,
                'initial_value' => number_format($initialValue, 0, ',', '.'),
                'monthly_depreciation' => number_format($monthlyDepreciation, 0, ',', '.'),
                'remaining_value' => number_format($remainingValue, 0, ',', '.')
            ];
        }

        // Store the item name for the modal title
        $this->selectedItemName = $pengadaan->nama_barang ?? 'Item';
    }


    public function store()
    {
        $this->validate([
            'id_pengadaan' => 'required|exists:pengadaans,id_pengadaan',
            'tgl_hitung_depresiasi' => 'required',
            'bulan' => 'required|numeric|min:0',
            'durasi' => 'required|numeric|min:1',
        ], [
            'id_pengadaan.required' => 'Procurement Code must be selected!',
            'id_pengadaan.exists' => 'Invalid Procurement Code!',
            'tgl_hitung_depresiasi.required' => 'Depreciation Calculation date Cannot Be Empty!',
            'bulan.required' => 'Month Cannot Be Empty!',
            'bulan.numeric' => 'Month must be a number!',
            'bulan.min' => 'Month must be at least 0!',
            'durasi.required' => 'Duration Cannot Be Empty!',
            'durasi.numeric' => 'Duration must be a number!',
            'durasi.min' => 'Duration must be at least 1!',
            'nilai_barang.required' => 'Item Value Cannot Be Empty!',
            'nilai_barang.numeric' => 'Item Value must be a number!',
            'nilai_barang.min' => 'Item Value cannot be negative!',
        ]);

        // Get initial value from procurement
        $pengadaan = Pengadaan::find($this->id_pengadaan);
        $initialValue = $pengadaan->harga_barang;

        // Calculate depreciated value based on current month
        $calculationResults = $this->calculateDepreciationValue(
            $initialValue,
            $this->durasi,
            $this->bulan
        );

        HitungDepresiasi::create([
            'id_pengadaan' => $this->id_pengadaan,
            'tgl_hitung_depresiasi' => $this->tgl_hitung_depresiasi,
            'bulan' => $this->bulan,
            'durasi' => $this->durasi,
            'nilai_barang' => $calculationResults['remainingValue'],
            'created_by' => auth()->id(),
            'last_edited_by' => auth()->id(),
            'edited_count' => 0
        ]);

        // Update procurement status including fb value
        $this->updateProcurementStatus(
            $pengadaan,
            $calculationResults['remainingValue'],
            $calculationResults['monthlyDepreciation']
        );

        session()->flash('success', 'Successfully Saved!');
        $this->reset();
    }

    public function edit($id_hitung_depresiasi)
    {
        $hitungdepresiasi = HitungDepresiasi::find($id_hitung_depresiasi);
    
        // Check if user is not admin and trying to edit
        if (!auth()->user()->isAdmin()) {
            // Check if record belongs to current user
            if ($hitungdepresiasi->created_by != auth()->id()) {
                session()->flash('error', 'You can only edit your own records!');
                return;
            }
            
            // Check if edit count is already 1
            if ($hitungdepresiasi->edited_count >= 1) {
                session()->flash('error', 'You have reached the maximum number of edits allowed!');
                return;
            }
        }
        
        $this->id_pengadaan = $hitungdepresiasi->id_pengadaan;
        $this->tgl_hitung_depresiasi = $hitungdepresiasi->tgl_hitung_depresiasi;
        $this->bulan = $hitungdepresiasi->bulan;
        $this->durasi = $hitungdepresiasi->durasi;
        $this->nilai_barang = $hitungdepresiasi->nilai_barang;
        $this->id_hitung_depresiasi = $hitungdepresiasi->id_hitung_depresiasi;
    }

    public function update()
    {
        $hitungdepresiasi = HitungDepresiasi::find($this->id_hitung_depresiasi);

        if (!auth()->user()->isAdmin()) {
            if ($hitungdepresiasi->created_by != auth()->id()) {
                session()->flash('error', 'You can only edit your own records!');
                $this->reset();
                return;
            }
            
            if ($hitungdepresiasi->edited_count >= 1) {
                session()->flash('error', 'Accountants can only edit data once!');
                $this->reset();
                return;
            }
        }

        $this->validate([
            'id_pengadaan' => 'required|exists:pengadaans,id_pengadaan',
            'tgl_hitung_depresiasi' => 'required',
            'bulan' => 'required|numeric|min:1',
            'durasi' => 'required|numeric|min:1',
            'nilai_barang' => 'required|numeric|min:0',
        ]);

        // Get initial value from procurement
        $pengadaan = Pengadaan::find($this->id_pengadaan);
        $initialValue = $pengadaan->harga_barang;

        // Calculate new depreciated value and monthly depreciation
        $calculationResults = $this->calculateDepreciationValue(
            $initialValue,
            $this->durasi,
            $this->bulan
        );

        // Update depreciation calculation record
        $hitungdepresiasi->update([
            'id_pengadaan' => $this->id_pengadaan,
            'tgl_hitung_depresiasi' => $this->tgl_hitung_depresiasi,
            'bulan' => $this->bulan,
            'durasi' => $this->durasi,
            'nilai_barang' => $calculationResults['remainingValue'],
            'edited_count' => $hitungdepresiasi->edited_count + 1,
            'last_edited_by' => auth()->id(), 
            'last_edited_at' => now()
        ]);

        // Update procurement status including fb value
        $this->updateProcurementStatus(
            $pengadaan,
            $calculationResults['remainingValue'],
            $calculationResults['monthlyDepreciation']
        );


        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('calculate-depreciation');
    }

    public function confirm($id_hitung_depresiasi)
    {
        $this->id_hitung_depresiasi = $id_hitung_depresiasi;
    }

    public function destroy()
    {
        $hitungdepresiasi = HitungDepresiasi::find($this->id_hitung_depresiasi);
        $hitungdepresiasi->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }

    public function resetForm()
    {
        $this->reset(['id_pengadaan', 'tgl_hitung_depresiasi', 'bulan', 'durasi', 'nilai_barang']);
    }
}
