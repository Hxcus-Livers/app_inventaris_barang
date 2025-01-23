<?php

namespace App\Livewire;

use App\Models\Merk;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class BrandComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $merk, $keterangan, $id_merk, $search;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if ($this->search != "") {
            $data['merks'] = Merk::where('merk', 'like', '%' . $this->search . '%')
            ->orWhere('keterangan', 'like', '%' . $this->search . '%')
            ->paginate(10);
        } else {
            $data['merks']=Merk::paginate(10);
        }
        
        return view('livewire.brand-component', $data);
    }
    public function store()
    {
        $this->validate([
            'merk' => 'required|max:50',
            'keterangan' => 'required|max:50',
        ], messages: [
            'merk.required' => 'Brand Cannot Be Empty!',
            'merk.max' => 'Brand Was To Loong!!',
            'keterangan.required' => 'Information Cannot Be Empty!',
            'keterangan.max' => 'Information Was To Loong!!',
        ]);
        Merk::create([
            'merk'=>$this->merk,
            'keterangan'=>$this->keterangan
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('brand');
    }
    public function edit($id_merk)
    {
        $merks = Merk::find($id_merk);
        $this->merk = $merks->merk;
        $this->keterangan = $merks->keterangan;
        $this->id_merk = $merks->id_merk;
    }
    public function update()
    {
        $merks = Merk::find($this->id_merk);
        $merks->update([
            'merk'=>$this->merk,
            'keterangan'=>$this->keterangan
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('brand');
    }
    public function confirm($id_merk)
    {
        $this->id_merk = $id_merk;
    }
    public function destroy()
    {
        $merks = Merk::find($this->id_merk);
        $merks->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
    public function resetForm()
    {
        $this->reset(['merk', 'keterangan']);
    }
}
