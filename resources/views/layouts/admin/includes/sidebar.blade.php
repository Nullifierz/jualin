<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <img src="{{ asset('frontend/logo.png') }}" alt="" class="w-50">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- nav item -kategori dan rekomendasi --> 
     <li class="nav-item {{ request()->is('category*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('category.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kategori</span>
        </a>

    </li>
    <!-- Nav Item - Rekomendasi -->
     <li class="nav-item {{ request()->is('place-recommendation*') ? 'active' : '' }}">

        <a class="nav-link" href="{{ route('place-recommendation.index') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Rekomendasi</span>
        </a>


    </li>
</ul>