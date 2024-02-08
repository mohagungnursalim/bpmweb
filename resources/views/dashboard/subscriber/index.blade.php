@extends('dashboard.layouts.main')

@section('container')
<head>
    <title>Subscriber | Dashboard</title>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
</head>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Subscriber</h1>
</div>

  <a href="{{ route('export.subscriber') }}" class="btn " style="background-color: rgb(143, 97, 218); color:white;">Export <img src="https://img.icons8.com/color/27/000000/export-excel.png"/></a>

<div class="row">  

@if($subscriber->count())
<div class="table-responsive">
    <table class="table table-borderless table-hover">
      <thead>
        <tr>
          <th scope="col" class="text-dark">#</th>
          <th scope="col" class="text-dark">Email</th>
          <th scope="col" class="text-dark">Tanggal Masuk</th>       
        </tr>
      </thead>
      <tbody>
          @foreach($subscriber as $subs)

          <tr>
            <td class="text-dark">{{ $loop->iteration }}</td>
            <td class="text-dark">{{ $subs->email }}</td>
            <td class="text-dark">{{ $subs->created_at }}</td>  
          </tr>
          @endforeach
      </tbody>
    </table>
    @else

  <p class=" fs-5">No Subscriber Found.. <img src="https://img.icons8.com/ios/50/000000/sad.png"/></p>
@endif
              
           
    </div>
  </div>
</div>








            


    <div class="d-flex justify-content-center">
    {{ $subscriber->links() }}
    </div>
        </div>
    </div>
</div>
@endsection

