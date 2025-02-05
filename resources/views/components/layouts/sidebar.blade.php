    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
                <img src="../assets/img/icon.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Inventaris Items</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-scrollbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tv text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                @if(auth()->user()->isAdmin())
                <!-- Data Management -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Management</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link" {{ Request::is('item') ? 'active' : '' }}" href="{{ route('item') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-box text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Items</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('distributor') ? 'active' : '' }}" href="{{ route('distributor') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Distributors</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('location') ? 'active' : '' }}" href="{{ route('location') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-location-dot text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Location</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('assets-category') ? 'active' : '' }}" href="{{ route('assets-category') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-folder-open text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Assets Category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('asset-subcategory') ? 'active' : '' }}" href="{{ route('asset-subcategory') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Asset Subcategory</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('brand') ? 'active' : '' }}" href="{{ route('brand') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-brands fa-bandcamp text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Brand</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('unit') ? 'active' : '' }}" href="{{ route('unit') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tags text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Unit</span>
                    </a>
                </li>
                <!-- End Data Management -->

                <!-- Procurement Management -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Procurement Management</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('procurement') ? 'active' : '' }}" href="{{ route('procurement') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-invoice text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Procurement</span>
                    </a>
                </li>

                <!-- Location Mutation Management -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Location Mutation Management</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('location-mutation') ? 'active' : '' }}" href="{{ route('location-mutation') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-map-marker-alt text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Location Mutation</span>
                    </a>
                </li>
                <!-- End Location Mutation Management -->
                @endif

                <!-- Depreciation Management -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Depreciation Management</h6>
                </li>
                @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('depreciation') ? 'active' : '' }}" href="{{ route('depreciation') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-line text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Depreciation</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('calculate-depreciation') ? 'active' : '' }}" href="{{ route('calculate-depreciation') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-calculator text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Calculate Depreciation</span>
                    </a>
                </li>
                <!-- End Depreciation Management -->

                @if(auth()->user()->isAdmin())
                <!-- Audit and Recording -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Audit and Recording</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('opname') ? 'active' : '' }}" href="{{ route('opname') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-clipboard-check text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Opname</span>
                    </a>
                </li>
                <!-- End Audit and Recording -->
                @endif

                <!-- Account pages -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profile.edit') ? 'active' : ''}}" href="{{ route('profile.edit')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/sign-in.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-sign-in-alt text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Log Out</span>
                    </a>
                </li>
                @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-plus text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Create Account</span>
                    </a>
                </li>
                @endif
                <!-- End Account pages -->
            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
            <div class="card card-plain shadow-none" id="sidenavCard">

                <div class="card-body text-center p-3 w-100 pt-0">
                    <div class="docs-info">

                    </div>
                </div>
            </div>
        </div>
    </aside>