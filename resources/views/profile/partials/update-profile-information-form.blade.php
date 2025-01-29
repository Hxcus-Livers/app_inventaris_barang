<!-- Profile Information Card -->
<div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Profile Information</h6>
                    <p class="text-sm text-gray-600">
                        Update your account's profile information and email address.
                    </p>
                </div>
                <div class="card-body">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-gray-800">
                                        Your email address is unverified.
                                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-primary">
                                            Click here to re-send the verification email.
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-sm text-success">
                                            A new verification link has been sent to your email address.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>

                            @if (session('status') === 'profile-updated')
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