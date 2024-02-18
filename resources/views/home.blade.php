@extends('layouts.main')

<head>
  @section('meta')
  <meta title="Home | BPM FT-UNTAD">
  <meta name="description" content="Kami adalah komunitas mahasiswa yang mendedikasikan diri untuk kreativitas. Melalui kata-kata, gambar, dan inspirasi, kami mewakili keberagaman dan semangat mahasiswa.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @endsection
 
</head>
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<section class="pt-7">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 text-md-start text-center py-6">
        <h1 class="mb-4 fs-9 fw-bold" style="color: rgb(31, 64, 124)">BPM FT-UNTAD</h1>
        <p class="mb-6 lead text-bold"><b>Badan Pers Mahasiswa Fakultas Teknik <br>Universitas Tadulako</b></p>
        <p class="mb-6 lead text-secondary">Inklusif,Efektif & Memberdayakan.</p>
        <div class="text-center text-md-start"><a class="btn btn-primary me-3 btn-lg" href="/artikel" role="button">Jelajahi </a></div>
      </div>
      <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid" src="{{asset('logo/logobpm2.png')}}" alt="" /></div>
    </div>
  </div>
</section>


<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-5 pt-md-9 mb-6" id="feature">

  <div class="bg-holder z-index--1 bottom-0 d-none d-lg-block" style="background-image:url(assets/img/category/shape.png);opacity:.5;">
  </div>
  <!--/.bg-holder-->

  <div class="container">
    <h1 class="fs-9 fw-bold mb-4 text-center"> Apa yang kami lakukan?</h1>
    <div class="row">
      <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{asset('galeri/almet.JPG')}}" width="130px" alt="Feature" />
        <h4 class="mb-3">Fokus pada Kreativitas</h4>
        <p class="mb-0 fw-medium text-secondary">"Kami adalah komunitas mahasiswa yang mendedikasikan diri untuk kreativitas. Melalui kata-kata, gambar, dan inspirasi, kami mewakili keberagaman dan semangat mahasiswa."</p>
      </div>
      <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{asset('galeri/liputan.JPG')}}" width="130px" alt="Feature" />
        <h4 class="mb-3">Jurnalistik Mahasiswa</h4>
        <p class="mb-0 fw-medium text-secondary">"Sebagai jurnalis mahasiswa, kami adalah pengawas, penyampai cerita, dan pembawa perubahan. Setiap kata yang kami tulis memiliki tujuan: menginspirasi dan menginformasikan."</p>
      </div>
      <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{asset('galeri/konten.png')}}" width="130px" alt="Feature" />
        <h4 class="mb-3">Berbagi Cerita Mahasiswa</h4>
        <p class="mb-0 fw-medium text-secondary">"Kami adalah penjaga kisah-kisah mahasiswa. Dari tantangan hingga keberhasilan, kami mengabadikan setiap momen. Bersama-sama, kita mewujudkan keberagaman dan kekuatan mahasiswa."</p>
      </div>
      <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{asset('galeri/salena.png')}}" width="130px" alt="Feature" />
        <h4 class="mb-3">Misi Informasi</h4>
        <p class="mb-0 fw-medium text-secondary">"Kami adalah para pemberi informasi. Dengan dedikasi, kami mencari kebenaran, memberikan pandangan, dan menyuarakan pikiran mahasiswa. Mari bersama-sama menyebarkan suara generasi ini."</p>
      </div>
    </div>

  </div><!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->





<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="py-md-11 py-8" id="superhero">

  <div class="bg-holder z-index--1 bottom-0 d-none d-lg-block background-position-top" style="background-image:url(assets/img/superhero/oval.png);opacity:.5; background-position: top !important ;">
  </div>
  <!--/.bg-holder-->

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 text-center">
        <h1 class="fw-bold mb-4 fs-7">Event terbaru</h1>

      </div>
    </div>
  </div><!-- end of .container-->

  <div class="container">
  
    @foreach ($events as $event)
    <div class="card">
        <a href="/event/{{$event->slug}}">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">#{{$loop->iteration}} {{ $event->nama }}</li>
            
          </ul>
        </div>
        </a>
      
    </div>
    @endforeach
</div>


</section>
<!-- <section> close ============================-->
<!-- ============================================-->




<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-5" id="marketing">

  <div class="container">
    <h1 class="fw-bold fs-6 mb-3">Artikel Populer</h1>
    
    <div class="row">
      @foreach ($posts as $post)
      <div class="col-md-4 mb-3 d-flex align-self-stretch">
        <a href="/artikel/{{$post->slug}}" class="text-decoration-none">
              <div class="card">
                  @if ($post->image)
                  <img src="{{ asset('storage/' . $post->image) }}" width="700px" height="220px" alt="{{ $post->title }}" class="card-img">
                  @endif
                  <div class="card-body">
                      <p class="card-text">
                          <small class="text-muted">
                              {{ Carbon\Carbon::parse($post->published_at)->format('d M, Y') }}
                          </small>
                      </p>
                      <h5 class="card-title">{{ $post->title }}</h5>
                      
                  </div>
              </div>
            </a>
      </div>
      @endforeach
  </div>
  </div><!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->









