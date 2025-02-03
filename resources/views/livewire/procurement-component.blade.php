@section('breadcrumb')
Pages
@endsection

@section('breadcrumb-active')
Procurement Management
@endsection

@section('page-title')
Procurement
@endsection

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Procurement Table</h6>
                    <!-- Search bar -->
                    <div class="ms-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="search" class="form-control search-input" wire:model.live="search" placeholder="Type here...">
                        </div>
                    </div>
                    <!-- End Search bar -->
                </div>
                <div class="card-body w-100">
                    @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Depresiasi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Brand</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Asset Subcategory</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Distributor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Procurement Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item Serial Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Production Year</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Procurement Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item Value</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Depreciation Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Flag Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Information</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selection</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pengadaan->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">Data has not been entered</td>
                                    </tr>
                                    @else
                                    @foreach ($pengadaan as $data)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->masterbarang)
                                                {{ $data->masterbarang->nama_barang }}
                                                @else
                                                <span class="text-muted">No Item</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->depresiasi)
                                                {{ $data->depresiasi->lama_depresiasi }}
                                                @else
                                                <span class="text-muted">No Depreciation</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->merk)    
                                                {{ $data->merk->merk }}
                                                @else
                                                <span class="text-muted">No Brand</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->satuan)
                                                {{ $data->satuan->satuan }}
                                                @else
                                                <span class="text-muted">No Unit</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->subkategoriasset)
                                                {{ $data->subkategoriasset->sub_kategori_asset }}
                                                @else
                                                <span class="text-muted">No Subcategory</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->distributor)
                                                {{ $data->distributor->nama_distributor }}
                                                @else
                                                <span class="text-muted">No Distributor</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->kode_pengadaan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->no_invoice }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->no_seri_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->tahun_produksi }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->tgl_pengadaan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->jumlah_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($data->harga_barang, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($data->nilai_barang, 0, ',', ',') }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($data->depresiasi_barang, 0, ',', ',') }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($data->fb == 0)
                                            <span class="badge badge-sm bg-gradient-secondary">Not worth Using</span>
                                            @elseif ($data->fb == 1)
                                            <span class="badge badge-sm bg-gradient-success">Still Usable</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-danger">Unknown Status</span>
                                            @endif
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->keterangan }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" wire:click="edit({{ $data->id_pengadaan }})" class="text-warning font-weight-bold text-xs me-3" data-bs-toggle="modal" data-bs-target="#editPage">Edit</a>
                                            <a href="javascript:;" wire:click="confirm({{ $data->id_pengadaan }})" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deletePage">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $pengadaan->links() }}
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPage">
                        <i class="fa-solid fa-folder-plus"></i> Add
                    </button>
                </div>
            </div>
            <!-- Add -->
            <div wire:ignore.self class="modal fade " id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Procurement</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <!-- Item -->
                                <div class="form-group">
                                    <label>Item</label>
                                    <select class="form-control" wire:model="id_master_barang">
                                        <option value="">-- Select Item --</option>
                                        @foreach ($masterbarang as $data)
                                        <option value="{{ $data->id_master_barang }}">{{ $data->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_master_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Depresiasi -->
                                <div class="form-group">
                                    <label>Depresiasi</label>
                                    <select class="form-control" wire:model="id_depresiasi">
                                        <option value="">-- Select Depresiasi --</option>
                                        @foreach ($depresiasi as $data)
                                        <option value="{{ $data->id_depresiasi }}">{{ $data->lama_depresiasi }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_depresiasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Brand -->
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control" wire:model="id_merk">
                                        <option value="">-- Select Brand --</option>
                                        @foreach ($merk as $data)
                                        <option value="{{ $data->id_merk }}">{{ $data->merk }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_merk')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Unit -->
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="form-control" wire:model="id_satuan">
                                        <option value="">-- Select Unit --</option>
                                        @foreach ($satuan as $data)
                                        <option value="{{ $data->id_satuan }}">{{ $data->satuan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_satuan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Asset Subcategory -->
                                <div class="form-group">
                                    <label>Asset Subcategory</label>
                                    <select class="form-control" wire:model="id_sub_kategori_asset">
                                        <option value="">-- Select Asset Subcategory --</option>
                                        @foreach ($subkategoriasset as $data)
                                        <option value="{{ $data->id_sub_kategori_asset }}">{{ $data->sub_kategori_asset }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_sub_kategori_asset')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Distributor -->
                                <div class="form-group">
                                    <label>Distributor</label>
                                    <select class="form-control" wire:model="id_distributor">
                                        <option value="">-- Select Distributor --</option>
                                        @foreach ($distributor as $data)
                                        <option value="{{ $data->id_distributor }}">{{ $data->nama_distributor }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_distributor')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Item Serial Number -->
                                <div class="form-group">
                                    <label>Item Serial Number</label>
                                    <input type="text" class="form-control" wire:model="no_seri_barang">
                                    @error('no_seri_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Invoice Number -->
                                <div class="form-group">
                                    <label>Invoice Number</label>
                                    <input type="text" class="form-control" wire:model="no_invoice">
                                    @error('no_invoice')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Amount Item -->
                                <div class="form-group">
                                    <label>Amount Item</label>
                                    <input type="number" class="form-control" wire:model="jumlah_barang">
                                    @error('jumlah_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Price Item -->
                                <div class="form-group">
                                    <label>Price Item</label>
                                    <input type="number" class="form-control" wire:model="harga_barang">
                                    @error('harga_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Production Year -->
                                <div class="form-group">
                                    <label>Production Year</label>
                                    <input type="number" class="form-control" wire:model="tahun_produksi">
                                    @error('tahun_produksi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Information -->
                                <div class="form-group">
                                    <label>Information</label>
                                    <textarea class="form-control" wire:model="keterangan"></textarea>
                                    @error('keterangan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Depresiasi Barang akan dihitung otomatis -->
                                <input type="hidden" wire:model="kode_pengadaan">
                                <input type="hidden" wire:model="tgl_pengadaan">
                                <input type="hidden" wire:model="depresiasi_barang">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Close</button>
                            <button type="button" wire:click="store" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit -->
            <div wire:ignore.self class="modal fade " id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Location Mutation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <!-- Item -->
                                <div class="form-group">
                                    <label>Item</label>
                                    <select class="form-control" wire:model="id_master_barang">
                                        <option value="">-- Select Item --</option>
                                        @foreach ($masterbarang as $data)
                                        <option value="{{ $data->id_master_barang }}">{{ $data->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_master_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Depresiasi -->
                                <div class="form-group">
                                    <label>Depresiasi</label>
                                    <select class="form-control" wire:model="id_depresiasi">
                                        <option value="">-- Select Depresiasi --</option>
                                        @foreach ($depresiasi as $data)
                                        <option value="{{ $data->id_depresiasi }}">{{ $data->lama_depresiasi }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_depresiasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Brand -->
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control" wire:model="id_merk">
                                        <option value="">-- Select Brand --</option>
                                        @foreach ($merk as $data)
                                        <option value="{{ $data->id_merk }}">{{ $data->merk }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_merk')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Unit -->
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="form-control" wire:model="id_satuan">
                                        <option value="">-- Select Unit --</option>
                                        @foreach ($satuan as $data)
                                        <option value="{{ $data->id_satuan }}">{{ $data->satuan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_satuan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Asset Subcategory -->
                                <div class="form-group">
                                    <label>Asset Subcategory</label>
                                    <select class="form-control" wire:model="id_sub_kategori_asset">
                                        <option value="">-- Select Asset Subcategory --</option>
                                        @foreach ($subkategoriasset as $data)
                                        <option value="{{ $data->id_sub_kategori_asset }}">{{ $data->sub_kategori_asset }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_sub_kategori_asset')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Distributor -->
                                <div class="form-group">
                                    <label>Distributor</label>
                                    <select class="form-control" wire:model="id_distributor">
                                        <option value="">-- Select Distributor --</option>
                                        @foreach ($distributor as $data)
                                        <option value="{{ $data->id_distributor }}">{{ $data->nama_distributor }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_distributor')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Item Serial Number -->
                                <div class="form-group">
                                    <label>Item Serial Number</label>
                                    <input type="text" class="form-control" wire:model="no_seri_barang">
                                    @error('no_seri_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Invoice Number -->
                                <div class="form-group">
                                    <label>Invoice Number</label>
                                    <input type="text" class="form-control" wire:model="no_invoice">
                                    @error('no_invoice')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Amount Item -->
                                <div class="form-group">
                                    <label>Amount Item</label>
                                    <input type="number" class="form-control" wire:model="jumlah_barang">
                                    @error('jumlah_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Price Item -->
                                <div class="form-group">
                                    <label>Price Item</label>
                                    <input type="number" class="form-control" wire:model="harga_barang">
                                    @error('harga_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Production Year -->
                                <div class="form-group">
                                    <label>Production Year</label>
                                    <input type="number" class="form-control" wire:model="tahun_produksi">
                                    @error('tahun_produksi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Information -->
                                <div class="form-group">
                                    <label>Information</label>
                                    <textarea class="form-control" wire:model="keterangan"></textarea>
                                    @error('keterangan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Depresiasi Barang akan dihitung otomatis -->
                                <input type="hidden" wire:model="kode_pengadaan">
                                <input type="hidden" wire:model="tgl_pengadaan">
                                <input type="hidden" wire:model="depresiasi_barang">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Close</button>
                            <button type="button" wire:click="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete -->
            <div wire:ignore.self class="modal fade " id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Location Mutation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" wire:click="destroy" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>