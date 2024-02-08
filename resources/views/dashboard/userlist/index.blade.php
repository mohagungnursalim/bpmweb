@extends('dashboard.layouts.main')

@section('container')

<title>Manajemen User | Dashboard</title>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-dark">Manajemen User</h1>
</div>
{{-- @if(session()->has('success'))
<div class="alert alert-success col-lg-6" role="alert">
  
  {{ session('success') }}
</div>
@endif --}}
<div class="col-lg-5">
    <form action="/dashboard/manajemen-user">
        <div class="input-group mb-3">
            <input type="text" value="{{ request('search') }}" class="form-control" placeholder="Search.."
                name="search">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search fa-sm"></i></button>
        </div>
    </form>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
    Tambah User
</button>
<a href="/dashboard/manajemen-user" class="btn btn-dark">🔄️Refresh</a>
@if($data->count())
<div class="table-responsive">
    <table class="table table-borderless table-hover table-sm">
        <thead>
            <tr>
                <th scope="col" class="text-dark">#</th>
                <th scope="col" class="text-dark">Image</th>
                <th scope="col" class="text-dark">Nama</th>
                <th scope="col" class="text-dark">Username</th>
                <th scope="col" class="text-dark">Email</th>
                <th scope="col" class="text-dark">Dibuat</th>
                <th scope="col" class="text-dark">Terakhir dilihat</th>
                <th scope="col" class="text-dark">Aktifitas</th>
                <th scope="col" class="text-dark">Status</th>
                <th scope="col" class="text-dark">Hak Akses</th>
                <th scope="col" class="text-dark">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $user)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img class="rounded" src="/uploads/avatars/{{ $user->avatar }}" style="" width="40%" />

                </td>

                <td class="text-dark">{{ $user->name }}</td>
                <td class="text-dark">{{ $user->username }}</td>
                <td class="text-dark">{{ $user->email }}</td>
                <td class="text-dark">{{ $user->created_at }}</td>
                <td> {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                <td><br>
                    @if ($user->is_banned == true)
                    <span class="badge badge-pill text-white" style="background: rgb(211, 74, 74)">Banned</span>
                    @else
                    @if(Cache::has('user-is-online-' . $user->id))

                    <span class="badge badge-pill text-white" style="background: rgb(74, 211, 74)">Online</span>
                    @else
                    <span class="badge badge-pill text-white" style="background: rgb(168, 175, 168)">Offline</span>
                    @endif
                    @endif
 
                </td>
                <td><br>

                    @if ($user->is_admin == true)
                    @if ($user->username == 'Moh.Agung')
                    <kbd class="">Super Admin</kbd>
                    @endif
                    <kbd class="text-warning">Moderator</kbd>
                    @else
                    <kbd class="text-info">Author</kbd>
                    @endif

                </td>
                <td><br>
                    <button type="button" class="btn btn-success border-0 text-white" data-toggle="modal"
                        data-target="#aksesModal{{$user->id}}">
                        Kelola
                    </button>
                </td>
                <td><br>
                   

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pengaturanModal{{$user->id}}">
                        Kelola
                      </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else

    <p class=" fs-5">No User Found.. <img src="https://img.icons8.com/ios/50/000000/sad.png" /></p>
    @endif

    <div class="d-flex justify-content-center">

        {{ $data->links() }}

    </div>
</div>
{{-- Auto close --}}
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 1500);

</script>


<!-- Modal Tambah User -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="tambahModal"><b>Tambah User</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{route('manajemen-user.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Masukan Email..">
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama..">
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Masukan Username">
                            @error('username')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Default:12345678"
                                disabled>
                        </div>

                        <label for="">Pilih Status</label><br>
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="">Moderator</label>
                            @php
                                for ($i = 1; $i <= 11; $i++) {
                                    echo "&nbsp;";
                                }
                            @endphp
                            <input class="form-check-input" type="radio" role="switch" value="1" name="is_admin">
                            <br>
                            <label class="form-check-label" for="">Author</label>
                            @php
                                for ($i = 1; $i <= 11; $i++) {
                                    echo "&nbsp;";
                                }
                            @endphp
                            <input class="form-check-input" type="radio" role="switch" value="0" name="is_admin">    
                          </div>
                        <br>
                        @error('is_admin')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                        
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Proses</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Hak Akses-->
@foreach ($data as $user)
<div class="modal fade" id="aksesModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel"><b>Hak Akses</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                  <h3>{{$user->name}}</h3>
                  <p>{{$user->email}}</p>
                  <p>Status sekarang: 
                    @if ($user->is_admin == true)
                    @if ($user->username == 'Moh.Agung')
                    <kbd>Super Admin</kbd>
                    @endif
                    <kbd>Moderator</kbd>
                    @else
                    <kbd>Author</kbd>
                    @endif</p>

                    <p>Atur Akses sebagai:</p>
                    <form action="{{route('manajemen-user.update',$user->id)}}" method="post">
                      @method('put')
                      @csrf
                      
                      <div class="form-check form-switch">
                        <label class="form-check-label" for="">Moderator</label>
                        @php
                            for ($i = 1; $i <= 11; $i++) {
                                echo "&nbsp;";
                            }
                        @endphp
                        <input class="form-check-input" type="radio" role="switch" value="1" name="is_admin" @if($user->is_admin == true) checked @else @endif>
                        <br>
                        <label class="form-check-label" for="">Author</label>
                        @php
                            for ($i = 1; $i <= 11; $i++) {
                                echo "&nbsp;";
                            }
                        @endphp
                        <input class="form-check-input" type="radio" role="switch" value="0" name="is_admin" @if($user->is_admin == false) checked @else @endif>    
                      </div>

                </div>
            </div>

            <div class="text-center mb-3">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($data as $user)
<!-- Modal Banned -->
<div class="modal fade" id="pengaturanModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ban atau Hapus User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-center">
                <h3>{{$user->name}}</h3>
                <p>{{$user->email}}</p>
    
                @if ($user->is_banned == true)
                <form action="{{route('unbanned',$user->id)}}" method="post" class="d-inline">
                    @method('put')
                    @csrf

                    <input type="hidden" value="0" name="is_banned">
                    <button class="btn btn-primary border-0 text-white"
                        onclick="return confirm('Dengan membuka banned akun User ini,maka user tersebut bisa Upload tulisan dan bisa Edit tulisan,Yakin??')">Buka Banned</button>
                </form>
                @else
                <form action="{{route('banned',$user->id)}}" method="post" class="d-inline">
                    @method('put')
                    @csrf

                    <input type="hidden" value="1" name="is_banned">
                    <button class="btn btn-danger border-0 text-white"
                        onclick="return confirm('Dengan membanned akun User ini,maka user tersebut tidak akan bisa lagi Upload tulisan dan tidak bisa Edit tulisan,Yakin??')">Banned</button>
                </form>
                @endif
                <form action="/dashboard/manajemen-user/{{ $user->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0 text-white"
                        onclick="return confirm('Yakin ingin menghapus User ini?')">Hapus</button>
                </form>
            </div>

        </div>
        

        <div class="text-center">
            <button type="button" class="btn btn-secondary mb-3 mt-5" data-dismiss="modal">Tutup</button>
        </div>
       
      </div>
    </div>
  </div>
@endforeach




@endsection

{{-- <form action="/dashboard/manajemen-user/{{ $user->id }}" method="post" class="d-inline">
@method('put')
@csrf
<input class="form-check-input" type="checkbox" value="1" name="is_admin">
<button class="badge badge-primary border-0" data-toggle="modal" data-target="#exampleModal">Atur</button>
</form> --}}

{{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

{{-- Set Alert 4 Second --}}
{{-- <script>
  $(document).ready(function() {
    // Find the alert element by its ID
    var alert = $('.alert');
    
    // Automatically close the alert after 4 seconds (4000 milliseconds)
    setTimeout(function() {
      alert.hide(); // Hide the alert
    }, 4000);
  });
</script> --}}
{{-- Open Modal When Any Error --}}
@if($errors->any())
<script>
    // jQuery Code
    $(document).ready(function () {
       
        $('#tambahModal').modal('show');
      
    });

</script>
@endif