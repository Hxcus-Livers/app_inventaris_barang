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
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if ($this->search != "") {
            $data['lokasi'] = Lokasi::where('kode_lokasi', 'like', '%' . $this->search . '%')
            ->orWhere('nama_lokasi', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        } else {
            $data['lokasi']= Lokasi::orderBy('created_at', 'desc')->paginate(10);
        }
        
        return view('livewire.location-component', data: $data);
    }
    public function store()
    {
        $this->validate([
            'kode_lokasi' => 'required|max:20',
            'nama_lokasi' => 'required|max:20',
            'keterangan' => 'required|max:50',
        ], [
            'kode_lokasi.required' => 'Location Code Cannot Be Empty!',
            'kode_lokasi.max' => 'Location Code Was To Loong!',
            'nama_lokasi.required' => 'Location Name Cannot Be Empty!',
            'nama_lokasi.max' => 'Location Name Was To Loong!',
            'keterangan.required' => 'Information Cannot Be Empty!',
            'keterangan.max' => 'Information Was To Loong!',
        ]);
        Lokasi::create([
            'kode_lokasi'=>$this->kode_lokasi,
            'nama_lokasi'=>$this->nama_lokasi,
            'keterangan'=>$this->keterangan
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
            'kode_lokasi'=>$this->kode_lokasi,
            'nama_lokasi'=>$this->nama_lokasi,
            'keterangan'=>$this->keterangan
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('location');
    }
    public function confirm($id_lokasi)
    {
        $this->id_lokasi = $id_lokasi;
    }
    public function destroy()
    {
        $lokasi = Lokasi::find($this->id_lokasi);
        $lokasi->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
    public function resetForm()
    {
        $this->reset(['kode_lokasi', 'nama_lokasi', 'keterangan']);
    }
}
