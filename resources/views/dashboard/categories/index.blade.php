@extends('dashboard.layouts.main')

@section('container')
<title>{{ $title }}</title>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2 text-dark">Topik</h1>
</div>

<a href="/dashboard/categories/create" class="btn btn mb-3" style="background-color: rgb(143, 97, 218); color:white;"><i class="fa fa-plus fa-sm" aria-hidden="true"></i> Tambah</a>

@if (request('search'))
<br>
 Anda mencari <kbd style="background-color: rgba(197, 255, 37, 0.808); color:black"> "{{ request('search') }}"</kbd>

@endif

@if($categories->count())
<div class="table-responsive col-lg-6">
    <table class="table table-borderless table-hover table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Topik</th> 
          <th scope="col">Warna</th>  
          <th scope="col">Image</th>
          <th scope="col">Action</th>          
        </tr>
      </thead>
      <tbody>
          @foreach($categories as $category)

          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>
            <td><span class="badge badge text-white" style="background-color: {{ $category->color }}" >Warna</span></td>
            <td> <img src="{{ asset('storage/' .$category->image) }}" alt="{{ $category->name }}" width="50px"></td>
            <td>
               
               
                <form action="/dashboard/categories/{{ $category->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf

                  <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus Category ini?')">Delete</button>
                </form>
               
            </td>          
          </tr>
          @endforeach
      </tbody>
    </table>
    @else

  <p class=" fs-5">No Post Found.. <img src="https://img.icons8.com/ios/50/000000/sad.png"/></p>
@endif

    <div class="d-flex justify-content-center">
      
      {{ $categories->links() }}

    </div>
  </div>
  


@endsection
