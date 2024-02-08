  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light sticky-top bg-light topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
      </button>

     {{-- <a href="" class="text-muted text-decoration-none">Your Tier:  --}}

        
        
{{--         
        @if ($post < 1)
              <a style="color: #696767">Belum ada Tier</a>
              @elseif ($post < 10)
              <img src="{{ asset('img/tier/bronze.png') }}" width="40px" alt="tier"> <a style="color: #CD7F32">Bronze</a> 
              @elseif ($post < 20)
              <img src="{{ asset('img/tier/silver.png') }}" width="40px" alt="tier"> <a style="color:#adacac">Silver</a>
              @elseif ($post < 30)
              <img src="{{ asset('img/tier/gold.png') }}" width="40px" alt="tier"> <a style="color:#FFD700">Gold</a>
              @elseif($post < 40)
              <img src="{{ asset('img/tier/gm.png') }}" width="40px" alt="tier"> <a style="color:#144FAD">Grand Master</a>
              @endif
    </a>&nbsp;  
    

    &nbsp; &nbsp; @if ($post == 40)
      <a href=""> Klaim Reward</a> 
    @else
        
    @endif --}}
      {{-- navbar search posts --}}
      {{-- @if (Route::is('posts.index'))
      <form action="/dashboard/posts"
          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
          
          <div class="input-group">
              <input type="text" value="{{ request('search') }}" name="search"
                  class="form-control bg-light border-0 small" placeholder="Cari Tulisan.." aria-label="Search"
                  aria-describedby="basic-addon2">
              <div class="input-group-append">
                  <button class="btn btn" style="background-color: rgb(143, 97, 218); color:white;" type="submit">
                      <i class="fas fa-search fa-sm"></i>
                  </button>
              </div>
          </div>
      </form>
      @endif --}}

      {{-- navbar search tags --}}
      {{-- @if (Route::is('tags.index'))
      <form action="/dashboard/tags"
          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">


          <div class="input-group">
              <input type="text" value="{{ request('search') }}" name="search"
                  class="form-control bg-light border-0 small" placeholder="Cari Tag.." aria-label="Search"
                  aria-describedby="basic-addon2">
              <div class="input-group-append">
                  <button class="btn btn" style="background-color: rgb(143, 97, 218); color:white;" type="submit">
                      <i class="fas fa-search fa-sm"></i>
                  </button>
              </div>
          </div>
      </form>
      @endif --}}

      {{-- navbar search categories --}}
      {{-- @if (Route::is('categories.index'))
      <form action="/dashboard/categories"
          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">

          <div class="input-group">
              <input type="text" value="{{ request('search') }}" name="search"
                  class="form-control bg-light border-0 small" placeholder="Cari Kategori.." aria-label="Search"
                  aria-describedby="basic-addon2">
              <div class="input-group-append">
                  <button class="btn btn" style="background-color: rgb(143, 97, 218); color:white;" type="submit">
                      <i class="fas fa-search fa-sm"></i>
                  </button>
              </div>
          </div>
      </form>
      @endif --}}


      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          {{-- <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> --}}


          <p class="small text-muted">Version (TESTING)</p>
          <div class="topbar-divider d-none d-sm-block"></div>

          @can('admin')
                       {{-- ----------------messages-------------------------}}
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                
             @if (isset($notif))
             <span class="badge badge-danger badge-counter">{{ $counts }}</span>
             @else
             
             @endif
              
            

                
                
                
              

        </a>
       
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header bg-dark">
                Pesan Pemberitahuan
            </h6>
            @if($notif->count())
            @foreach ($notif as $not)
            <a class="dropdown-item d-flex align-items-center" href="/dashboard/pesanmasuk">
                <div class="dropdown-list-image mr-3">

                    @if (isset($not->is_read))
                    <i class="fas fa-envelope-open-text fa-fw text-secondary"></i>
                    @else
                    <i class="fas fa-envelope"><span class="badge badge-danger badge-counter">Baru</span></i>

                    @endif




                </div>
                <div class="font-weight-bold">
                    @if (isset($not->is_read))
                    <div class="text-truncate text-gray-600">{{ $not->subyek }}</div>
                    <div class="small text-gray-700">{{ $not->created_at->diffForHumans() }} | Telah dibaca</div>
                    @else
                    <div class="text-truncate">{{ $not->subyek }}</div>
                    <div class="small text-gray-700">{{ $not->created_at->diffForHumans() }} | Belum dibaca</div>
                    @endif
                    
                </div>
            </a>

            @endforeach
            <a class="dropdown-item text-center small" href="/dashboard/pesanmasuk">Read More Messages</a>
            @else
            <div class="text-center">
                <p class="small">Belum ada pesan.. <img src="https://img.icons8.com/ios/23/000000/sad.png" /></p>
            </div>

            @endif
        </div>
        </li>
          @endcan
 

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                  <img class="img-profile rounded-circle" src="/uploads/avatars/{{ Auth::user()->avatar }}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item {{ Request::is('dashboard/profile') ? 'active' : '' }}"
                      href="/dashboard/profile">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                  </a>
                  <a class="dropdown-item {{ Request::is('dashboard/changepassword') ? 'active' : '' }}"
                      href="/dashboard/changepassword">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Change Password
                  </a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                  </a>
              </div>
          </li>

      </ul>

  </nav>
  <!-- End of Topbar -->


















  {{-- 

   <div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
      <a href="/dashboard" class="simple-text logo-normal">
        <div class="logo-image-big">
          <img src="{{ asset('/img/logonavbartdc.png') }}" width="100%">
  </div>
  </a>
  </div>

  <div class="sidebar-wrapper">
      <ul class="nav">

          <li class="{{ Request::is('dashboard/profile')? 'active' : '' }}">
              <a href="/dashboard/profile">
                  <img src="/uploads/avatars/{{ Auth::user()->avatar }}" width="50px" class="rounded-circle">
                  {{ Auth::user()->username }}
              </a>

          </li>

          <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
              <a href="/dashboard">
                  <i class="nc-icon nc-tv-2"></i>
                  <p>Dashboard</p>
              </a>
          </li>

          <li class="{{ Request::is('dashboard/posts*') ? 'active' : '' }}">
              <a href="/dashboard/posts">
                  <i class="nc-icon nc-bullet-list-67"></i>
                  <p>My Posts</p>
              </a>
          </li>
          <hr>


          <li class="{{ Request::is('dashboard/tags') ? 'active' : '' }}">
              <a href="/dashboard/tags">
                  <i class="nc-icon nc-tag-content"></i>
                  <p>Tag post</p>
              </a>
          </li>

          <li class="{{ Request::is('dashboard/categories*') ? 'active' : '' }}">
              <a href="/dashboard/categories">
                  <i class="nc-icon nc-tag-content"></i>
                  <p>Kategori post</p>
              </a>
          </li>

      </ul>
  </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
      <div class="container-fluid">
          <div class="navbar-wrapper">
              <div class="navbar-toggle">
                  <button type="button" class="navbar-toggler">
                      <span class="navbar-toggler-bar bar1"></span>
                      <span class="navbar-toggler-bar bar2"></span>
                      <span class="navbar-toggler-bar bar3"></span>
                  </button>
              </div>

          </div>

      </div>
  </nav>
  <!-- End Navbar -->

  <div class="fixed-plugin">
      <div class="dropdown show-dropdown">
          <a href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-cog fa-2x"> </i>
          </a>
          <ul class="dropdown-menu" style="will-change: transform;">
              <li class="header-title"> <i class="nc-icon nc-settings"></i> Setting</li>

              <li class="button-container">

                  <a href="/dashboard/profile" class="btn btn-primary btn-block btn-round">
                      <i class="nc-icon nc-single-02"></i>
                      Profile
                  </a>
              </li>
              <li class="button-container">
                  <a href="/dashboard/changepassword" class="btn btn-primary btn-block btn-round">
                      <i class="nc-icon nc-touch-id"></i>
                      Change Password
                  </a>
              </li>
              <li class="button-container">
                  <a href="/" class="btn btn-outline-default btn-block btn-round">
                      <i class="nc-icon nc-tile-56"></i>
                      Homepage
                  </a>
              </li>
              <li class="button-container">

                  <form action="/logout" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item"><a class="text-danger">LogOut</a></button>
                  </form>

              </li>


          </ul>
      </div>
  </div>




  --}}
