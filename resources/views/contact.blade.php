@extends('layouts.main')

@section('container')
<head>
    @section('meta')
    <meta title="TheDevcode | Kontak kami">
    <meta name="description" content="Apakah Anda memiliki pertanyaan? Jangan ragu untuk menghubungi kami secara langsung. Tim kami akan membantu anda dengan segera.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @endsection
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
<!--Section: Contact v.2-->
<section class="">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center">Kontak</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto " style="color: rgb(80, 79, 79)">Apakah Anda memiliki pertanyaan atau ingin menjalin kerja sama? Jangan ragu untuk menghubungi kami secara langsung.</p>

    <div class="row">
        
        <!--Grid column-->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="/kontak" method="post" id="kontak">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan nama..">
                            @error('nama')
                            <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukan email..">
                            @error('email')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subyek" class="form-label">Subyek</label>
                            <input type="text" name="subyek" class="form-control" id="subyek" placeholder="Masukan subyek..">
                            @error('subyek')
                            <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Isi Pesan</label>
                            <textarea type="text" id="body" name="body" rows="3" class="form-control" placeholder="Masukan pesan.."></textarea>
                            @error('body')
                            <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div id="PleaseWait" style="display: none;">
                            <div class="preloader">
                                <div class="loading">
                                    <div class="spinner-border text-primary" role="status">
                                    </div>
                                    <span class="visually-hidden text-dark"> <a class="text-dark">Sending Message</a> </span> 
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Grid column-->


    </div>

    {{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>


{{-- loading before submit --}}
<script>
$('#kontak').submit(function() {
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
</section>
<!--Section: Contact v.2-->
@endsection