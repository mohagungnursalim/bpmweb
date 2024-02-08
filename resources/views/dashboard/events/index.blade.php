@extends('dashboard.layouts.main')

@section('container')

<title>Event | Dashboard</title>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-dark">Manajemen Event <i class="fas fa-fw fa-calendar"></i></h1>
</div>
{{-- @if(session()->has('success'))
<div class="alert alert-success col-lg-6" role="alert">
  
  {{ session('success') }}
</div>
@endif --}}
<div class="col-lg-5">
    <form action="/dashboard/manajemen-event">
        <div class="input-group mb-3">
            <input type="text" value="{{ request('search') }}" class="form-control" placeholder="Search.."
                name="search">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search fa-sm"></i></button>
        </div>
    </form>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn text-white" style="background-color: rgb(27, 145, 106)" data-toggle="modal" data-target="#tambahModal">
    Tambah Event
</button>
<a href="/dashboard/manajemen-event" class="btn btn-dark">🔄️Refresh</a>
@if($data->count())
<div class="table-responsive">
    <table class="table table-borderless table-hover table-sm">
        <thead>
            <tr>
                <th scope="col" class="text-dark">#</th>
                <th scope="col" class="text-dark">Nama</th>
                <th scope="col" class="text-dark">Tanggal Mulai</th>
                <th scope="col" class="text-dark">Link</th>
                <th scope="col" class="text-dark">Dibuat</th>
                <th scope="col" class="text-dark">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $event)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-dark">{{ $event->nama }}</td>
                <td class="text-dark">{{ $event->tanggal_mulai->format('d-m-Y') }}</td>
                <td class="text-dark">{{ $event->link }}</td>
                <td class="text-dark">{{ $event->created_at }}</td>
                <td><br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pengaturanModal{{$event->id}}">
                        Kelola
                    </button>
                </td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
    @else

    <p class=" fs-5">Event tidak ditemukan.. <img src="https://img.icons8.com/ios/50/000000/sad.png" /></p>
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


<!-- Modal Tambah event -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="tambahModal"><b>Tambah Event</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{route('manajemen-event.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Event</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Event..">
                            @error('nama')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deskripsi</label>
                            <textarea name="deskripsi" id="editor" class="form-control" placeholder="Deskripsi Event.." cols="30" rows="10"></textarea>
                            @error('deskripsi')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai">
                            @error('tanggal_mulai')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Link Event</label>
                            <input type="text" class="form-control" name="link" placeholder="Masukan Link Event..">
                            @error('link')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


@foreach ($data as $event)
<!-- Modal Kelola Event -->
<div class="modal fade" id="pengaturanModal{{$event->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kelola Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-center">
                <h3>{{$event->nama}}</h3>
    
                
                <form action="/dashboard/manajemen-event/{{ $event->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0 text-white"
                        onclick="return confirm('Yakin ingin menghapus event ini?')">Hapus</button>
                </form>
                
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{$event->id}}">
                    Edit
                </button>
            </div>

        </div>
        

        <div class="text-center">
            <button type="button" class="btn btn-secondary mb-3 mt-5" data-dismiss="modal">Tutup</button>
        </div>
       
      </div>
    </div>
  </div>
@endforeach

       
 
{{-- Modal Edit --}}
@foreach ($data as $event)
<div class="modal fade" id="editModal{{$event->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="{{route('manajemen-event.update',$event->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" value="{{$event->nama}}">
                        @error('nama')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"></label>
                        <textarea name="deskripsi" id="editoredit" class="form-control" placeholder="Masukan Deskripsi.." cols="30" rows="10">{{$event->deskripsi}}</textarea>
                        @error('deskripsi')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Mulai</label>
                        <input type="date" class="form-control" value="{{ old('tanggal_mulai',$event->tanggal_mulai->format('Y-m-d')) }}" name="tanggal_mulai">
                        @error('tanggal_mulai')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="link" value="{{ old('link',$event->link) }}" placeholder="Masukan Link Event..">
                        @error('link')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

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

{{-- image preview --}}
<script>
    function previewImage() {

        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();

        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {

            imgPreview.src = oFREvent.target.result;

        }
    }
</script>

{{-- Editor edit --}}
@push('script')
  <script type="text/javascript" src="{{ asset('select/js/bootstrap-select.min.js') }}"></script>
  

  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
   

  <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
  <script>
      CKEDITOR.replace('editoredit',options);
      </script>
@endpush
{{-- Editor Add  --}}
@push('script')
  <script type="text/javascript" src="{{ asset('select/js/bootstrap-select.min.js') }}"></script>
  

  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
   

  <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
  <script>
      CKEDITOR.replace('editor',options);
      </script>
@endpush