
@extends('layouts.main')

@section('container')

<head>
      @section('meta')
    <meta title="Tentang BPM | BPM FT-UNTAD">
    <meta name="description" content="Badan Pers Mahasiswa Fakultas Teknik Universitas Tadulako (BPM FT Untad) adalah organisasi mahasiswa yang bergerak di bidang jurnalistik. Organisasi ini bertujuan untuk meningkatkan keterampilan jurnalistik mahasiswa Fakultas Teknik Universitas Tadulako, serta untuk memberikan informasi dan edukasi kepada masyarakat luas.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @endsection
</head>

<div class="container">
  
    @foreach ($tentangs as $tentang)
    <div class="card">
      {!! $tentang->body !!}
    </div>
    @endforeach
</div>



@endsection

