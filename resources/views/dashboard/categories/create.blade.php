@extends('dashboard.layouts.main')
@section('container')
<title>{{ $title }}</title>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Topik</h1>
  </div>
  <div class="col-lg-8">
    <form method="post" action="/dashboard/categories" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" value="{{ old('name') }}"  autofocus class="form-control @error('name') is-invalid @enderror" id="name" name="name">
         
          @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>  
        {{-- <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" value="{{ old('slug') }}"  class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug">
          @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
        </div> --}}
  

        <div class="mb-3">
          <label for="image" class="form-label">Category Image</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input onchange="previewImage()" class="form-control  @error('image') is-invalid @enderror" type="file" id="image" name="image">
          @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
        </div>



        <label for="exampleColorInput" class="form-label">Color picker</label>
        <input type="color" class="form-control form-control-color" id="exampleColorInput" name="color" value="#563d7c" title="Choose your color">
       <br>
        <button type="submit" class="btn btn" style="background-color: rgb(143, 97, 218); color:white;">Add</button>
      </form>
  </div>

  {{-- image preview --}}
<script>

function previewImage()
{

  const image = document.querySelector('#image');
  const imgPreview = document.querySelector('.img-preview');

  imgPreview.style.display = 'block';

  const oFReader = new FileReader();

  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent) {

  imgPreview.src = oFREvent.target.result;

}


}
</script>
  {{-- auto slug with js --}}
  <script>
      const title = document.querySelector('#name');
      const slug = document.querySelector('#slug');

      title.addEventListener('change' , function(){
          fetch('/dashboard/posts/checkSlug?title=' +title.value)
          .then(response => response.json())
          .then (data => slug.value = data.slug )
      });


  
  </script>

  {{-- menghilangkan fungsi file di trix --}}
<script>
      document.addEventListener('trix-file-accept', function(e)'{
         e.preventDefault();
      })
</script>

  
@endsection