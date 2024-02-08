@extends('dashboard.layouts.main')

@section('container')

<title>My Profile</title>

<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">

                </div>
                <div class="card-body">
                    <div class="author">
                        <a class="text-center text-decoration-none text-dark">
                            <center>
                                <img width="150px" src="/uploads/avatars/{{ Auth::user()->avatar }}"
                                class="rounded-circle float-center" alt=" {{ Auth::user()->username }}">
                            </center>
                            
                            <h5 class="title">{{ Auth::user()->username }}</h5>
                            <form method="POST" action="{{ route('change.picture') }}" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <input type="file" name="avatar" required>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            </form>
                        </a>


                        
                    </div>
                  
                </div>
                <div class="card-footer">
                    <p class=" text-dark text-center">
                        {{ Auth::user()->email}}
                    </p>
                    <hr>
                    <p class=" text-center text-dark">
                        "{{Auth::user()->bio}}"
                    </p>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title text-dark">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-dark">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right text-dark">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username', $user->username) }}" autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right text-dark">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Link trakteer --}}
                        <div class="form-group row">
                            <label for="trakteer"
                                class="col-md-4 col-form-label text-md-right text-dark">{{ __('Trakteer') }}</label>

                            <div class="col-md-6">
                                <input id="trakteer" type="text"
                                    class="form-control @error('trakteer') is-invalid @enderror" name="trakteer"
                                    value="{{ old('username', $user->trakteer) }}" autocomplete="trakteer" placeholder="Masukan link trakteer..">

                                @error('trakteer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- instagram --}}
                        <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right text-dark">{{ __('Instagram') }}</label>

                            <div class="col-md-6">
                                <input id="instagram" type="text"
                                    class="form-control @error('instagram') is-invalid @enderror" name="instagram"
                                    value="{{ old('instagram', $user->instagram) }}" placeholder="Your Instagram.."
                                    autocomplete="intagram" autofocus>

                                @error('instagram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- twitter --}}
                        <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right text-dark">{{ __('Twitter') }}</label>

                            <div class="col-md-6">
                                <input id="twitter" type="text"
                                    class="form-control @error('twitter') is-invalid @enderror" name="twitter"
                                    value="{{ old('twitter', $user->twitter) }}" placeholder="Your Twitter.."
                                    autocomplete="twitter" autofocus>

                                @error('twitter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="bio" class="col-md-4 col-form-label text-md-right text-dark">{{ __('Bio') }}</label>

                                <div class="col-md-6 ">
                                    <br>
                                    <textarea id="bio" cols="71" class="form-control @error('bio') is-invalid @enderror"
                                        name="bio" placeholder="Your bio..">{{ old('bio',$user->bio) }}</textarea>
                                    @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                               
                            </div>
                            <center>
                                <br>
                                <button type="submit" class="btn btn-primary text-center">
                                    Update Profile
                                </button>
                            </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<title>My Profile</title>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2"><u>My Profile</u></h1>
</div>
<h4>User Profile Image</h4>
<img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="rounded-circle" width="15%">

<form method="POST" action="{{ route('change.picture') }}" enctype="multipart/form-data">
    @csrf
    <br>
    <input type="file" name="avatar">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-primary">Submit</button>
</form> --}}

{{-- 
<div class="container">   
</div> --}}
{{-- edit profile
<div class="card-header">
    <br>
    <h4><img src="https://img.icons8.com/ios-filled/24/000000/user.png"/> Edit Profile </h4>
</div>
    <div class="card-body">
      <form method="POST" action="{{ route('profile.update') }}">

@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

    <div class="col-md-6">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
            value="{{ old('username', $user->username) }}" autocomplete="username" autofocus>

        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email', $user->email) }}" autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div> --}}
{{-- instagram
          <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

<div class="col-md-6">
    <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram"
        value="{{ old('instagram', $user->instagram) }}" placeholder="your instagram.." autocomplete="intagram"
        autofocus>

    @error('instagram')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div> --}}
{{-- twitter --}}
{{-- <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Twitter') }}</label>

<div class="col-md-6">
    <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter"
        value="{{ old('twitter', $user->twitter) }}" placeholder="your twitter.." autocomplete="twitter" autofocus>

    @error('twitter')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div>
<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>

    <div class="col-md-6"> --}}
        {{-- <input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ old('bio', $user->bio) }}"
        autocomplete="bio" autofocus> --}}
        {{-- <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="5" placeholder="Your bio..">{{ old('bio',$user->bio) }}</textarea>
        @error('bio')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<br>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            Update Profile
        </button>
    </div>
</div>
</form>
</div>




</div> --}}


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
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });

</script>

<script>
    function passFunction() {
        var x = document.getElementById("new_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>
<script>
    function myFunction() {
        var x = document.getElementById("new_confirm_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>
@endsection
