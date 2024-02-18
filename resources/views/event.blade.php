
@extends('layouts.main')

@section('container')

<head>
      @section('meta')
    <meta title="Event | BPM FT-UNTAD">
    <meta name="description" content="Badan Pers Mahasiswa Fakultas Teknik Universitas Tadulako,Inklusif,Efektif & Memberdayakan..">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @endsection
</head>
<div class="text-center mt-2">
    <h2>Event</h2>
</div>
<div class="container">
  
  @foreach ($events as $event)
  <div class="card">
      <a href="/event/{{$event->slug}}" style="text-decoration-color: #fe9800;">
          <div class="card-body">
              <ul class="list-group list-group-flush" style="color: #fe9800;">
                  <li class="list-group-item">#{{ $event->nama }}</li>
              </ul>
          </div>
      </a>
  </div>
  @endforeach
  
</div>


<div class="d-flex justify-content-center">

  {{ $events->links() }}
</div>
@endsection

