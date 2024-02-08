@extends('layouts.main')

@section('container')

<head>
    @section('meta')
    <meta title="Artikel | BPM FT-UNTAD">
    <meta name="description"
        content="Kami adalah komunitas mahasiswa yang mendedikasikan diri untuk kreativitas. Melalui kata-kata, gambar, dan inspirasi, kami mewakili keberagaman dan semangat mahasiswa.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @endsection
</head>

<style>
    .card {
        border-radius: 25px;

    }

</style>
<h2 class="mb-2 mt-3 text-center">{{ $title }} </h2>
<div class="text-center">
    <form action="/artikel"
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    
    <div class="input-group">
        <input type="text" value="{{ request('search') }}" name="search"
            class="form-control bg-light border-0 small" placeholder="Cari Artikel.." aria-label="Search"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn" style="background-color: rgb(31, 64, 124); color:white;" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>
    @if (request('search'))
    <br>
    Anda mencari <kbd class="text-white" style="background-color: rgb(31, 64, 124)">
        "{{ request('search') }}"</kbd>

    @endif
</div>



</div>

@if ($posts->count(0))


<div class="container">

    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-3 mt-4 d-flex align-self-stretch">
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

    <div>
        
    </div>

</div>
{{-- ------ --}}

@else

<p class="text-center fs-4">Tidak ada hasil. <img src="https://img.icons8.com/ios/50/000000/sad.png" /></p>
@endif
<div class="d-flex justify-content-center">

    {{ $posts->links() }}
</div>
<div>

</div>
@endsection

{{-- <a href="/artikel/{{ $post->slug }}">

@if ($post->image)
<div style="overflow:hidden;  border-radius:24px;">
    <img src="{{ asset('storage/' .$post->image) }}" alt="{{ $post->title }}"
        class="img-fluid rounded  mx-auto d-block">
</div>
<div class="text-center">
    <small><a class="text-secondary text-decoration-none"><i class="far fa-calendar fa-sm"></i>
            {{ Carbon\Carbon::parse($post->published_at)->format('d M,Y') }} &nbsp; <i class="far fa-eye fa-sm"></i>
            {{ number_format( $post->total_views ) }} x
        </a></small>
</div>
@endif
</a>

<div class="card-body p-3">
    <h5 class="card-title"><a href="/artikel/{{ $post->slug }}" class="text-black text-decoration-none">
            {{ $post->title }} </a> </h5>
    <p>
        <small class="text-muted">
            <img class="rounded-circle" alt="{{ $post->author->name }}"
                src="/uploads/avatars/{{ $post->author->avatar }}" width="30px" height="30px"> <a
                href="/artikel?author={{ $post->author->username }}"
                class="text-decoration-none text-danger">{{ $post->author->username }}
        </small>
    </p>

    @foreach ( ($post->getCategories($post->category_id)) as $category )
    <a class="badge badge-pill text-decoration-none" style="background-color:{{ $category->color }}"
        href="/artikel?category={{ $category->slug }}">{{ $category->name }} </a>
    @endforeach


</div> --}}
