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
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data['distributor']=Distributor::paginate(10);
        return view('livewire.distributor-component', $data);
    }
    public function store()
    {
        $this->validate([
            'nama_distributor' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'keterangan' => 'required',
        ], [
            'nama_distributor' => 'Distributor Name Cannot Be Empty!',
            'alamat' => 'Address Cannot Be Empty!',
            'no_telp' => 'Phone Number Cannot Be Empty!',
            'email' => 'Email Cannot Be Empty!',
            'keterangan' => 'Information Cannot Be Empty!',
        ]);
        Distributor::create([
            'nama_distributor'=>$this->nama_distributor,
            'alamat'=>$this->alamat,
            'no_telp'=>$this->no_telp,
            'email'=>$this->email,
            'keterangan'=>$this->keterangan
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
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
            'nama_distributor'=>$this->nama_distributor,
            'alamat'=>$this->alamat,
            'no_telp'=>$this->no_telp,
            'email'=>$this->email,
            'keterangan'=>$this->keterangan
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
    }
    public function confirm($id_distributor)
    {
        $this->id_distributor = $id_distributor;
    }
    public function destroy()
    {
        $distributor = Distributor::find($this->id_distributor);
        $distributor->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
}
