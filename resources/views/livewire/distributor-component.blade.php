@section('breadcrumb')
    Pages / Master Data Management
@endsection

@section('page-title')
    Distributor
@endsection

<div>
    <div class="card" style="background-color: #ffffff1a; color: #fff;">
        <div class="card-header">
            <h4 class="mb-0">Distributors table</h4>
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
                            <th scope="col" style="white-space: nowrap;">Distributor Name</th>
                            <th scope="col" style="white-space: nowrap;">Address</th>
                            <th scope="col" style="white-space: nowrap;">Phone Number</th>
                            <th scope="col" style="white-space: nowrap;">Email</th>
                            <th scope="col" style="white-space: nowrap;">Information</th>
                            <th scope="col" style="white-space: nowrap;">Selection</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributor as $data)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_distributor }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->no_telp }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td class="selection">
                                <div class="btn-group" role="group" aria-label="Selection Buttons">
                                    <button type="button" wire:click="edit({{ $data->id_distributor}})"
                                        class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editPage">
                                        <i class="fas fa-edit"></i> Edit </button>
                                    <button type="button" wire:click="confirm({{ $data->id_distributor }})"
                                        class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletePage">
                                        <i class="fas fa-trash"></i> Delete </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $distributor->links() }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Distributor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="from-group">
                            <label>Distributor Name</label>
                            <input type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="nama_distributor" value="{{ @old('nama_distributor')}}">
                            @error('nama_distributor')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Address</label>
                            <textarea type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="alamat">{{ @old('alamat')}}</textarea>
                            @error('alamat')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Phone Number</label>
                            <input type="number" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="no_telp" value="{{ @old('no_telp')}}">
                            @error('no_telp')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Email</label>
                                <input type="emailt" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="email" value="{{ @old('email')}}">
                            @error('email')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Information</label>
                            <textarea type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="keterangan">{{ @old('keterangan')}}</textarea>
                            @error('keterangan')
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
                            <label>Distributor Name</label>
                            <input type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="nama_distributor" value="{{ @old('nama_distributor')}}">
                            @error('nama_distributor')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Address</label>
                            <textarea type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="alamat">{{ @old('alamat')}}</textarea>
                            @error('alamat')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Phone Number</label>
                            <input type="number" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="no_telp" value="{{ @old('no_telp')}}">
                            @error('no_telp')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Email</label>
                                <input type="emailt" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="email" value="{{ @old('email')}}">
                            @error('email')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label>Information</label>
                            <textarea type="text" class="form-control" style="background-color: #ffffff1a; color: #fff;" wire:model="keterangan">{{ @old('keterangan')}}</textarea>
                            @error('keterangan')
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Distributor</h1>
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