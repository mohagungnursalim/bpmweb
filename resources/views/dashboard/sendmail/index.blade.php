@extends('dashboard.layouts.main')

@section('container')

<head>
    <title>{{ $title }}</title>
    <style type="text/css">
        .preloader {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background-color: rgba(255, 255, 255, 0.514);
        }
        .preloader .loading {
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%,-50%);
          font: 14px arial;
        }
        </style>

   
</head>



@if (Session::has('message'))
<div class="alert alert-success" role="alert">
    {{ Session::get('message')}}
</div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 ">
    <h1 class="h4 text-dark">Balas Pesan Masuk</h1>
</div>
<body>
{{-- preloader --}}


<form action="{{ route('send.email') }}" id="mail" method="post">

    @csrf
    {{-- <div class="col-md-12">
        <div class="md-form mb-4">

            <input type="text" id="name" name="name" class="form-control" placeholder="Masukan name.." required>
            @error('name')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div> --}}
    <div class="col-md-12">
        <div class="md-form mb-4">
            <select name="name" class="form-control">
                <option selected>----Nama Kontak----</option>
                @foreach ($pesans as $pesan)
                    <option value="{{ $pesan->nama}}">{{ $pesan->nama }}</option>
                @endforeach
            </select>
            @error('nama')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="md-form mb-4">
            <select name="email" class="form-control">
                <option selected>----Email Kontak----</option>
                @foreach ($pesans as $pesan)
                    <option value="{{ $pesan->email}}">{{ $pesan->email }}</option>
                @endforeach
            </select>
            @error('email')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="md-form mb-4">

            <input type="text" id="subyek" name="subyek" class="form-control" placeholder="Masukan subyek.." >
            @error('subyek')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="md-form mb-3">
            <textarea name="body" id="editor" required></textarea>
            @error('body')
            <span class="text-danger"> {{ $message }} </span>
            @enderror

        </div>
    </div>
    <div class="text-center">

        <button type="submit" class="btn btn-primary "><i class="fa fa-paper-plane fa-sm" aria-hidden="true"></i> Kirim</button>
        <div id="PleaseWait" style="display: none;"><div class="preloader"><div class="loading"><div class="spinner-border text-primary" role="status"></div><span class="visually-hidden text-dark"> Sending Message</span> </div></div></div>
    </div>
</form>

</body>


{{-- script Javascript --}}

{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>


{{-- loading before submit --}}
<script>
$('#mail').submit(function() {
    var pass = true;
    //some validations
    // $("#overlay").show();
    if(pass == false){
        return false;
    }
    $("#PleaseWait").show();

    return true;
});
</script>



<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

@push('script')
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 1500);

</script>

<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

</script>
<script>
    CKEDITOR.replace('editor');

</script>
@endpush

@endsection
