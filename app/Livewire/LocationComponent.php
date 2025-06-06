<?php

namespace App\Livewire;

use App\Models\Lokasi;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class LocationComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $kode_lokasi, $nama_lokasi, $keterangan, $id_lokasi, $search;
    public $showDeleteModal = false;
    public  $deleteErrorMessage = '';
    protected $paginationTheme = 'bootstrap';
    private function generateLocationCode()
    {
        $lastLocation = Lokasi::orderBy('id_lokasi', 'desc')->first();
        if ($lastLocation) {
            $lastNumber = (int) substr($lastLocation->kode_lokasi, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        return 'LOC' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
    public function render()
    {
        if ($this->search != "") {
            $data['lokasi'] = Lokasi::where('kode_lokasi', 'like', '%' . $this->search . '%')
                ->orWhere('nama_lokasi', 'like', '%' . $this->search . '%')
                ->paginate(10);
        } else {
            $data['lokasi'] = Lokasi::paginate(10);
        }

        return view('livewire.location-component', data: $data);
    }
    public function store()
    {
        $this->validate([
            'nama_lokasi' => 'required|max:20',
            'keterangan' => 'required|max:50',
        ], [
            'nama_lokasi.required' => 'Location Name Cannot Be Empty!',
            'nama_lokasi.max' => 'Location Name Was To Loong!',
            'keterangan.required' => 'Information Cannot Be Empty!',
            'keterangan.max' => 'Information Was To Loong!',
        ]);

        $this->kode_lokasi = $this->generateLocationCode();

        Lokasi::create([
            'kode_lokasi' => $this->kode_lokasi,
            'nama_lokasi' => $this->nama_lokasi,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('location');
    }
    public function edit($id_lokasi)
    {
        $lokasi = Lokasi::find($id_lokasi);
        $this->kode_lokasi = $lokasi->kode_lokasi;
        $this->nama_lokasi = $lokasi->nama_lokasi;
        $this->keterangan = $lokasi->keterangan;
        $this->id_lokasi = $lokasi->id_lokasi;
    }
    public function update()
    {
        $lokasi = Lokasi::find($this->id_lokasi);
        $lokasi->update([
            'kode_lokasi' => $this->kode_lokasi,
            'nama_lokasi' => $this->nama_lokasi,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('location');
    }
    public function confirm($id_lokasi)
    {
        $this->id_lokasi = $id_lokasi;
        $lokasi = Lokasi::find($id_lokasi);

        // Check if there are related sub-categories
        if ($lokasi->mutasiLokasi()->count() > 0) {
            $this->deleteErrorMessage = 'This category has related location-mutation. Please delete the location-mutation first.';
        } else {
            $this->deleteErrorMessage = '';
        }

        $this->showDeleteModal = true;
    }
    public function destroy()
    {
        $lokasi = Lokasi::find($this->id_lokasi);
        // Double-check for related data before deletion
        if ($lokasi->mutasiLokasi()->count() > 0) {
            session()->flash('error', 'Cannot delete: This location has related location-mutation that must be deleted first.');
            $this->showDeleteModal = false;
            return;
        }

        try {
            $lokasi->delete();
            session()->flash('success', 'Successfully Deleted!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the location.');
        }

        $this->showDeleteModal = false;
        $this->reset(['id_lokasi', 'deleteErrorMessage']);
    }
    public function resetForm()
    {
        $this->reset(['kode_lokasi', 'nama_lokasi', 'keterangan']);
    }
}
