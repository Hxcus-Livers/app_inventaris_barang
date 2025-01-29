<x-layouts.app>

@section('breadcrumb')
Authentication
@endsection

@section('breadcrumb-active')
Account pages
@endsection

@section('page-title')
Create Account
@endsection

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Create Account</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required 
                                   autofocus 
                                   autocomplete="name">
                            @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required 
                                   autocomplete="username">
                            @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mt-3">
                            <label for="password">Password</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password"
                                   required 
                                   autocomplete="new-password">
                            @error('password')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" 
                                   name="password_confirmation"
                                   required 
                                   autocomplete="new-password">
                            @error('password_confirmation')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <a href="{{ route('login') }}" class="text-sm text-primary text-decoration-none">
                                Already registered?
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.app>