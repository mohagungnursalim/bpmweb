@extends('dashboard.layouts.main')

@section('container')

<head>
    <title>Pesan Masuk | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
</head>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Pesan Masuk</h2>
</div>

@if (!isset($contacts))
<a href="/dashboard/balas-pesan/" class="btn btn-primary text-white">balas</a> <br><br>
@endif
Pesan dibaca: <button type="button" class="btn btn-outline-success">{{ $count_dibaca }}</button>
Pesan belum dibaca: <button type="button" class="btn btn-outline-danger">{{ $count_belumdibaca }}</button>
Total Pesan: <button type="button" class="btn btn-outline-secondary">{{ $total }}</button><br>


    @if($contacts->count())
    <div class="table-responsive">
        <table class="table table-borderless table-hover" id="">
            <thead class="bg-dark">
                <tr>
                    <th scope="col" class="text-white">#</th>
                    <th scope="col" class="text-white">Nama</th>
                    <th scope="col" class="text-white">Email</th>
                    <th scope="col" class="text-white">Subjek</th>
                    <th scope="col" class="text-white">Pesan</th>
                    <th scope="col" class="text-white">Dikirim</th>
                    <th scope="col" class="text-white">Aksi</th>
                    <th scope="col" class="text-white"></th>
                </tr>
            </thead>
            <tbody>          
                @foreach($contacts as $contact)
                
                
                <tr class="@if (isset($contact->is_read)) @else bg-gradient-secondary @endif">
             
                    <td class="text-dark">{{ $loop->iteration }}</td>
                    <td class="text-dark">{{ $contact->nama }}</td>
                    <td class="text-dark">{{ $contact->email }}</td>
                    <td class="text-dark">{{ $contact->subyek }}</td>
                    <td class="text-dark">{{ $contact->body }}</td>
                    <td class="text-dark">{{ $contact->created_at->diffForHumans() }}</td>
                    <td>
                        <form action="/dashboard/pesanmasuk/isread/{{ $contact->id }}" method="post" class="d-inline">
                            @method('put')
                            @csrf
                            <div class="form-check form-switch">
                    <input class="form-check-input" value="1" name="is_read" type="checkbox" role="switch"  @if (isset($contact->is_read))Checked @else  @endif>
                    <label class="form-check-label" for="">Read</label>
                              </div>
                            
                            <button class="badge" type="submit" style="background-color:rgb(68, 233, 164); color:black; ;border: 0">Save</button>
                          </form>
                       
                    </td>
                    <td>
                        <form action="/dashboard/pesanmasuk/{{ $contact->id }}" method="post">
                            @method('delete')
                            @csrf
          
                            <button type="submit" class="badge bg-danger border-0 text-white" onclick="return confirm('Yakin ingin menghapus Kontak ini?')">Delete</button>
                          </form> 
                             
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else

        <p class=" fs-5">Tidak ada pesan.. <img src="https://img.icons8.com/ios/50/000000/sad.png" /></p>
        @endif


    </div>
</div>
</div>


<div class="d-flex justify-content-center">
    {{ $contacts->links() }}
</div>
</div>
</div>
</div>

@endsection
