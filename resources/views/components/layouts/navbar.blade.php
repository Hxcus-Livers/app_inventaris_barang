<div class="d-flex justify-content-between align-items-center mb-4">
    <button class="btn btn-primary d-md-none menu-toggle">☰</button>
    <div
        class="d-flex w-100 justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <!-- Page Title -->
        <div>
            <div class="text-gray-400 mb-1">@yield('breadcrumb', 'Pages / Dashboard')</div>
            <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
        </div>
        <!-- End Page Title -->

        <div class="d-flex align-items-center gap-3">

            <!-- Search bar -->
            <div class="position-relative">
                <i class="fas fa-search position-absolute" style="color: grey; top: 50%; left: .5rem; transform: translateY(-50%);"></i>
                <input type="search" wire:model.live="search" class="search-input text-white" style="padding-left: 2rem;" placeholder="Type here...">
            </div>
            <!-- End Search bar -->

            <!-- Button Profile & Logout -->
            <button type="button" class="btn btn-sm btn-outline-secondary">Profile</button>
            <div class="btn-group">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a :href="route('logout')"
                        onclick="event.preventDefault();
                                this.closest('form').submit();" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Log Out') }}
                    </a>
                </form>
            </div>
            <!-- End Button Profile & Logout -->
        </div>
    </div>
</div>
