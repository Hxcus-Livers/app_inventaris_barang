<?php

namespace App\Livewire;

use App\Models\Lokasi;
use App\Models\MutasiLokasi;
use App\Models\Pengadaan;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class LocationMutationComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $id_mutasi_lokasi, $id_lokasi, $id_pengadaan, $flag_lokasi, $flag_pindah;
    public $search = '';
    public $showDeleteModal = false;
    public $deleteErrorMessage = '';
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public function render()
    {
        if ($this->search != "") {
            $data['mutasilokasi'] = MutasiLokasi::whereHas('pengadaan', function($query) {
                $query->where('kode_pengadaan', 'like', '%' . $this->search . '%');
                
            })
            ->orWherehas('lokasi', function($query) {
                $query->where('nama_lokasi', 'like', '%' . $this->search . '%');
            })
            ->orWhere('flag_lokasi', 'like', '%' . $this->search . '%')
            ->orWhere('flag_pindah', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10); 
        } else {
            $data['mutasilokasi']= MutasiLokasi::orderBy('created_at', 'desc')->paginate(10);
        }
        $data['lokasi'] = Lokasi::all();
        $data['pengadaan'] = Pengadaan::all();
        return view('livewire.location-mutation-component', $data);
    }
    public function store()
    {
        $this->validate([
            'id_lokasi' => 'required|exists:lokasis,id_lokasi',
            'id_pengadaan' => 'required|exists:pengadaans,id_pengadaan',
            'flag_lokasi' => 'required|max:45',
            'flag_pindah' => 'required|max:45',
        ], [
            // id_lokasi
            'id_lokasi.required' => 'Location must be selected!',
            'id_lokasi.exists' => 'Invalid Location!',

            // id_pengadaan
            'id_pengadaan.required' => 'Procurement Code must be selected!',
            'id_pengadaan.exists' => 'Invalid Procurement Code!',
            
            'flag_lokasi.required' => 'Location Flag Cannot Be Empty!',
            'flag_lokasi.max' => 'Location Flag Was To Loong!',
            'flag_pindah.required' => 'Flag Move Cannot Be Empty!',
            'flag_pindah.max' => 'Flag Move Was To Loong!',
        ]);
        MutasiLokasi::create([
            'id_lokasi' => $this->id_lokasi,
            'id_pengadaan' => $this->id_pengadaan,
            'flag_lokasi' => $this->flag_lokasi,
            'flag_pindah' => $this->flag_pindah
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('location-mutation');
    }
    public function edit($id_mutasi_lokasi)
    {
        $mutasilokasi = MutasiLokasi::find($id_mutasi_lokasi);
        $this->id_lokasi = $mutasilokasi->id_lokasi;
        $this->id_pengadaan = $mutasilokasi->id_pengadaan;
        $this->flag_lokasi = $mutasilokasi->flag_lokasi;
        $this->flag_pindah = $mutasilokasi->flag_pindah;
        $this->id_mutasi_lokasi = $mutasilokasi->id_mutasi_lokasi;
    }
    public function update()
    {
        $mutasilokasi = MutasiLokasi::find($this->id_mutasi_lokasi);
        $mutasilokasi->update([
            'id_lokasi' => $this->id_lokasi,
            'id_pengadaan' => $this->id_pengadaan,
            'flag_lokasi' => $this->flag_lokasi,
            'flag_pindah' => $this->flag_pindah
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('location-mutation');
    }
    public function confirm($id_mutasi_lokasi)
    {
        $this->id_mutasi_lokasi = $id_mutasi_lokasi;
        $mutasiLokasi = MutasiLokasi::find($id_mutasi_lokasi);

        if ($mutasiLokasi->pengadaan()->count() > 0) {
            $this->deleteErrorMessage = 'This location-mutation has related procurement. Please delete the procurement first.';
        } else {
            $this->deleteErrorMessage = '';
        }

        $this->showDeleteModal = true;
    }
    public function destroy()
    {
        $mutasiLokasi = MutasiLokasi::find($this->id_mutasi_lokasi);
        
        try {
            $mutasiLokasi->delete();
            session()->flash('success', 'Successfully Deleted!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the location mutation.');
        }

        $this->showDeleteModal = false;
        $this->reset(['id_mutasi_lokasi', 'deleteErrorMessage']);

    }
    public function resetForm()
    {
        $this->reset(['id_lokasi', 'id_pengadaan', 'flag_lokasi', 'flag_pindah']);
    }
}
