<?php

namespace App\Livewire;

use App\Models\Depresiasi;
use App\Models\Distributor;
use App\Models\MasterBarang;
use App\Models\Merk;
use App\Models\Pengadaan;
use App\Models\Satuan;
use App\Models\SubKategoriAsset;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Carbon\Carbon;

class ProcurementComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public $id_master_barang, $id_depresiasi, $id_merk, $id_satuan, $id_sub_kategori_asset,
        $id_distributor, $kode_pengadaan, $no_invoice, $no_seri_barang, $tahun_produksi,
        $tgl_pengadaan, $jumlah_barang, $harga_barang, $nilai_barang, $depresiasi_barang,
        $fb, $keterangan, $id_Pengadaan;
    public $search = '';

    public function mount()
    {
        // Set default values when component is mounted
        $this->tgl_pengadaan = Carbon::now()->format('Y-m-d');
        $this->generateKodePengadaan();
        $this->depresiasi_barang = "Belum dihitung";
        $this->fb = "1"; // Default to new item
    }

    private function generateKodePengadaan()
    {
        $now = Carbon::now();
        $dateCode = $now->format('Ymd');
        $randomNum = rand(1000, 9999);
        $this->kode_pengadaan = 'PO' . $dateCode . $randomNum;
    }

    private function calculateNilaiBarang()
    {
        if ($this->jumlah_barang && $this->harga_barang) {
            $this->nilai_barang = $this->jumlah_barang * $this->harga_barang;
        }
    }

    public function updatedJumlahBarang()
    {
        $this->calculateNilaiBarang();
    }

    public function updatedHargaBarang()
    {
        $this->calculateNilaiBarang();
    }

    public function render()
    {
        if ($this->search != "") {
            $data['pengadaan'] = Pengadaan::whereHas('masterbarang', function ($query) {
                $query->where('nama_barang', 'like', '%' . $this->search . '%');
            })
                ->orWhere('kode_pengadaan', 'like', '%' . $this->search . '%')
                ->orWhere('no_invoice', 'like', '%' . $this->search . '%')
                ->orWhere('no_seri_barang', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data['pengadaan'] = Pengadaan::orderBy('created_at', 'desc')->paginate(10);
        }
        $data['masterbarang'] = MasterBarang::all();
        $data['depresiasi'] = Depresiasi::all();
        $data['merk'] = Merk::all();
        $data['satuan'] = Satuan::all();
        $data['subkategoriasset'] = SubKategoriAsset::all();
        $data['distributor'] = Distributor::all();
        return view('livewire.procurement-component', $data);
    }

    public function store()
    {
        $this->validate([
            'id_master_barang' => 'required',
            'id_depresiasi' => 'required',
            'id_merk' => 'required',
            'id_satuan' => 'required',
            'id_sub_kategori_asset' => 'required',
            'id_distributor' => 'required',
            'no_invoice' => 'required|max:20',
            'no_seri_barang' => 'required|max:50',
            'tahun_produksi' => 'required|numeric|max:9999|min:1900',
            'jumlah_barang' => 'required',
            'harga_barang' => 'required',
            'keterangan' => 'required|max:50',

        ], [
            // Validation messages remain the same
        ]);
        // dd($this);
        $this->calculateNilaiBarang();

        // Create new procurement with auto-generated values
        Pengadaan::create([
            'id_master_barang' => $this->id_master_barang,
            'id_depresiasi' => $this->id_depresiasi,
            'id_merk' => $this->id_merk,
            'id_satuan' => $this->id_satuan,
            'id_sub_kategori_asset' => $this->id_sub_kategori_asset,
            'id_distributor' => $this->id_distributor,
            'kode_pengadaan' => $this->kode_pengadaan,
            'no_invoice' => $this->no_invoice,
            'no_seri_barang' => $this->no_seri_barang,
            'tahun_produksi' => $this->tahun_produksi,
            'tgl_pengadaan' => $this->tgl_pengadaan,
            'jumlah_barang' => $this->jumlah_barang,
            'harga_barang' => $this->harga_barang,
            'nilai_barang' => $this->nilai_barang,
            'depresiasi_barang' => 0, // Initial value before calculation
            'fb' => $this->fb ?? '1',
            'keterangan' => $this->keterangan
        ]);

        session()->flash('success', 'Successfully Saved!');
        $this->resetForm();
        return redirect()->route('procurement');
    }

    public function edit($id_Pengadaan)
    {
        $pengadaan = Pengadaan::find($id_Pengadaan);
        // Fill all the properties
        $this->id_master_barang = $pengadaan->id_master_barang;
        $this->id_depresiasi = $pengadaan->id_depresiasi;
        $this->id_merk = $pengadaan->id_merk;
        $this->id_satuan = $pengadaan->id_satuan;
        $this->id_sub_kategori_asset = $pengadaan->id_sub_kategori_asset;
        $this->id_distributor = $pengadaan->id_distributor;
        $this->kode_pengadaan = $pengadaan->kode_pengadaan;
        $this->no_invoice = $pengadaan->no_invoice;
        $this->no_seri_barang = $pengadaan->no_seri_barang;
        $this->tahun_produksi = $pengadaan->tahun_produksi;
        $this->tgl_pengadaan = $pengadaan->tgl_pengadaan;
        $this->jumlah_barang = $pengadaan->jumlah_barang;
        $this->harga_barang = $pengadaan->harga_barang;
        $this->nilai_barang = $pengadaan->nilai_barang;
        $this->depresiasi_barang = $pengadaan->depresiasi_barang;
        $this->fb = $pengadaan->fb;
        $this->keterangan = $pengadaan->keterangan;
        $this->id_Pengadaan = $pengadaan->id_pengadaan;
    }

    public function update()
    {
        $this->calculateNilaiBarang();

        $pengadaan = Pengadaan::find($this->id_Pengadaan);
        $pengadaan->update([
            'id_master_barang' => $this->id_master_barang,
            'id_depresiasi' => $this->id_depresiasi,
            'id_merk' => $this->id_merk,
            'id_satuan' => $this->id_satuan,
            'id_sub_kategori_asset' => $this->id_sub_kategori_asset,
            'id_distributor' => $this->id_distributor,
            'no_invoice' => $this->no_invoice,
            'no_seri_barang' => $this->no_seri_barang,
            'tahun_produksi' => $this->tahun_produksi,
            'tgl_pengadaan' => $this->tgl_pengadaan,
            'jumlah_barang' => $this->jumlah_barang,
            'harga_barang' => $this->harga_barang,
            'nilai_barang' => $this->nilai_barang,
            'depresiasi_barang' => $this->depresiasi_barang,
            'fb' => $this->fb,
            'keterangan' => $this->keterangan
        ]);

        session()->flash('success', 'Successfully Changed!');
        $this->resetForm();
        return redirect()->route('procurement');
    }
    public function confirm($id_Pengadaan)
    {
        $this->id_Pengadaan = $id_Pengadaan;
    }
    public function destroy()
    {
        $pengadaan = Pengadaan::find($this->id_Pengadaan);
        $pengadaan->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
    public function resetForm()
    {
        $this->reset([
            'id_master_barang',
            'id_depresiasi',
            'id_merk',
            'id_satuan',
            'id_sub_kategori_asset',
            'id_distributor',
            'no_invoice',
            'no_seri_barang',
            'tahun_produksi',
            'jumlah_barang',
            'harga_barang',
            'nilai_barang',
            'fb',
            'keterangan'
        ]);

        // Reset and regenerate the auto-generated fields
        $this->tgl_pengadaan = Carbon::now()->format('Y-m-d');
        $this->generateKodePengadaan();
        $this->depresiasi_barang = "Belum dihitung";
    }
}
