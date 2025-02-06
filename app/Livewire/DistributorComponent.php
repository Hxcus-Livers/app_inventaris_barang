<?php

namespace App\Livewire;

use App\Models\Distributor;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DistributorComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $nama_distributor, $alamat, $no_telp, $email, $keterangan, $id_distributor, $search;
    public $showDeleteModal = false;
    public  $deleteErrorMessage = '';
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if ($this->search != "") {
            $data['distributor'] = Distributor::where('nama_distributor', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data['distributor'] = Distributor::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('livewire.distributor-component', $data);
    }
    public function store()
    {
        $this->validate([
            'nama_distributor' => 'required|max:50',
            'alamat' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'email' => 'required|max:30',
            'keterangan' => 'required|max:45',
        ], [
            'nama_distributor.required' => 'Distributor Name Cannot Be Empty!',
            'nama_distributor.max' => 'Distributor Name Was To Loong!',
            'alamat.required' => 'Address Cannot Be Empty!',
            'alamat.max' => 'Address Was To Loong!',
            'no_telp.required' => 'Phone Number Cannot Be Empty!',
            'no_telp.max' => 'Phone Number Was To Loong!',
            'email.required' => 'Email Cannot Be Empty!',
            'email.max' => 'Email Was To Loong!',
            'keterangan.required' => 'Information Cannot Be Empty!',
            'keterangan.max' => 'Information Was To Loong!',
        ]);
        Distributor::create([
            'nama_distributor' => $this->nama_distributor,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('distributor');
    }
    public function edit($id_distributor)
    {
        $distributor = Distributor::find($id_distributor);
        $this->nama_distributor = $distributor->nama_distributor;
        $this->alamat = $distributor->alamat;
        $this->no_telp = $distributor->no_telp;
        $this->email = $distributor->email;
        $this->keterangan = $distributor->keterangan;
        $this->id_distributor = $distributor->id_distributor;
    }
    public function update()
    {
        $distributor = Distributor::find($this->id_distributor);
        $distributor->update([
            'nama_distributor' => $this->nama_distributor,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('distributor');
    }
    public function confirm($id_distributor)
    {
        $this->id_distributor = $id_distributor;
        $distributor = Distributor::find($id_distributor);

        // Check if there are related 
        if ($distributor->pengadaan()->count() > 0) {
            $this->deleteErrorMessage = 'This category has related procurement. Please delete the procurement first.';
        } else {
            $this->deleteErrorMessage = '';
        }

        $this->showDeleteModal = true;
    }
    public function destroy()
    {
        $distributor = Distributor::find($this->id_distributor);
        // Double-check for related data before deletion
        if ($distributor->pengadaaan()->count() > 0) {
            session()->flash('error', 'Cannot delete: This distributor has related procurement that must be deleted first.');
            $this->showDeleteModal = false;
            return;
        }

        try {
            $distributor->delete();
            session()->flash('success', 'Successfully Deleted!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the distributor.');
        }

        $this->showDeleteModal = false;
        $this->reset(['id_distributor', 'deleteErrorMessage']);
    }
    public function resetForm()
    {
        $this->reset(['nama_distributor', 'alamat', 'no_telp', 'email', 'keterangan']);
    }
}
