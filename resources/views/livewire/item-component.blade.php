@section('breadcrumb')
    Pages / Master Data Management
@endsection

@section('page-title')
    Items
@endsection

<div>
    <div class="card" style="background-color: #ffffff1a; color: #fff;">
        <div class="card-header">
            <h4 class="mb-0">Items table</h4>
        </div>
        <div class="card-body w-100">
            @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{session('success')}}
            </div>

            @endif
             <!-- Search bar -->
             <div class="position-relative">
                <i class="fas fa-search position-absolute" style="color: grey; top: 50%; left: .5rem; transform: translateY(-50%);"></i>
                <input type="search" wire:model.live="search" class="search-input text-white" style="padding-left: 2rem;" placeholder="Type here...">
            </div>
            <!-- End Search bar -->
            <div class="table-responsive">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col" style="white-space: nowrap;">Item Code</th>
                            <th scope="col" style="white-space: nowrap;">Item Name</th>
                            <th scope="col" style="white-space: nowrap;">Technical Specifications</th>
                            <th scope="col" style="white-space: nowrap;">Selection</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masterbarang as $data)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $data->kode_barang }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->spesifikasi_teknis }}</td>
                            <td class="selection">
                                <div class="btn-group" role="group" aria-label="Selection Buttons">
                                    <button type="button" wire:click="edit({{ $data->id_master_barang}})"
                                        class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editPage">
                                        <i class="fas fa-edit"></i> Edit </button>
                                    <button type="button" wire:click="confirm({{ $data->id_master_barang }})"
                                        class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletePage">
                                        <i class="fas fa-trash"></i> Delete </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $masterbarang->links() }}
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPage">
                <i class="fa-solid fa-folder-plus"></i> Add</button>
        </div>
    </div>
    <!-- Add -->
    <div wire:ignore.self class="modal fade " id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #0f172a;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="from-group">
                            <label>Item Code</label>
                            <input type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="kode_barang" value="{{ @old('kode_barang')}}">
                            @error('kode_barang')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="nama_barang" value="{{ @old('nama_barang')}}">
                            @error('nama_barang')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Technical Specifications</label>
                            <textarea type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="spesifikasi_teknis">{{ @old('spesifikasi_teknis')}}</textarea>
                            @error('spesifikasi_teknis')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="store" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit -->
    <div wire:ignore.self class="modal fade " id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #0f172a;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="from-group">
                            <label>Item Code</label>
                            <input type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="kode_barang" value="{{ @old('kode_barang')}}">
                            @error('kode_barang')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="nama_barang" value="{{ @old('nama_barang')}}">
                            @error('nama_barang')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Technical Specifications</label>
                            <textarea type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="spesifikasi_teknis">{{ @old('spesifikasi_teknis')}}</textarea>
                            @error('spesifikasi_teknis')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete -->
    <div wire:ignore.self class="modal fade " id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #0f172a;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
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
</>