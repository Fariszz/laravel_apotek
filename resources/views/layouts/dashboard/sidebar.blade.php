<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-laptop-medical"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Supraun Product</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(Auth::user()->role_id == 1)
        <!-- Nav Item - User Menu -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('payment.check') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>User Payment</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="fas fa-fw fa-box"></i>
                <span>Category</span></a>
        </li>
        <!-- Nav Item - Dropshipper Menu -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="dropshipper.html">
                <i class="fab fa-fw fa-dropbox"></i>
                <span>Dropshipper</span></a>
        </li> --}}
    @endif

    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <!-- Nav Item - Items Menu -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="fas fa-fw fa-prescription-bottle-alt"></i>
                <span>Items</span></a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="{{ route('payment.history') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>payment History</span></a>
        </li>
        <hr class="sidebar-divider">
    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
