<?php

namespace App\Livewire;

use App\Models\Satuan;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class UnitComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $satuan, $id_satuan;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data['satuans'] = Satuan::paginate(10);
        return view('livewire.unit-component', $data);
    }
    public function store()
    {
        $this->validate([
            'satuan' => 'required',
        ], messages: [
            'satuan' => 'Unit Cannot Be Empty!',
        ]);
        Satuan::create([
            'satuan'=>$this->satuan,
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route(route: 'unit');
    }
    public function edit($id_satuan)
    {
        $satuans = Satuan::find($id_satuan);
        $this->satuan = $satuans->satuan;
        $this->id_satuan = $satuans->id_satuan;
    }
    public function update()
    {
        $satuans = Satuan::find($this->id_satuan);
        $satuans->update([
            'satuan'=>$this->satuans,
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('unit');
    }
    public function confirm($id_satuan)
    {
        $this->id_satuan = $id_satuan;
    }
    public function destroy()
    {
        $satuans = Satuan::find($this->id_satuan);
        $satuans->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
    public function resetForm()
    {
        $this->reset(['satuan']);
    }
}
