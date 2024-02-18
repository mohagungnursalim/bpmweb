
@extends('layouts.main')

@section('container')

<head>
      @section('meta')
    <meta title="TheDevcode | Topik">
    <meta name="description" content="Temukan topik menarik seputar bahasa pemrograman,framework,dan masih banyak di TheDevcode.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @endsection
</head>
<div class="text-center mt-2">
    <h2>Topik</h2>
</div>
<div class="container">
  <div class="row">
      
      @foreach ($categories as $category)
      <div class="col-md-3 mb-3 mt-4 d-flex align-self-stretch ">
        <a href="/artikel?category={{ $category->slug }}" class="text-dark">
     <div class="card" style="width: 18rem; text-decoration-color: #fe9800;">
         @if ($category->image)
        <img src="{{ asset('storage/' .$category->image) }}" width="150px" height="135px" class="card-img-top" alt="{{ $category->name }}">
        @else
        @endif
        <div class="card-body">
        <u style="color: orange;">
          <h5 class="card-title">{{ $category->name }}</h5>
        </u> 
          
        
     </div>
     </div>
    </a>
     </div>
      @endforeach
      
      
      
    <!--@foreach ($categories as $category)-->
    <!--<div class="col-md-3 mb-3">-->
     
    <!--  <div class="card  text-white">-->
    <!--    <a href="/artikel?category={{ $category->slug }}">-->
          
    <!--    @if ($category->image)-->
    <!--    km<img src="{{ asset('storage/' .$category->image) }}" class="card-img" alt="{{ $category->name }}" height="210px">-->
    <!--    <div class="card-img-overlay">         -->
    <!--      <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0, 0,0,0.4)"><h5 class="card-title">{{ $category->name }}</h5> </div>-->
    <!--  @else -->
    <!--  <img src="https://source.unsplash.com/500x400?{{ $category->name }}" alt=" {{ $category->name }}" class="card-img-top">-->
    <!--  <div class="card-img-overlay">         -->
    <!--    <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0, 0,0,0.4)"><h5 class="card-title">{{ $category->name }}</h5> </div>-->
    <!--    @endif-->

    <!--    </div>-->
    <!--  </div>-->
    <!--</a>-->
    <!--</div>-->
    <!--@endforeach-->
  </div>
</div>


<div class="d-flex justify-content-center">

  {{ $categories->links() }}
</div>
@endsection

