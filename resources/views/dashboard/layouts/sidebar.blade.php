 <!-- Sidebar -->
 <ul class="navbar-nav bg-light sidebar sidebar-light accordion shadow" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
       
        <div class="sidebar-brand-text mx-2">
            <h4>BPM Dashboard</h4>
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
   
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ Request::is('dashboard/posts*') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/posts">
            <i class="fas fa-fw fa-edit"></i>
            @if (Auth::user()->is_admin == true)
            <span>Review Tulisan</span></a>
            @else
            <span>Tulisan Saya</span></a>
            @endif
            
    </li>
  
    <li class="nav-item">
        <a class="nav-link " href="/artikel">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Preview Tulisan</span></a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/tags') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/tags">
            
            <i class="fa-solid fa-fw fa-hashtag"></i>
           
            <span>Tag</span></a>
    </li>

    @can('admin')
    <div class="sidebar-heading">
       -Admin Section-
    </div>
    @if (Auth::user()->username == 'Moh Agung N')
    <li class="nav-item {{ Request::is('dashboard/manajemen-user') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/manajemen-user">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen User</span></a>
      </li>

      <li class="nav-item {{ Request::is('dashboard/manajemen-event') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/manajemen-event">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Manajemen Event</span></a>
      </li>
    @else
    @endif

    <li class="nav-item {{ Request::is('dashboard/tentang-bpm') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/tentang-bpm">
            <i class="fas fa-fw fa-info"></i>
            <span>Tentang BPM</span></a>
      </li>

    <li class="nav-item {{ Request::is('dashboard/categories') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/categories">
            <i class="fas fa-fw fa-tags"></i>
            <span>Topik</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse"
            aria-expanded="true" aria-controls="collapse">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Kontak</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <a class="collapse-item {{ Request::is('dashboard/kirim-email-author') ? 'active' : '' }}" href="/dashboard/kirim-email-author">Kirim Balasan</a> --}}
                <a class="collapse-item {{ Request::is('dashboard/pesan-masuk') ? 'active' : '' }}" href="/dashboard/pesanmasuk">Pesan Masuk</a>
            </div>
           
        </div>
    </li>
 
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Subscriber</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('dashboard/subscriber') ? 'active' : '' }}" href="/dashboard/subscriber">Subscriber</a>
                
            </div>
        </div>
    </li>
  
    @endcan

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
 <script src="https://kit.fontawesome.com/048e5448dd.js" crossorigin="anonymous"></script>
<!-- End of Sidebar -->