<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ $title }}</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('template/public/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('template/public/assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template/public/assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="t{{asset('emplate/assets/img/favicons/favicon.png')}}">
    <link rel="manifest" href="{{asset('template/public/assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('template/public/assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{asset('template/public/assets/css/theme.css')}}" rel="stylesheet" />

  </head>


  <body>
{{-- Navbar --}}
@include('partials.navbar')
{{-- End Navbar --}}
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      
     
      @yield('container')
        @include('sweetalert::alert')
      @stack('baseScripts')

      @include('partials.footer')
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


  


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{asset('template/public/vendors/@popperjs/popper.min.js')}}"></script>
    <script src="{{asset('template/public/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/public/vendors/is/is.min.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{asset('template/public/vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{asset('template/public/assets/js/theme.js')}}"></script>
    @stack('script')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
  </body>

</html>