<div class="sidebar">
    <div class="px-4 mb-4">
        <h5 class="text-white d-flex align-items-center">
            <i class="fas fa-cube me-2"></i>
            Inventori Item
        </h5>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <i class="fas fa-tv"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('item') || Request::is('distributor') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#masterDataDropdown" aria-expanded="false" aria-controls="masterDataDropdown">
                <i class="fas fa-table"></i>
                Master Data Management
                <i class="fas fa-caret-down ms-auto"></i>
            </a>
            <div id="masterDataDropdown" class="collapse {{ Request::is('item') || Request::is('distributor') ? 'show' : '' }}">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('item') ? 'active' : '' }}" href="{{ route('item') }}">
                            <i class="fas fa-cube"></i>
                            Items
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('distributor') ? 'active' : '' }}" href="{{ route('distributor') }}">
                            <i class="fas fa-truck"></i>
                            Distributor
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('billing') ? 'active' : '' }}" href="#">
                <i class="fas fa-credit-card"></i>
                Billing
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('virtual-reality') ? 'active' : '' }}" href="#">
                <i class="fas fa-vr-cardboard"></i>
                Virtual Reality
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('rtl') ? 'active' : '' }}" href="#">
                <i class="fas fa-globe"></i>
                RTL
            </a>
        </li>
    </ul>

</div>