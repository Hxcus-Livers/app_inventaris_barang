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
    public $showDeleteModal = false;
    public  $deleteErrorMessage = '';
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
            'satuan' => $this->satuan,
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
            'satuan' => $this->satuans,
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('unit');
    }
    public function confirm($id_satuan)
    {
        $this->id_satuan = $id_satuan;
        $satuans = Satuan::find($id_satuan);

        // Check if there are related sub-categories
        if ($satuans->pengadaan()->count() > 0) {
            $this->deleteErrorMessage = 'This unit has related procurement. Please delete the procurement first.';
        } else {
            $this->deleteErrorMessage = '';
        }

        $this->showDeleteModal = true;
    }
    public function destroy()
    {
        $satuans = Satuan::find($this->id_satuan);
        // Double-check for related data before deletion
        if ($satuans->pengadaan()->count() > 0) {
            session()->flash('error', 'Cannot delete: This unit has related procurement that must be deleted first.');
            $this->showDeleteModal = false;
            return;
        }

        try {
            $satuans->delete();
            session()->flash('success', 'Successfully Deleted!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the unit.');
        }

        $this->showDeleteModal = false;
        $this->reset(['id_satuan', 'deleteErrorMessage']);
    }
    public function resetForm()
    {
        $this->reset(['satuan']);
    }
}
