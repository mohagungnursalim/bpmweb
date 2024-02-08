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
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Kontak</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-3" style="color: rgb(80, 79, 79)">Apakah Anda memiliki pertanyaan atau ingin menjalin kerja sama? Jangan ragu untuk menghubungi kami secara langsung.</p>

    <div class="row">
        
        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5 ml-3 d-flex justify-content-center">
            {{-- @if (session()->has('message'))

            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
                
            @endif --}}

            <form action="/kontak" method="post" id="kontak" >
                @csrf
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            {{-- <label for="name" class="">Your name</label> --}}
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukan nama.." >
                            @error('nama')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-4">
                            {{-- <label for="email" class="">Your email</label> --}}
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan email.." >
                            @error('email')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <!--Grid column-->
                
                        <div class="col">
                            <div class="md-form mb-0">
                                <label for="">Subyek</label>
                                <input type="text"  name="subyek" class="form-control" placeholder="Masukan subyek.." >
                                @error('subyek')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    
                    
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <br>
                            <label for="">Isi Pesan</label>
                            <textarea type="text" id="body" name="body" rows="3"  class="form-control md-textarea" placeholder="Masukan pesan.."></textarea>
                            @error('body')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                    </div>
                </div>
                <!--Grid row-->
                <div class="text-center">
                    <br>
                    <button type="submit" class="btn btn-primary ">Kirim</button>
                    <div id="PleaseWait" style="display: none;"><div class="preloader"><div class="loading"><div class="spinner-border text-primary" role="status"></div><span class="visually-hidden text-dark"> <a class="text-dark">Sending Message</a> </span> </div></div></div>
                </div>                  
            </form>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x" style="color: rgb(121, 119, 119)"></i>
                    <p style="color: rgb(80, 79, 79)">Kampus Bumi Tadulako, Jalan Soekarno Hatta KM 9, Palu, Sulawesi. Tengah, 94119.</p>
                </li>

                {{-- <li><i class="fas fa-phone mt-4 fa-2x" style="color: rgb(121, 119, 119)"></i>
                    <p style="color: rgb(80, 79, 79)">+ 62 8575 7063 915</p>
                </li> --}}

                <li><i class="fas fa-envelope mt-4 fa-2x" style="color: rgb(121, 119, 119)"></i>
                    <p style="color: rgb(80, 79, 79)">bpmftuntad@gmail.com</p>
                </li>
            </ul>
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