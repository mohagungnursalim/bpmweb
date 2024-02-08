@extends('dashboard.layouts.main')
{{-- JUDUL --}}
@section('title')
Pengaturan Aplikasi
@endsection

@section('container')


<div class="row mt-3">

<div class="">

    <div class="card shadow mb-4">
      @foreach ($tentangs as $tentang )

        <div class="card-body">
            <form method="post" action="{{route('tentang-bpm.update',$tentang->id)}}">
                @csrf
                @method('put')
                <div class="form-group">
                  <label for="">Tentang BPM</label>
                  <textarea name="body" id="editor" class="form-control" >{{$tentang->body}}</textarea>
                </div>
               <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
               </div>

              </form>
        </div>
              
        @endforeach
    </div>

</div>
 

  
</div>

{{-- Editor edit --}}
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

@endsection