@extends('layouts.main')

@section('container')

<head>

    {{-- Meta For SEO --}}
    @section('meta')

    <meta title="{{ $event->nama }}">
    <meta content="{{ $event->deskripsi }}" name="description">
    <meta name="keyword" content="
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
        <div class="col-md-9 mx-auto">
            {{-- <nav aria-label="">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-secondary"
                            href="/"><small>Home</small></a></li>
                    <li class="breadcrumb-item active"><a href="/blog"
                            class="text-decoration-none text-secondary"><small> Blog ></small></a></li>

                </ol>

            </nav> --}}
            <p class="h2 mb-3 mt-3 bold">{{ $event->nama }}</p>
            
          
            &nbsp; <small class="text-muted"><i class="far fa-calendar fa-sm"></i> {{ Carbon\Carbon::parse($event->tanggal_mulai)->format('d M,Y') }}</small>
            <article class="my-3 fs-6">
    
                <br>
                <div class="bg-light mb-3" style="display: flex; gap:10px">
                    <h6 class="text-muted">Share:</h6>
                    <a href="whatsapp://send?text=https://www.the-devcode.com/blog/{{ $event->slug }}"
                        title="Share this event on Whatsapp">
                        <img src="https://img.icons8.com/color/30/000000/whatsapp--v4.png" height="26px" width="26px"
                            alt="Share to Whatsapp" />
                    </a>
                    <a style="float: left" class="twitter"
                        href="https://twitter.com/share?text={{ $event->slug }}&url=https://www.the-devcode.com/blog/{{ $event->slug }}"
                        alt="Share to Twitter" title="Share this post on Twitter" target="_blank">
                        <img src="https://img.icons8.com/color/30/000000/twitter.png" height="26px" width="26px"
                            alt="Share to Twitter" />
                    </a>
                </div>

                {{-- post body (content) --}}
                <span style="font-size: 14pt" class="text-secondary">
                    {!! $event->deskripsi !!}
                </span>


                </nav>
                
                

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

              

            <h5 class="text-muted mt-4">Komentar Event</h5>
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
@endsection
