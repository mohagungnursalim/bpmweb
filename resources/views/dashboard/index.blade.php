@extends('dashboard.layouts.main')

@section('container')
<head>
  <title> {{Auth::user()->username}} | Dashboard  </title>
 
</head>

<div class="row">   
  

  <!-- Total kategori -->
  @can('admin')
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                       Kategori</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="badge badge-success badge-counter">{{ $category }} </span></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    </div>
  @endcan

  <!-- Total Pesan -->
  @can('admin')
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                         Pesan Masuk</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">@if (isset($notif))
                        <span class="badge badge-danger badge-counter">{{ $counts }}</span>
                        @else
                        0
                        @endif</div>
                </div>
                <div class="col-auto">
                    <!--<i class="fas fa-tags fa-2x text-gray-300"></i>-->
                    <i class="fas fa-2x fa-message text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Total tag -->
  <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                          Tag</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="badge badge-secondary badge-counter">{{ $tag }} </span></div>
                  </div>
                  <div class="col-auto">
                      <!--<i class="fas fa-tags fa-2x text-gray-300"></i>-->
                      <i class="fas fa-2x fa-hashtag text-gray-300"></i>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Total subscriber -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Subscriber</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="badge badge-warning badge-counter">{{ $subs }} </span></div>
                </div>
                <div class="col-auto">
                    <!--<i class="fas fa-tags fa-2x text-gray-300"></i>-->
                    <i class="fas fa-2x fa-users text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
  @endcan


 <!-- Total Views -->
 <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Total Tulisan Dilihat</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="badge badge-info badge-counter">{{ $sum_views }} </span></div>
                </div>
                <div class="col-auto">
                    <!--<i class="fas fa-tags fa-2x text-gray-300"></i>-->
                    <i class="fas fa-2x fa-eye text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jumlah postingan user -->
 
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Tulisan Saya</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="badge badge-primary badge-counter">{{ $post }} </span></div>
                </div>
                <div class="col-auto">
                    
                    <i class="fas fa-2x fa-file-alt text-gray-300"></i>
                   
                </div>
            </div>
        </div>
    </div>
</div>

</div>





<div class="col-xl-8 col-lg-2">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tulisan saya dengan view terbanyak</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">

            
@if($posts->count())
<div class="table-responsive">
    <table class="table table-borderless table-hover">
      <thead>
        <tr>
          <th scope="col" class="text-dark">#</th>
          <th scope="col" class="text-dark">Judul</th>
          <th scope="col" class="text-dark">Views</th>
          <th scope="col" class="text-dark">Created_at</th>
                   
        </tr>
      </thead>
      <tbody>
          @foreach($posts as $post)

          <tr>
            <td class="text-dark">{{ $loop->iteration }}</td>
            <td class="text-dark">{{ $post->title }}</td>
            <td class="text-dark"><small><i class="far fa-eye fa-sm"></i> {{ number_format( $post->total_views ) }} x</small></td>
            <td class="text-dark">{{ $post->created_at->diffForHumans() }}</td>     
          </tr>
          @endforeach
      </tbody>
    </table>
    @else

  <p class=" fs-5">Tidak ada Tulisan.. <img src="https://img.icons8.com/ios/50/000000/sad.png"/></p>
@endif








            <hr>
            <div class="mt-4 text-center small">
                <a href="/dashboard/posts">Semua Tulisan ></a>
            </div>
        </div>
    </div>
</div>
@endsection
