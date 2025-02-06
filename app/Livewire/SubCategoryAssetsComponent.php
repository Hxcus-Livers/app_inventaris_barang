<?php

namespace App\Livewire;

use App\Models\KategoriAsset;
use App\Models\SubKategoriAsset;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class SubCategoryAssetsComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $id_kategori_asset, $kode_sub_kategori_asset, $sub_kategori_asset, $id_sub_kategori_asset;
    public $search = '';
    public $showDeleteModal = false;
    public $deleteErrorMessage = '';
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public function render()
    {
        if ($this->search != "") {
            $data['subkategoriasset'] = SubKategoriAsset::whereHas('kategoriasset', function ($query) {
                $query->where('kategori_asset', 'like', '%' . $this->search . '%');
            })
                ->orWhere('kode_sub_kategori_asset', 'like', '%' . $this->search . '%')
                ->orWhere('sub_kategori_asset', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data['subkategoriasset'] = SubKategoriAsset::orderBy('created_at', 'desc')->paginate(10);
        }
        $data['kategoriasset'] = KategoriAsset::all();
        return view('livewire.sub-category-assets-component', $data);
    }
    private function generateKodeSubKategoriAsset()
    {
        $lastSubKategori = SubKategoriAsset::orderBy('kode_sub_kategori_asset', 'desc')->first();

        if ($lastSubKategori) {
            $lastNumber = intval(substr($lastSubKategori->kode_sub_kategori_asset, 4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $this->kode_sub_kategori_asset =  'SUB' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public function store()
    {
        $this->validate([
            'id_kategori_asset' => 'required|exists:kategori_assets,id_kategori_asset',
            'sub_kategori_asset' => 'required|max:25',
        ], [
            'id_kategori_asset.required' => 'Asset category must be selected!',
            'id_kategori_asset.exists' => 'Invalid asset category!',
            'sub_kategori_asset' => 'Asset Subcategory Cannot Be Empty!',
            'sub_kategori_asset.max' => 'Asset Subcategory Was To Loong!',
        ]);

        $this->generateKodeSubKategoriAsset();

        SubKategoriAsset::create([
            'id_kategori_asset' => $this->id_kategori_asset,
            'kode_sub_kategori_asset' => $this->kode_sub_kategori_asset,
            'sub_kategori_asset' => $this->sub_kategori_asset
        ]);
        session()->flash('success', 'Successfully Saved!');
        $this->reset();
        return redirect()->route('asset-subcategory');
    }
    public function edit($id_sub_kategori_asset)
    {
        $subkategoriasset = SubKategoriAsset::find($id_sub_kategori_asset);
        $this->id_kategori_asset = $subkategoriasset->id_kategori_asset;
        $this->kode_sub_kategori_asset = $subkategoriasset->kode_sub_kategori_asset;
        $this->sub_kategori_asset = $subkategoriasset->sub_kategori_asset;
        $this->id_sub_kategori_asset = $subkategoriasset->id_sub_kategori_asset;
    }
    public function update()
    {
        $subkategoriasset = SubKategoriAsset::find($this->id_sub_kategori_asset);
        $subkategoriasset->update([
            'id_kategori_asset' => $this->id_kategori_asset,
            'kode_sub_kategori_asset' => $this->kode_sub_kategori_asset,
            'sub_kategori_asset' => $this->sub_kategori_asset
        ]);
        session()->flash('success', 'Successfully Changed!');
        $this->reset();
        return redirect()->route('asset-subcategory');
    }
    public function confirm($id_sub_kategori_asset)
    {
        $this->id_sub_kategori_asset = $id_sub_kategori_asset;
        $subKategoriAsset = SubKategoriAsset::find($id_sub_kategori_asset);

        // Check if there are related pengadaan
        if ($subKategoriAsset->pengadaan()->count() > 0) {
            $this->deleteErrorMessage = 'This subcategory has related procurement data. Please delete the procurement data first.';
        } else {
            $this->deleteErrorMessage = '';
        }

        $this->showDeleteModal = true;
    }
    public function destroy()
    {
        $subKategoriAsset = SubKategoriAsset::find($this->id_sub_kategori_asset);
        
        // Double-check for related data before deletion
        if ($subKategoriAsset->pengadaan()->count() > 0) {
            session()->flash('error', 'Cannot delete: This subcategory has related procurement data that must be deleted first.');
            $this->showDeleteModal = false;
            return;
        }

        try {
            $subKategoriAsset->delete();
            session()->flash('success', 'Successfully Deleted!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the subcategory.');
        }

        $this->showDeleteModal = false;
        $this->reset(['id_sub_kategori_asset', 'deleteErrorMessage']);

    }
    public function resetForm()
    {
        $this->reset(['id_kategori_asset', 'kode_sub_kategori_asset', 'sub_kategori_asset']);
    }
}
