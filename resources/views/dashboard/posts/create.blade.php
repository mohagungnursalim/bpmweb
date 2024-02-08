@extends('dashboard.layouts.main')
@section('container')

<head>
    <title>{{ $title }}</title>
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
          transform: translate(-50%,-50%);
          font: 14px arial;
        }
        </style>
</head>

<a href="/dashboard/posts" class="btn btn-warning" style="border-radius:23px;">🔙Kembali</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-dark">Hanya tulisan yang tidak termakan oleh waktu ✍️🕊️</h1>
</div>

<div class="col-lg-12">
    <form method="post" id="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title" class="form-label text-dark">Judul</label>
            <input type="text" value="{{ old('title') }}" autofocus
                class="form-control @error('title') is-invalid @enderror" id="title" name="title">

            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="slug" class="form-label text-dark">Slug</label>
            <input type="text" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror"
                id="slug" name="slug">
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> --}}

        <div class="form-group @error('category_id') has-danger @enderror">
            <label for="category" class="text-dark">Topik</label>
            <select class="selectpicker form-control " name="category_id[]" id="category_id" multiple
                data-live-search="true">

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
            <label for="tag" class="text-dark">Tag</label>
            <select class="selectpicker form-control " name="tag_id[]" id="tag_id" multiple data-live-search="true">

                @foreach ( $tags as $tag )
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>

                @endforeach
            </select>
            @error('tag_id')
            <small class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label text-dark">Gambar Thumbnail</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
             <!-- Textarea deskripsi Gambar -->
             <textarea class="form-control " rows="2" id="deskripsi_gambar" placeholder="Deskripsi Gambar.." name="image_description"
             style="display: none ;"></textarea>
            <input onchange="previewImage()"class="form-control  @error('image') is-invalid @enderror" type="file"
                id="image" name="image">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
  
        {{-- <div class="form-group">
            <label for="published" class="form-label text-dark">Tanggal terbit</label>
            <input type="date" value="{{ old('published_at') }}"
                class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at">
            @error('published_at')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> --}}

        <div class="form-group">
            <label for="seo" class="form-label text-dark">SEO Deskripsi</label>
            <input type="text" value="{{ old('description') }}"
                class="form-control @error('description') is-invalid @enderror" id="description" name="description">
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <small class="mb-3"><a class="text-danger">*</a>SEO Deskripsi adalah konten yang akan tampil pada Google Search Engine </small> 
       
        
        <div class="mb-3 mt-2">
            <label for="body" class="form-label text-dark">Isi Tulisan</label>
            <textarea class="form-control" placeholder="postingan...." name="body" id="editor">{{ old('body') }}</textarea>

            @error('body')
            <p class="text-danger"> {{ $message }}</p>
            @enderror

        </div>
        <small><a class="text-danger">*</a> Untuk select all konten gunakan <kbd>Ctrl</kbd>+<kbd>A</kbd> </small> 
      <div class="text-center">
        <button type="submit" class="btn btn" style="background-color: rgb(143, 97, 218); color:white;">Simpan</button>
      </div>
        
        <div id="PleaseWait" style="display: none;"><div class="preloader"><div class="loading"><div class="spinner-border text-primary" role="status"></div><span class="visually-hidden text-dark">Menyimpan ke Draft!</span> </div></div></div>
    </form>
</div>

{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>


{{-- loading before submit --}}
<script>
$('#post').submit(function() {
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
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function () {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

</script>
{{-- Check Slug --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    function previewImage() {
        var imageInput = document.getElementById('image');
        var deskripsiTextarea = document.getElementById('deskripsi_gambar');

        // Tampilkan textarea jika input file diubah
        deskripsiTextarea.style.display = 'block';

        // Tampilkan gambar thumbnail (disesuaikan dengan implementasi fungsi previewImage Anda)
        var previewImage = document.querySelector('.img-preview');
        previewImage.src = URL.createObjectURL(imageInput.files[0]);
    }
</script>

{{-- Menampilkan Textarea saat input file di klik --}}
<script>
    $(document).ready(function () {
        // Mendapatkan elemen input
        var inputDeskripsi = $(".image");

        // Memunculkan elemen textarea saat radio button diklik
        inputDeskripsi.on("change", function () {
            var value = $(this).val();
                $(".dekskripsi_gambar").show();
        });
    });

</script>

@endsection


@push('script')
  <script type="text/javascript" src="{{ asset('select/js/bootstrap-select.min.js') }}"></script>
  

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
      CKEDITOR.replace('editor',options);
      </script>
@endpush
