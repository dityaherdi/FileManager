<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
      <div class="sidebar-brand-icon">
        {{-- <i class="fas fa-warehouse"></i> --}}
        <img src="{{ asset('img/logo.png') }}" style="width: 30%">
      </div>
      {{-- <div class="sidebar-brand-text mx-3">Bunda FM</div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Home
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-search"></i>
        {{-- <span>Home</span></a> --}}
        <span>Search</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    @can('isAdmin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Master Data:</h6>
            <a class="collapse-item" href="{{ route('unit.index') }}">Unit</a>
            <a class="collapse-item" href="{{ route('jabatan.index') }}">Jabatan</a>
            <a class="collapse-item" href="{{ route('user.index') }}">User</a>
            <a class="collapse-item" href="{{ route('akses.index') }}">Hak Akses</a>  
            </div>
        </div>
        </li>
    @endcan

    <!-- Heading -->
    <div class="sidebar-heading">
      Manager
    </div>

    <!-- Nav Item - Unit Files -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('file.unit') }}">
        <i class="fas fa-fw fa-suitcase"></i>
        {{-- <span>{{ Auth::user()->unit->nama_unit }} Files</span></a> --}}
        <span>Unit Files</span></a>
    </li>

    <!-- Nav Item - Shared Files -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('file.shared') }}">
        <i class="fas fa-fw fa-file"></i>
        <span>Shared Files</span></a>
    </li>

    <!-- Nav Item - Hak Akses User -->
    @if (Auth::user()->isManager && !Auth::user()->isAdmin)
      <li class="nav-item">
        <a class="nav-link" href="{{ route('akses.index') }}">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Hak Akses User</span></a>
      </li>
    @endif
    
    <!-- Nav Item - User Log -->
    @can('isAdmin')
        <li class="nav-item">
        <a class="nav-link" href="{{ route('trash.index') }}">
            <i class="fas fa-fw fa-recycle"></i>
            <span>Recycle Bin</span></a>
        </li>
    @endcan

    <!-- Nav Item - User Log -->
    @can('isAdmin')
        <li class="nav-item">
        <a class="nav-link" href="{{ route('log.index') }}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>User Log</span></a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->