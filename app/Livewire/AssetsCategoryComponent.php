<?php

namespace App\Livewire;

use App\Models\KategoriAsset;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class AssetsCategoryComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $kode_kategori_asset, $kategori_asset, $id_kategori_asset, $search;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if ($this->search != "") {
            $data['kategoriasset'] = KategoriAsset::where('kategori_asset', 'like', '%' . $this->search . '%')
            ->orWhere('kode_kategori_asset', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        } else {
            $data['kategoriasset']=KategoriAsset::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('livewire.assets-category-component', $data);
    }
    private function generateKodeKategoriAsset()
    {
        $lastKategori = KategoriAsset::orderBy('kode_kategori_asset', 'desc')->first();
        
        if ($lastKategori) {
            $lastNumber = intval(substr($lastKategori->kode_kategori_asset, 4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $this->kode_kategori_asset = 'KCAT' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
    public function store()
    {
        $this->validate([
            'kategori_asset' => 'required|max:25',
        ], [
            'kategori_asset.required' => 'Assets Category Name Cannot Be Empty!',
            'kategori_asset.max' => 'Assets Category Name Was To Loong!!',
        ]);

        $this->generateKodeKategoriAsset();

        KategoriAsset::create([
            'kode_kategori_asset'=>$this->kode_kategori_asset,
            'kategori_asset'=>$this->kategori_asset,
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('assets-category');
    }
    public function edit($id_kategori_asset)
    {
        $kategoriasset = KategoriAsset::find($id_kategori_asset);
        $this->kode_kategori_asset = $kategoriasset->kode_kategori_asset;
        $this->kategori_asset = $kategoriasset->kategori_asset;
        $this->id_kategori_asset = $kategoriasset->id_kategori_asset;
    }
    public function update()
    {
        $kategoriasset = KategoriAsset::find($this->id_kategori_asset);
        $kategoriasset->update([
            'kode_kategori_asset'=>$this->kode_kategori_asset,
            'kategori_asset'=>$this->kategori_asset,
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('assets-category');
    }
    public function confirm($id_kategori_asset)
    {
        $this->id_kategori_asset = $id_kategori_asset;
    }
    public function destroy()
    {
        $kategoriasset = KategoriAsset::find($this->id_kategori_asset);
        $kategoriasset->delete();
        session()->flash('success', 'Successfully Deleted!');
        $this->reset();
    }
    public function resetForm()
    {
        $this->reset(['kode_kategori_asset', 'kategori_asset']);
    }
}
