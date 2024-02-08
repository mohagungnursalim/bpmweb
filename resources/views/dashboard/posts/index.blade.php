@extends('dashboard.layouts.main')

@section('container')
<title>Tulisan | Dashboard</title>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<style>

</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    @if (Auth::user()->is_admin == true)
    <h1 class="h2 text-dark">Review Tulisan</h1>
    @else
    <h1 class="h2 text-dark">Tulisan Saya ✍️</h1>
    @endif

</div>


<div class="col-lg-5">
    <form action="/dashboard/posts">
        <div class="input-group mb-3">
            <input type="text" value="{{ request('search') }}" class="form-control" placeholder="Search.."
                name="search">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search fa-sm"></i></button>
        </div>
    </form>
</div>
@if (Auth::user()->is_banned == true)
    <a data-toggle="modal" data-target="#banModal" class="btn mb-3" style="background-color: rgb(143, 97, 218); color:white;"><i
        class="fas fa-pencil fa-sm"></i> Mulai Menulis</a>
@else
<a href="/dashboard/posts/create" class="btn mb-3" style="background-color: rgb(143, 97, 218); color:white;"><i
    class="fas fa-pencil fa-sm"></i> Mulai Menulis</a>
@endif
<a href="/dashboard/posts" class="btn btn-dark mb-3">🔄️Refresh</a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#requestModal">
    Request Sitemap
</button>
  
@if (session('message'))
    <div class="alert alert-success" id="messageAlert">
        {{ session('message') }}
    </div>
    <script>
        // Menghilangkan pesan setelah 2 detik
        setTimeout(function() {
            document.getElementById('messageAlert').style.display = 'none';
        }, 1500);
    </script>
@endif


{{-- @if (request('search'))
<br>
Anda mencari <kbd style="background-color: rgba(134, 160, 134, 0.808)"> "{{ request('search') }}"</kbd>

@endif --}}




@if($posts->count())
<div class="table-responsive">
    <table class="table table-borderless table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-dark">#</th>
                <th scope="col" class="text-dark">Thumbnail</th>
                <th scope="col" class="text-dark">Judul</th>
                @if(Auth::user()->is_admin == true)
                <th scope="col" class="text-dark">Author</th>
                @endif
                <th scope="col" class="text-dark">Dilihat</th>
                <th scope="col" class="text-dark">Dibuat</th>
                <th scope="col" class="text-dark">Dipublish</th>
                <th scope="col" class="text-dark">Moderasi</th>
                <th scope="col" class="text-dark">Status</th>
                <th scope="col" class="text-dark">Kategori</th>
                <th scope="col" class="text-dark">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)

            <tr>
                <td class="text-dark">{{ $loop->iteration }}</td>
                <td class="text-dark">
                    <div class="img-container">
                        {{-- @if ($post->image)  --}}
                        <img src="{{ asset('storage/' .$post->image) }}" alt="{{ $post->title }}" width="50px">
                        {{-- @else
                <img src="https://source.unsplash.com/640x200?{{ $post->category->name }}" width="50%"> --}}
                        {{-- @endif    --}}
                    </div>

                </td>
                <td class="text-dark">{{ $post->title }}</td>
                @if(Auth::user()->is_admin == true)
                <td class="text-dark"><small>{{ $post->author->name }}</small></td>
                @endif

                <td class="text-dark"><small><i class="far fa-eye fa-sm"></i> {{ number_format( $post->total_views ) }}
                        x</small></td>
                <td class="text-dark">

                    <small class="text-muted"><i class="far fa-clock fa-sm"></i>
                        {{ Carbon\Carbon::parse($post->created_at)->format('d M,Y') }}
                    </small>

                </td>
                <td class="text-dark">
                    @if (isset($post->is_published))
                    <small class="text-muted"><i class="far fa-calendar fa-sm"></i>
                        {{ Carbon\Carbon::parse($post->published_at)->format('d M,Y') }}
                    </small>
                    @else
                    {{-- <small>No publishing</small> --}}

                    <button type="button" class="btn btn-primary" style="border-radius:23px;" data-toggle="modal"
                        data-target="#exampleModal{{ $post->id }}">
                        <i class="fa fa-upload" aria- hidden="true"></i> Publish
                    </button>
                    @endif

                </td>
                <td>
                    @if (isset($post->moderasi))
                    <!-- Button trigger modal -->
                    @if ($post->moderasi == 'Tolak')
                    <button type="button" id="notificationButton" class="btn btn-danger position-relative"
                        data-toggle="modal" data-target="#staticBackdrop{{$post->id}}">
                        Ditolak!!
                        @can('admin')
                        @if (isset($post->is_change))
                        <span id="notificationCount"
                            class="badge bg-secondary position-absolute top-0 start-100 translate-middle">
                            !!
                        </span>
                        @endif
                        @endcan
                    </button>
                    @elseif($post->moderasi == 'Setujui')
                    <span class="badge badge-pill bg-success text-white">Disetujui</span>
                    @elseif($post->moderasi == 'Perbaiki')
                    <button type="button" id="notificationButton" class="btn btn-warning position-relative"
                        data-toggle="modal" data-target="#staticBackdrop{{$post->id}}">
                        Perbaiki!
                        @can('admin')
                        @if (isset($post->is_change))
                        <span id="notificationCount"
                            class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                            !!
                        </span>
                        @endif
                        @endcan

                    </button>

                    @endif
                    @else
                    @can('admin')
                    <button type="button" class="btn btn-primary" style="border-radius:23px;" data-toggle="modal"
                        data-target="#staticBackdrop{{$post->id}}">
                        Lihat
                    </button>
                    @endcan
                    <span class="badge badge-pill bg-secondary text-white">Pending</span>
                    @endif


                </td>
                <td class="text-dark">
                    @if (isset($post->is_published))
                    <span class="badge badge-pill bg-success text-white">Dipublish</span>

                    @else
                    <span class="badge badge-pill bg-secondary text-white">Draft</span>
                    @endif
                </td>
                <td class="text-dark">
                    @foreach ( ($post->getCategories($post->category_id)) as $category )
                    <span class="badge badge-pill text-white"
                        style="background-color: {{ $category->color }}">{{ $category->name }}</span>
                    @endforeach
                </td>
                {{-- <td>{{ dd(array_map('intval', explode(',', $post->category_id)))  }}</td> --}}
                <td>
                    @if (Auth::user()->is_banned == true )

                    @else
                        @if ($post->moderasi == 'Perbaiki' || $post->moderasi == 'Tolak')

                        @else
                        @if (Auth::user()->id !== $post->user_id)

                        @else
                        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning text-white text-decoration-none">Edit</a>


                        <form action="/dashboard/posts/{{ $post->slug }}" method="post">
                            @method('delete')
                            @csrf

                            <button class="badge bg-danger border-0 text-white"
                                onclick="return confirm('Yakin ingin menghapus Tulisan pini?')">Delete</button>
                        </form>
                        @endif
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else

    <p class=" fs-5">Tulisan tidak ditemukan.. <img src="https://img.icons8.com/ios/50/000000/sad.png" /></p>
    @endif

    <div class="d-flex justify-content-center">

        {{ $posts->links() }}

    </div>
</div>





{{-- Modal --}}


<!-- Modal Info Banned -->
<div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>Akun anda telah di Banned karena telah melanggar,hubungi Admin jika ada kekeliruan dalam hal ini!</h4>
        </div>
            <div class="text-center">
                <button type="button" class="btn btn-secondary mb-4" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
  </div>
<!-- Modal moderasi -->
@foreach ($posts as $post)
<div class="modal fade" id="staticBackdrop{{$post->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel"><b>Moderasi Tulisan</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @if (isset($post->moderasi))

                <p>Status: <a
                        class="@if($post->moderasi == 'Perbaiki') text-warning  @else text-danger @endif text-decoration-none">{{$post->moderasi}}</a>
                </p>
                <p>Catatan:<a class="text-danger text-decoration-none">*{{$post->notes}}</a> </p>
                @endif

                <div class="text-center">
                    @if (Auth::user()->id !== $post->user_id)

                    @else
                    @if ($post->moderasi == 'Perbaiki' || $post->moderasi == 'Tolak')
                    <div class="d-flex justify-content-center mb-2">
                        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mr-2">Edit Tulisan</a>

                        <form action="/dashboard/posts/{{ $post->slug }}" method="post">
                            @method('delete')
                            @csrf

                            <button class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus Post ini?')">Hapus Tulisan</button>
                        </form>
                    </div>
                    @else

                    @endif
                    @endif

                </div>
                <div class="card">
                    <div class="col text-center">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 30rem"
                            class="card-img-top">
                    </div>
                    <div class="card-body">
                        <h2 class="card-title text-dark"> <b>{{$post->title}}</b> </h2>
                        <p class="card-text">
                            {!! $post->body !!}
                        </p>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>


                @can('admin')
                <form action="{{route('moderasi',$post->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="text-center">
                        <input type="radio" name="moderasi" value="Tolak" class="tolak" uncheck>
                        <label for="">Tolak</label>

                        <input type="radio" name="moderasi" value="Setujui" class="setujui" uncheck>
                        <label for="">Setujui</label>

                        <input type="radio" name="moderasi" value="Perbaiki" class="perbaiki" uncheck>
                        <label for="">Perbaiki</label>

                    </div>


                    <!-- Textarea catatan perbaikan -->
                    <textarea class="form-control catatan mb-3" rows="5" placeholder="Masukan Catatan.." name="notes"
                        style="display: none;"></textarea>


                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </form>
                @endcan

            </div>

        </div>
    </div>
</div>

@endforeach
{{-- Catatan Perbaikan --}}
<script>
    $(document).ready(function () {
        // Mendapatkan elemen radio button
        var radioPerbaiki = $(".perbaiki");

        // Memunculkan elemen textarea saat radio button diklik
        radioPerbaiki.on("change", function () {
            var value = $(this).val();
            if (value === "Perbaiki") {
                $(".catatan").show();
            } else {
                $(".catatan").hide();
            }
        });
    });

</script>

{{-- Setujui --}}
<script>
    $(document).ready(function () {
        // Mendapatkan elemen radio button
        var radioSetujui = $(".setujui");

        // Memunculkan elemen textarea saat radio button diklik
        radioSetujui.on("change", function () {
            var value = $(this).val();
            if (value === "Setujui") {
                $(".catatan").hide();
            }
        });
    });

</script>

{{-- Catatan Ditolak --}}
<script>
    $(document).ready(function () {
        // Mendapatkan elemen radio button
        var radioTolak = $(".tolak");

        // Memunculkan elemen textarea saat radio button diklik
        radioTolak.on("change", function () {
            var value = $(this).val();
            if (value === "Tolak") {
                $(".catatan").show();
            } else {
                $(".catatan").hide();
            }
        });
    });

</script>
{{-- End Moderasi --}}

<!-- Modal Publish -->
@foreach ($posts as $post )

<div class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Publish <br><span
                        class="bg-secondary text-white">{{ $post->title }}</span></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('published',$post->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="is_published" value="1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Tanggal Terbit</span>
                        </div>
                        <input type="date" class="form-control" aria-label="Sizing example input" name="published_at"
                            aria-describedby="inputGroup-sizing-default">

                        @error('pubished_at')
                        <p class="text-danger"> {{ $message }}</p>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn"
                    style="background-color: rgb(143, 97, 218); color:white;">Proses</button>
            </div>
            </form>
        </div>
    </div>
</div>


 <!-- Modal Request Sitemap-->
 <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Request Sitemap</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Sitemap adalah ‘map’ atau peta yang menjabarkan setiap halaman di website Anda. Peta ini bukanlah sekedar elemen navigasi yang ditampilkan di bawah bagian header. Sitemap dibuat dalam format XML (Extensible Markup Language) dan digunakan oleh AI untuk mempermudah indexing website.
            <br><br>
            Mesin pencari seperti Google menggunakan sitemap XML untuk menyimpan halaman web secara lebih efisien, sehingga memberikan hasil yang lebih baik bagi pengguna saat menelusuri istilah terkait.
        </div>
        <form method="get" action="/sitemap">
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary">Proses</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div>
  </div>


 
@endforeach

@endsection


