<?php

namespace App\Livewire;

use App\Models\HitungDepresiasi;
use App\Models\Pengadaan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class CalculateDepreciationComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $id_hitung_depresiasi, $id_pengadaan, $tgl_hitung_depresiasi, $bulan, $durasi, $nilai_barang;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];   

    public function mount()
    {
        $this->tgl_hitung_depresiasi = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $data['hitungdepresiasi'] = HitungDepresiasi::whereHas('pengadaan', function($query) {
            $query->where('kode_pengadaan', 'like', '%' . $this->search . '%')
            ->orWhere('harga_barang', 'like', '%' . $this->search . '%');
            
        })
        ->orWhere('bulan', 'like', '%' . $this->search . '%')
        ->orWhere('durasi', 'like', '%' . $this->search . '%')
        ->paginate(10);
        

        $data['pengadaan'] = Pengadaan::all();
        
        return view('livewire.calculate-depreciation-component', $data);
    }


    public function store()
    {
        $this->validate([
            'id_pengadaan' => 'required|exists:pengadaans,id_pengadaan',
            'tgl_hitung_depresiasi' => 'required|date',
            'bulan' => 'required|max:10',
            'durasi' => 'required|integer|min:1',
        ], [
            'id_pengadaan.required' => 'Procurement Code must be selected!',
            'id_pengadaan.exists' => 'Invalid Procurement Code!',
            'tgl_hitung_depresiasi.required' => 'Depreciation Calculation date Cannot Be Empty!',
            'tgl_hitung_depresiasi.date' => 'Invalid date format!',
            'bulan.required' => 'Month Cannot Be Empty!',
            'bulan.max' => 'Month Cannot Was To Loong!',
            'durasi.required' => 'Duration Cannot Be Empty!',
            'durasi.integer' => 'Duration must be a number!',
            'durasi.min' => 'Duration must be at least 1!',
        ]);

        HitungDepresiasi::create([
            'id_pengadaan' => $this->id_pengadaan,
            'tgl_hitung_depresiasi' => $this->tgl_hitung_depresiasi,
            'bulan' => $this->bulan,
            'durasi' => $this->durasi,
            'nilai_barang' => 0,
        ]);

        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('calculat-depreciation');
    }

    public function edit($id_hitung_depresiasi)
    {
        $hitungdepresiasi = HitungDepresiasi::find($id_hitung_depresiasi);
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
        
        $hitungdepresiasi->update([
            'id_pengadaan' => $this->id_pengadaan,
            'tgl_hitung_depresiasi' => $this->tgl_hitung_depresiasi,
            'bulan' => $this->bulan,
            'durasi' => $this->durasi,
            'nilai_barang' => $this->nilai_barang,
        ]);

        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('calculat-depreciation');
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