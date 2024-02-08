@extends('layouts.main')
@section('container')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css" integrity="sha512-p++g4gkFY8DBqLItjIfuKJPFvTPqcg2FzOns2BNaltwoCOrXMqRIOqgWqWEvuqsj/3aVdgoEo2Y7X6SomTfUPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container">
    <h2 class="mb-3 mt-5">Portfolio <img src="https://img.icons8.com/glyph-neue/64/null/github.png"/></h2>
    <div class="row">
        <div class="mb-2"></div>

        @foreach ($datas as $data )
            
        <div class="card border-dark mb-3" >
            <div class="card-header "><b> <mark>{{ $data['name'] }}</mark>  <span class="badge rounded-pill text-bg-dark">{{ $data['visibility'] }}</span> </b></div>
            <div class="card-body text-dark">
              <h5 class="card-title">{{ $data['full_name'] }} </h5>
              <a href="{{ $data['html_url'] }}">{{ $data['html_url'] }}</a>
                <br>
                <i class="far fa-star fa-sm"> {{ $data['stargazers_count'] }}</i>
                <small class="text-muted"> &nbsp; Diperbarui {{\Carbon\Carbon::parse($data['updated_at'])->diffForHumans() }}</small> 
               
            </div>
        </div>
        @endforeach
    </div>
</div>
    
       
    
      

@endsection