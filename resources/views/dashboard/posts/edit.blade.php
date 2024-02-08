@extends('dashboard.layouts.main')
@section('container')

<head>
    @push('styles')
    <link href="{{ asset('select/css/bootstrap-select.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/prism.css') }}"> --}}
    @endpush

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
            transform: translate(-50%, -50%);
            font: 14px arial;
        }

    </style>
    <title>{{$title}}</title>
</head>
<a href="/dashboard/posts" class="btn btn-warning" style="border-radius:23px;">🔙Kembali</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-dark">Edit Tulisan</h1>
</div>
<div class="col-lg-12">

    <form method="post" id="edit" action="/dashboard/posts/{{ $post->slug }}" class="mb-5"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" value="{{ old('title' ,$post->title) }}" autofocus
                class="form-control @error('title') is-invalid @enderror" id="title" name="title">

            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
       
        <div class="form-group @error('category_id') has-danger @enderror">
            <label for="category">KategoriI</label>
            <br>
            <small class="text-danger">*saat mengedit tulisan harap isi kembali Kategori</small>
            <select class="selectpicker form-control " name="category_id[]" id="category_id" multiple data-live-search="true">
  
              @foreach ( $categories as $category )
              <option value="{{ $category->id }}">{{ $category->name }}</option>   
              @endforeach
            </select>
            @error('category_id')
            <small class="text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
  
          <div class="form-group @error('tag_id') has-danger @enderror">
            <label for="tag">Tag</label>
            <br>
            <small class="text-danger">*saat mengedit tulisan harap isi kembali Tag</small>
            <select class="selectpicker form-control " name="tag_id[]" id="tag_id" multiple data-live-search="true">
             
              @foreach ( $tags as $tag )
              
  
              @if(old('tag_id') == $tag->id)
              <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
              @else
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
               @endif
             
              @endforeach
            </select>
            @error('tag_id')
            <small class="text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>

<div class="mb-3">
    <label for="image" class="form-label">Gambar Thumbnail</label>
    <input type="hidden" name="oldImage" value="{{ $post->image }}">
    @if($post->image)
    <img src="{{ asset('storage/' .$post->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
    <textarea class="form-control mb-2" rows="2" id="deskripsi_gambar" placeholder="Deskripsi Gambar.." name="image_description">{{ $post->image_description }} </textarea>
    @else
    <img class="img-preview img-fluid mb-3 col-sm-5">
    @endif

    <input onchange="previewImage()" class="form-control  @error('image') is-invalid @enderror" type="file" id="image"
        name="image">
    @error('image')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>



<div class="form-group">
    <label for="seo" class="form-label text-dark">SEO Deskripsi</label>
    <input type="text" value="{{ old('description', $post->description) }}"
        class="form-control @error('description') is-invalid @enderror" id="description" name="description">
    @error('description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

{{-- cek jika ada value dalam kolom moderasi --}}
@if (isset($post->moderasi))
<div class="form-check mb-4 mt-2">
    <input class="form-check-input" type="checkbox" name="is_change" value="1" id="defaultCheck1" @if (isset($post->moderasi)) checked @endif>
    <label class="form-check-label" for="defaultCheck1">
      Tandai Telah Diperbarui 📝
    </label>
    <small><p class="text-danger"> </p></small>
</div>
@endif




<div class="mb-3">
    <label for="body" class="form-label">Isi Tulisan</label>
    <textarea class="form-control" name="body" id="editor">{{ old('body',$post->body) }}</textarea>

    @error('body')
    <p class="text-danger"> {{ $message }}</p>
    @enderror

</div>
<div class="text-center">
    <button type="submit" class="btn btn" style="background-color: rgb(143, 97, 218); color:white;">Simpan</button>
</div>

<div id="PleaseWait" style="display: none;">
    <div class="preloader">
        <div class="loading">
            <div class="spinner-border text-primary" role="status"></div><span
                class="visually-hidden text-dark">Update..</span>
        </div>
    </div>
</div>
</form>
</div>






@push('styles')
<link href="{{ asset('select/css/bootstrap-select.min.css') }}" rel="stylesheet">

@endpush

@push('script')
<script type="text/javascript" src="{{ asset('select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
{{-- <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script> --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

</script>
<script>
    CKEDITOR.replace('editor', options);

</script>

@endpush

{{-- loading before submit --}}
<script>
    $('#edit').submit(function () {
        var pass = true;
        //some validations
        // $("#overlay").show();
        if (pass == false) {
            return false;
        }
        $("#PleaseWait").show();

        return true;
    });

</script>

{{-- image preview --}}
<script>
    function previewImage() {

        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();

        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {

            imgPreview.src = oFREvent.target.result;

        }


    }

</script>

{{-- auto slug with js --}}
{{-- <script>
      const title = document.querySelector('#title');
      const slug = document.querySelector('#slug');

      title.addEventListener('change' , function(){
          fetch('/dashboard/posts/checkSlug?title=' +title.value)
          .then(response => response.json())
          .then (data => slug.value = data.slug )
      });
  </script>
<script>
      document.addEventListener('trix-file-accept', function(e)'{
         e.preventDefault();
      })
</script> --}}


@endsection
