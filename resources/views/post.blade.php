@extends('layouts.main')

@section('container')

<head>

    {{-- Meta For SEO --}}
    @section('meta')

    <meta title="{{ $post->title }}">
    <meta content="{{ $post->description }}" name="description">
    <meta name="keyword" content="
    @foreach ( ($post->getTags($post->tag_id)) as $tag ) 
        {{ $tag->name }}
    @endforeach  
            ">
    @endsection
    @section('style')
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}">
    @endsection
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="container">
    <!-- sebelumnya g-5 -->
    <div class="row mb-5">
        <div class="col-md-8">
            {{-- <nav aria-label="">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-secondary"
                            href="/"><small>Home</small></a></li>
                    <li class="breadcrumb-item active"><a href="/blog"
                            class="text-decoration-none text-secondary"><small> Blog ></small></a></li>

                </ol>

            </nav> --}}
            <p class="h2 mb-3 mt-3 bold">{{ $title }}</p>
            <img class="rounded-circle" src="/uploads/avatars/{{ $post->author->avatar }}"
                alt="{{ $post->author->name }}" width="24px" height="24px"> <a
                href="/blog?author={{ $post->author->username }}" class="text-decoration-none text-danger">
                {{ $post->author->username }}</a>
            {{-- badge admin and non admin --}}
            {{-- @if($post->author->is_admin == 1)
            <img alt="verified badge" src="https://img.icons8.com/color/18/000000/verified-badge.png" width="18px"
                height="18px" alt="Admin Verified Badge">
            @else
            <img src="https://img.icons8.com/fluency/18/000000/verified-account.png" width="18px" height="18px"
                alt="Author Verified Badge">
            @endif --}}
            &nbsp; <small class="text-muted"><i class="far fa-calendar fa-sm"></i> {{ Carbon\Carbon::parse($post->published_at)->format('d M,Y') }} &nbsp; <i class="far fa-eye fa-sm"></i> {{ number_format( $post->total_views ) }} x</small>
            <article class="my-3 fs-6">
                @if ($post->image)
                <div style="overflow:hidden; ">
                    <img width="720px" height="45px" src="{{ asset('storage/' .$post->image) }}"  class="img-fluid"
                        alt=" {{ $post->title }} " id="gambar">
                        <small><p class="text-secondary" style="font-size: 11pt">{{$post->image_description}}</p></small>
                </div>

                @endif

                <br>
                <div class="bg-light mb-3" style="display: flex; gap:10px">
                    <h6 class="text-muted">Share:</h6>
                    <a href="whatsapp://send?text=https://www.the-devcode.com/blog/{{ $post->slug }}"
                        title="Share this post on Whatsapp">
                        <img src="https://img.icons8.com/color/30/000000/whatsapp--v4.png" height="26px" width="26px"
                            alt="Share to Whatsapp" />
                    </a>
                    <a style="float: left" class="twitter"
                        href="https://twitter.com/share?text={{ $post->slug }}&url=https://www.the-devcode.com/blog/{{ $post->slug }}"
                        alt="Share to Twitter" title="Share this post on Twitter" target="_blank">
                        <img src="https://img.icons8.com/color/30/000000/twitter.png" height="26px" width="26px"
                            alt="Share to Twitter" />
                    </a>
                </div>

                {{-- post body (content) --}}
                <span style="font-size: 14pt" class="text-secondary">
                    {!! $post->body !!}
                </span>

                <center>
                    <br>
                    @isset($post->author->trakteer)
                    <a class="btn btn-success" href="{{ $post->author->trakteer }}"><img alt="trakteer"
                            src="https://img.icons8.com/external-bearicons-outline-color-bearicons/34/000000/external-Rupiah-indonesia-bearicons-outline-color-bearicons.png"
                            width="30px" height="30px" /> Dukung Kami</a>
                    @endisset
                </center>
                </nav>
                
                <h5 class="fst-italic">Tags</h5>
                @foreach ( ($post->getTags($post->tag_id)) as $tag )
                <a href="/blog?tag={{ $tag->slug }}" class="badge bg-dark mb-4"><span class="text-white"> <small><i
                                class="fa fa-hashtag"></i></small>{{ $tag->name }} </span></a>
                @endforeach

                <div class="d-flex justify-content-center">
                    
                 
     
                    <form class="row g-3" action="{{ route('subscriberpost') }}" method="post">
                      @csrf
                      
                      @error('email')

                      <a href="#" class="text-danger"> {{ $message }}</a> <br> 
  
                      @enderror
                      <div class="col-auto">
                         
                        <input type="text" name="email" class="form-control" placeholder="emailmu@gmail.com">
                      </div>
                      <div class="col-auto">
                        <button type="submit" class="btn btn-danger mb-4">Subscribe</button>
                      </div>
                    </form>
                  
              </div>

              <div class="container">
                <div class="row">
    
                    
                    <div class="card">
    
                        <a href="/artikel?author={{ $post->author->username }}" class="text-decoration-none text-danger">
                            <p class="text-secondary">Penulis</p>
                            <p style="text-align:justify;"><img class="rounded-circle"
                                    src="/uploads/avatars/{{ $post->author->avatar }}" alt="{{ $post->author->name }}"
                                    style="float:left; margin:0 9px 3px 0;" width="18%" height="18%" />
                                <h4>{{ $post->author->username }} </h4>
                                <p class="text-muted"> "{{ $post->author->bio }}" </p>
                            </p>
    
                            <div class="container">
                                <div class="bg-light" style="display: flex; gap:10px">
    
                                    @isset($post->author->instagram)
                                    <a class="text-decoration-none text-dark"
                                        href="https://www.instagram.com/{{ $post->author->instagram }}/"><i
                                            class="bi bi-instagram " style="float: left"></i></a>
                                    @endisset
    
    
                                    @isset($post->author->twitter)
                                    <a class="text-decoration-none text-dark"
                                        href="https://twitter.com/{{ $post->author->twitter }}"> <i class="bi bi-twitter "
                                            style="float: left"></i></a>
                                    @endisset
    
                                </div>
                            </div>
    
                        </a>
                    </div>
                 </div>
            </div>

            <h5 class="text-muted mt-4">Komentar</h5>
            <hr>
            </script>
            <a href="#" class="ignielToTop"></a>
            <div id="disqus_thread"></div>
            <script>
                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                /*
                var disqus_config = function () {
                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
                (function () { // DON'T EDIT BELOW THIS LINE
                    var d = document,
                        s = d.createElement('script');
                    s.src = 'https://thedevcode.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
        
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
                    Disqus.</a></noscript>
    

        </div>

        <div class="col-md-4">
            <div class="" style="top: 4rem;">

             

                {{-- <div class="p-6 mb-3 mt-4">
                    <h5 class="fst-italic">Post Terkait</h5>
                    <div class="list-group">
                        
                        @foreach ($related as $post)
                        <a href="/artikel/{{ $post->slug }}" class="list-group-item list-group-item-action"
                            aria-current="true">
                            <div class="">
                              <img src="{{ asset('storage/' .$post->image) }}" style="float:right"; width="120px" height="50px" class="rounded border border-1 img-thumbnail text-center" alt="{{ $post->title }}">
                                <h6 class="mb-1 ">{{ $post->title }}</h5>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>

                        </a>
                        @endforeach
                        
                    </div>
                </div> --}}
                <div class="p-6 mb-3 mt-4">
                    <h5 class="fst-italic">Artikel Populer</h5>
                    <div class="list-group">
                        {{-- perulangan post --}}
                        @foreach ($populer as $p)
                        <a href="/artikel/{{ $p->slug }}" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="">
                              
                                <h6 class="mb-1 ">{{ $p->title }}</h5>
                                    <small class="text-muted">Dilihat <i class="far fa-eye fa-sm"></i> {{ $p->total_views}} x</small>
                            </div>

                        </a>

                        @endforeach
                        {{-- end --}}
                    </div>
                </div>

                <div class="p-6 mb-3">
                    <h5 class="fst-italic">Artikel Terbaru</h5>
                    <div class="list-group">
                        {{-- perulangan post --}}
                        @foreach ($latest as $p)
                        <a href="/artikel/{{ $p->slug }}" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="">
                              {{-- <img src="{{ asset('storage/' .$p->image) }}" style="float:right"; width="120px" height="50px" class="rounded border border-1 img-thumbnail text-center" alt="{{ $p->title }}"> --}}
                                <h6 class="mb-1 ">{{ $p->title }}</h5>
                                    <small class="text-muted">{{ $p->created_at->diffForHumans() }}</small>
                            </div>

                        </a>

                        @endforeach
                        {{-- end --}}
                    </div>
                </div>

                {{-- iklan --}}
                <div class="p-6 mb-2 ">
                    <h5 class="fst-italic">Iklan</h5>
                    <div class="container">
                        <div class="row">



                        </div>
                    </div>

                </div>

            </div>
        </div>
      
    </div>




   
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('img').css('max-width', '100%');

    </script>
    <script>
        $('iframe').css('max-width', '100%');

    </script>
    <script>
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 1500);

    </script>

    </article>

</div>
@endsection

@section('footer')
<script src="{{ asset('js/prism.js') }}"></script>
@endsection
