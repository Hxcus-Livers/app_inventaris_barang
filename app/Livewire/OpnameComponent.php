<?php

namespace App\Livewire;

use App\Models\Opname;
use App\Models\Pengadaan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class OpnameComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $id_pengadaan, $tgl_opname, $kondisi, $keterangan, $id_opname;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public function mount()
    {
        $this->tgl_opname = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        if ($this->search != "") {
            $data['opname'] = Opname::whereHas('pengadaan', function ($query) {
                $query->where('kode_pengadaan', 'like', '%' . $this->search . '%');
            })
                ->orWhere('tgl_opname', 'like', '%' . $this->search . '%')
                ->orWhere('kondisi', 'like', '%' . $this->search . '%')
                ->orWhere('keterangan', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data['opname'] = Opname::orderBy('created_at', 'desc')->paginate(10);
        }
        $data['pengadaan'] = Pengadaan::all();
        return view('livewire.opname-component', $data);
    }
    public function store()
    {
        $this->validate([
            'id_pengadaan' => 'required|exists:pengadaans,id_pengadaan',
            'tgl_opname' => 'required',
            'kondisi' => 'required|max:25',
            'keterangan' => 'required|max:100',
        ], [
            // id_pengadaan
            'id_pengadaan.required' => 'Procurement Code must be selected!',
            'id_pengadaan.exists' => 'Invalid Procurement Code!',

            'tgl_opname' => 'Date Opname Cannot Be Empty!',
            'kondisi.required' => 'Condition Cannot Be Empty!',
            'kondisi.max' => 'Condition Was To Loong!',
            'keterangan.required' => 'Information Cannot Be Empty!',
            'keterangan.max' => 'Information Was To Loong!',
        ]);
        Opname::create([
            'id_pengadaan' => $this->id_pengadaan,
            'tgl_opname' => $this->tgl_opname,
            'kondisi' => $this->kondisi,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('opname');
    }
    public function edit($id_opname)
    {
        $opname = Opname::find($id_opname);
        $this->id_pengadaan = $opname->id_pengadaan;
        $this->tgl_opname = $opname->tgl_opname;
        $this->kondisi = $opname->kondisi;
        $this->keterangan = $opname->keterangan;
        $this->id_opname = $opname->id_opname;
    }
    public function update()
    {
        $opname = Opname::find($this->id_opname);
        $opname->update([
            'id_pengadaan' => $this->id_pengadaan,
            'tgl_opname' => $this->tgl_opname,
            'kondisi' => $this->kondisi,
            'keterangan' => $this->keterangan
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('opname');
    }
    public function confirm($id_opname)
    {
        $this->id_opname = $id_opname;
    }
    public function destroy()
    {
        $opname = Opname::find($this->id_opname);
        $opname->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
    public function resetForm()
    {
        $this->reset(['id_pengadaan', 'tgl_opname', 'kondisi', 'keterangan']);
    }
}
