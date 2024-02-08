
@include('dashboard.layouts.header')

<head>
    @yield('ckeditorcss')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('dashboard.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               @include('dashboard.layouts.navbar')
               
                <!-- Begin Page Content -->
                <div class="container-fluid">

                   {{-- section konten --}}
                   @yield('container')
                   
                   @include('sweetalert::alert')
                    @stack('baseScripts')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="fas fa-logout fa-sm"></i><a >LogOut</a></button>
                  </form>
                    {{-- <a class="btn btn-primary" href="login.html">Logout</a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @stack('script')
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>
   
</body>

</html>






















{{-- <head>
    <link rel="stylesheet" href="{{ asset('/css/preloader.css') }}">
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    @stack('styles')
</head> --}}

{{-- <body class="">
    @include('dashboard.layouts.header')

    <div class="">
        <div class="main-panel">
            <div class="content">
                <div class="card card-user">
                    <div class="card-body">

                        @yield('container')
                        @include('sweetalert::alert')
                        @stack('baseScripts')
                        <div class="preloader">
                            <div class="loading">
                                <img src="{{ asset('/img/logonavbartdc.png') }}" width="130">
                                <br><br>
                                <h3>Loading..</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.layouts.sidebar')

    
    <script src="{{ asset('/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

    @stack('script')
    <script src="{{ asset('/js/paper-dashboard.min.js?v=2.0.1') }}" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".preloader").fadeOut();
        })
    </script>
</body> --}}








{{-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">



<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
{{-- select2 link css --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    {{-- trix editor --}}
{{-- <link rel="stylesheet" type="text/css" href="/css/trix.css">
  <script type="text/javascript" src="/js/trix.js"></script>
  
  {{-- preloader css --}}
{{-- <link rel="stylesheet" href="{{ asset('/css/preloader.css') }}">
</head>

<body>
    --}}
    {{-- @include('dashboard.layouts.header') --}}

    {{-- <div class="container-fluid">
  <div class="row">
    
    @include('dashboard.layouts.sidebar')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
     @yield('container')
     @include('sweetalert::alert')
      @stack('baseScripts')
    </main>
  </div>
{{-- </div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script> --}}
    {{-- 
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="/js/dashboard.js"></script> --}}


    {{-- </body>
</html> --}}
