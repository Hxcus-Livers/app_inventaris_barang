<!-- Update Password Card -->
<div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Update Password</h6>
                    <p class="text-sm text-gray-600">
                        Ensure your account is using a long, random password to stay secure.
                    </p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="update_password_current_password" name="current_password" autocomplete="current-password">
                            @error('current_password')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="update_password_password" name="password" autocomplete="new-password">
                            @error('password')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                            @error('password_confirmation')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>

                            @if (session('status') === 'password-updated')
                                <span class="text-sm text-success ms-3"
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)">
                                    Saved.
                                </span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>