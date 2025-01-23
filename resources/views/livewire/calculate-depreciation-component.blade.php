@section('breadcrumb')
Pages
@endsection

@section('breadcrumb-active')
Depreciation Management
@endsection

@section('page-title')
Calculat Depreciation
@endsection

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Calculat Depreciation Table</h6>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Procurement Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Depreciation Calculation Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Month</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item Value</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selection</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($hitungdepresiasi->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">Data has not been entered</td>
                                    </tr>
                                    @else
                                    @foreach ($hitungdepresiasi as $data)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
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
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($data->pengadaan)
                                                Rp. {{ number_format($data->pengadaan->harga_barang, 0, ',', '.') }}
                                                @else
                                                <span class="text-muted">No Procurement Code</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->tgl_hitung_depresiasi }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->bulan }} th Month</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->durasi }} Mount</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($data->nilai_barang, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" wire:click="showDetailModal({{ $data->id_hitung_depresiasi }})" class="text-info font-weight-bold text-xs me-3" data-bs-toggle="modal" data-bs-target="#depreciationDetailModal" >
                                                Detail
                                            </a>
                                            <a href="javascript:;" wire:click="edit({{ $data->id_hitung_depresiasi }})" class="text-warning font-weight-bold text-xs me-3" data-bs-toggle="modal" data-bs-target="#editPage">Edit</a>
                                            <a href="javascript:;" wire:click="confirm({{ $data->id_hitung_depresiasi }})" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deletePage">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $hitungdepresiasi->links() }}
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Calculat Depreciation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form>
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
                                <!-- Month -->
                                <div class="form-group">
                                    <label>Month</label>
                                    <input type="text" class="form-control" wire:model="bulan">
                                    @error('bulan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Duration -->
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="text" class="form-control" wire:model="durasi">
                                    @error('durasi')
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
            <!-- Depreciation Detail Modal -->
            <div wire:ignore.self class="modal fade" id="depreciationDetailModal" tabindex="-1" aria-labelledby="depreciationDetailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="depreciationDetailModalLabel">
                                Depreciation Details - {{ $selectedItemName }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Initial Value</th>
                                        <th>Monthly Depreciation</th>
                                        <th>Remaining Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detailDepreciationData as $detail)
                                        <tr>
                                            <td>{{ $detail['month'] }}</td>
                                            <td>Rp. {{ $detail['initial_value'] }}</td>
                                            <td>Rp. {{ $detail['monthly_depreciation'] }}</td>
                                            <td>Rp. {{ $detail['remaining_value'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit -->
            <div wire:ignore.self class="modal fade " id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Calculat Depreciation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
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
                                <!-- Depreciation Calculation -->
                                <div class="form-group">
                                    <label>Depreciation Calculation</label>
                                    <input type="text" class="form-control" wire:model="tgl_hitung_depresiasi">
                                    @error('tgl_hitung_depresiasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Month -->
                                <div class="form-group">
                                    <label>Month</label>
                                    <input type="text" class="form-control" wire:model="bulan">
                                    @error('bulan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Duration -->
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="text" class="form-control" wire:model="durasi">
                                    @error('durasi')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Item Value -->
                                <div class="form-group">
                                    <label>Item Value</label>
                                    <input type="text" class="form-control" wire:model="nilai_barang">
                                    @error('nilai_barang')
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Calculat Depreciation</h1>
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
