<?php

namespace App\Livewire;

use App\Models\MasterBarang;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ItemComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $kode_barang,$nama_barang,$spesifikasi_teknis,$id_master_barang,$search;
    public function render()
    {
        if ($this->search != "") {
            $data['masterbarang'] = MasterBarang::where('nama_barang', 'like', '%' . $this->search . '%')
            ->orWhere('kode_barang', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        } else {
            $data['masterbarang']=MasterBarang::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('livewire.item-component',  $data);
    }
    private function generateItemCode()
    {
        $lastItem = MasterBarang::orderBy('id_master_barang', 'desc')->first();
        if ($lastItem) {
            $lastNumber = (int) substr($lastItem->kode_barang, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        return 'ITM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
    public function store()
    {
        // Validate the request data
        $this->validate([
                'nama_barang' => 'required|max:100',
                'spesifikasi_teknis' => 'required|max:100',
            ],[
                'nama_barang.required' => 'Item Names Cannot Be Empty!',
                'nama_barang.max' => 'Item Names Was To Loong!',
                'spesifikasi_teknis.required' => 'Technical Specifications Cannot Be Empty!',
                'spesifikasi_teknis.max' => 'Technical Specifications Was To Loong!',
            ]
        );
                // Generate item code automatically
                $this->kode_barang = $this->generateItemCode();

        MasterBarang::create([
            'kode_barang'=>$this->kode_barang,
            'nama_barang'=>$this->nama_barang,
            'spesifikasi_teknis'=>$this->spesifikasi_teknis
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('item');
    }   
    public function edit($id_master_barang)
    {
        $masterbarang = MasterBarang::find($id_master_barang);
        $this->kode_barang = $masterbarang->kode_barang;
        $this->nama_barang = $masterbarang->nama_barang;
        $this->spesifikasi_teknis = $masterbarang->spesifikasi_teknis;
        $this->id_master_barang = $masterbarang->id_master_barang;
    }
    public function update()
    {
        $masterbarang = MasterBarang::find($this->id_master_barang);
        $masterbarang->update([
            'kode_barang' => $this->kode_barang,
            'nama_barang' => $this->nama_barang,
            'spesifikasi_teknis' => $this->spesifikasi_teknis
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('item');
    }
    public function confirm($id_master_barang)
    {
        $this->id_master_barang = $id_master_barang;
    }
    public function destroy()
    {
        $masterbarang = MasterBarang::find($this->id_master_barang);
        $masterbarang->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
    public function resetForm()
    {
        $this->reset(['kode_barang', 'nama_barang', 'spesifikasi_teknis']);
    }
}
