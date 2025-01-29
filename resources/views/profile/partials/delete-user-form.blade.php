<!-- Delete Account Card -->
<div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Delete Account</h6>
                    <p class="text-sm text-gray-600">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                    </p>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeletion">
                        Delete Account
                    </button>
                </div>
            </div>

            <!-- Delete Account Modal -->
            <div class="modal fade" id="confirmDeletion" tabindex="-1" aria-labelledby="confirmDeletionLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')
                            
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeletionLabel">Delete Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <div class="modal-body">
                                <p>Are you sure you want to delete your account?</p>
                                <p class="text-sm text-gray-600">
                                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                                </p>

                                <div class="form-group mt-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    @error('password')
                                    <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>