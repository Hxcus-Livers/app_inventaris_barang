<?php

namespace App\Livewire;

use App\Models\Depresiasi;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DepreciationComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $id_depresiasi, $lama_depresiasi, $keterangan, $search;
    public $showDeleteModal = false;
    public $deleteErrorMessage = '';
    public function render()
    {
        if ($this->search != "") {
            $data['depresiasi'] = Depresiasi::where('lama_depresiasi', 'like', '%' . $this->search . '%')
                ->orWhere('keterangan', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data['depresiasi'] = Depresiasi::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('livewire.depreciation-component', $data);
    }
    public function store()
    {
        $this->validate([
            'lama_depresiasi' => 'required',
            'keterangan' => 'required|max:50',
        ], messages: [
            'lama_depresiasi' => 'Depreciation Period Cannot Be Empty!',
            'keterangan.required' => 'Information Cannot Be Empty!',
            'keterangan.max' => 'Information Was To Loong!!',
        ]);
        Depresiasi::create([
            'lama_depresiasi' => $this->lama_depresiasi,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('depreciation');
    }
    public function edit($id_depresiasi)
    {
        $depresiasi = Depresiasi::find($id_depresiasi);
        $this->lama_depresiasi = $depresiasi->lama_depresiasi;
        $this->keterangan = $depresiasi->keterangan;
        $this->id_depresiasi = $depresiasi->id_depresiasi;
    }
    public function update()
    {
        $depresiasi = Depresiasi::find($this->id_depresiasi);
        $depresiasi->update([
            'lama_depresiasi' => $this->lama_depresiasi,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('depreciation');
    }
    public function confirm($id_depresiasi)
    {
        $this->id_depresiasi = $id_depresiasi;
        $depresiasi = Depresiasi::find($id_depresiasi);

        if ($depresiasi->pengadaan()->count() > 0) {
            $this->deleteErrorMessage = 'This depresiasi has related procurement. Please delete the procurement first.';
        } else {
            $this->deleteErrorMessage = '';
        }

        $this->showDeleteModal = true;
    }
    public function destroy()
    {
        $depresiasi = Depresiasi::find($this->id_depresiasi);
        // Double-check for related data before deletion
        if ($depresiasi->pengadaan()->count() > 0) {
            session()->flash('error', 'Cannot delete: This depresiasi has related procurement that must be deleted first.');
            $this->showDeleteModal = false;
            return;
        }

        try {
            $depresiasi->delete();
            session()->flash('success', 'Successfully Deleted!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the depresiasi.');
        }

        $this->showDeleteModal = false;
        $this->reset(['id_depresiasi', 'deleteErrorMessage']);
    }
    public function resetForm()
    {
        $this->reset(['lama_depresiasi', 'keterangan']);
    }
}
