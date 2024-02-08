@extends('dashboard.layouts.main')

@section('container')
<head>
  <title>{{ $title }}</title>
  <style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: rgba(255, 255, 255, 0.514);
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
    </style>
</head>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2 text-dark">Tag</h1>
</div>


{{-- Create Tags --}}
<form method="post" action="/dashboard/tags" id="tags" class="mb-5" enctype="multipart/form-data">
    @csrf

    <div class="col-lg-5">
      <label for="name" class="form-label">Name</label>
      <input type="text" value="{{ old('name') }}" placeholder="Tambah Tag.."  autofocus class="form-control border border-primary @error('name') is-invalid @enderror" id="name" name="name">
      <br>
      <button type="submit" class="btn btn" style="background-color: rgb(143, 97, 218); color:white;"><i class="fa fa-plus fa-sm" aria-hidden="true"></i> Tambah</button>
     
      @if (request('search'))
      <br>
      Anda mencari <kbd style="background-color: rgba(236, 136, 69, 0.808)"> "{{ request('search') }}"</kbd>

      @endif
      @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>  
  </form>



@if($tags->count())
<div class="table-responsive col-lg-6">
    <table class="table table-borderless table-hover table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tag</th> 
          @can('admin')
          <th scope="col">Action</th> 
          @endcan
                  
        </tr>
      </thead>
      <tbody>
          @foreach($tags as $tag)

          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $tag->name }}</td>
            @can('admin')
            <td>
    
              <form action="/dashboard/tags/{{ $tag->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf

                <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus Tag ini?')">Delete</button>
              </form>
             
          </td>    
            @endcan
                  
          </tr>
          @endforeach
      </tbody>
    </table>
@else

  <p class=" fs-5">No Tag Found.. <img src="https://img.icons8.com/ios/50/000000/sad.png"/></p>
@endif

    <div class="d-flex justify-content-center">
      
      {{ $tags->links() }}

    </div>
  </div>

  <div id="PleaseWait" style="display: none;"><div class="preloader"><div class="loading"><div class="spinner-border text-primary" role="status"></div><span class="visually-hidden text-dark"> Menambahkan</span> </div></div></div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script>
          
$('#tags').submit(function() {
    var pass = true;
    //some validations
    // $("#overlay").show();
    if(pass == false){
        return false;
    }
    $("#PleaseWait").show();

    return true;
});
</script>

@endsection

