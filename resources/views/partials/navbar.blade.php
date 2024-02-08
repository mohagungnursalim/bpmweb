<nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="/"><img src="{{asset('logo/logobpm2.png')}}" height="80"
                alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"> </span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item"><a class="nav-link {{ Request::is('artikel*') ? 'active' : '' }}"
                        aria-current="page" href="/artikel">Artikel</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('topik*') ? 'active' : '' }}" 
                        href="/topik">Topik</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('kontak*') ? 'active' : '' }}"
                        aria-current="page" href="/kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('event*') ? 'active' : '' }}" 
                        aria-current="page" href="/event">Event</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('tentang-kami*') ? 'active' : '' }}"
                        aria-current="page" href="/tentang-kami">Tentang BPM</a></li>
            </ul>
            <div class="d-flex ms-lg-4">
                @auth
                <a class="btn btn-secondary-outline" href="/dashboard"><img
                        src="/uploads/avatars/{{ auth()->user()->avatar }}" style="border-radius: 40%;" width="25px"
                        alt="">Dashboard</a>
                @else

                @endauth

            </div>
        </div>
    </div>
</nav>


