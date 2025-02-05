@section('breadcrumb')
Pages
@endsection

@section('breadcrumb-active')
Location Mutation Management
@endsection

@section('page-title')
Location Mutation
@endsection

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Location Mutation Table</h6>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Location</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Procurement Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Location Flag</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Flag Move</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selection</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($mutasilokasi->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">Data has not been entered</td>
                                    </tr>
                                    @else
                                    @foreach ($mutasilokasi as $data)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->lokasi)
                                                {{ $data->lokasi->nama_lokasi }}
                                                @else
                                                <span class="text-muted">No Location</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->pengadaan)
                                                {{ $data->pengadaan->kode_pengadaan }}
                                                @else
                                                <span class="text-muted">No Procurement Code</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->flag_lokasi }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->flag_pindah }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" wire:click="edit({{ $data->id_mutasi_lokasi }})" class="text-warning font-weight-bold text-xs me-3" data-bs-toggle="modal" data-bs-target="#editPage">Edit</a>
                                            <a href="javascript:;" wire:click="confirm({{ $data->id_mutasi_lokasi }})" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deletePage">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $mutasilokasi->links() }}
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Asset Subcategory</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <!-- Location -->
                                <div class="form-group">
                                    <label>Location</label>
                                    <select class="form-control" wire:model="id_lokasi">
                                        <option value="">-- Select Location --</option>
                                        @foreach ($lokasi as $data)
                                        <option value="{{ $data->id_lokasi }}">{{ $data->nama_lokasi }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_lokasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Procurement Code -->
                                <div class="form-group">
                                    <label>Procurement Code</label>
                                    <select class="form-control" wire:model="id_pengadaan">
                                        <option value="">-- Select Procurement Code --</option>
                                        @foreach ($pengadaan as $data)
                                        <option value="{{ $data->id_pengadaan }}">{{ $data->kode_pengadaan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pengadaan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Location Flag -->
                                <div class="form-group">
                                    <label>Location Flag</label>
                                    <input type="text" class="form-control" wire:model="flag_lokasi">
                                    @error('flag_lokasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Flag Move -->
                                <div class="form-group">
                                    <label>Flag Move</label>
                                    <input type="text" class="form-control" wire:model="flag_pindah">
                                    @error('flag_pindah')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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
                                <!-- Location -->
                                <div class="form-group">
                                    <label>Location</label>
                                    <select class="form-control" wire:model="id_lokasi">
                                        <option value="">-- Select Location --</option>
                                        @foreach ($lokasi as $data)
                                        <option value="{{ $data->id_lokasi }}">{{ $data->nama_lokasi }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_lokasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Procurement Code -->
                                <div class="form-group">
                                    <label>Procurement Code</label>
                                    <select class="form-control" wire:model="id_pengadaan">
                                        <option value="">-- Select Procurement Code --</option>
                                        @foreach ($pengadaan as $data)
                                        <option value="{{ $data->id_pengadaan }}">{{ $data->kode_pengadaan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pengadaan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Location Flag -->
                                <div class="form-group">
                                    <label>Location Flag</label>
                                    <input type="text" class="form-control" wire:model="flag_lokasi">
                                    @error('flag_lokasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Flag Move -->
                                <div class="form-group">
                                    <label>Flag Move</label>
                                    <input type="text" class="form-control" wire:model="flag_pindah">
                                    @error('flag_pindah')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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