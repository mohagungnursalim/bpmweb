@extends('dashboard.layouts.main')

@section('container')
<title> {{ $title }}</title>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

     {{-- Edit Password --}}
     <div class="card">
        <div class="card-header">
        <h4 class="text-dark"><img src="https://img.icons8.com/ios/22/000000/password--v1.png"/> Change Password</h4>
        </div>
          <div class="card-body">
            <form method="POST" action="{{ route('change.password') }}">
                @csrf 

                 @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                 @endforeach 

                <div class="form-group row">
                    <div class="col-md-6">
                        <br>
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" placeholder="Password Lama">
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                    </div>
                   
                </div>
                    <br>


                    <div class=" form-group row">
                      <div class="col">
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password">
                        <input type="checkbox" onclick="passFunction()">Show Password
                      </div>
                      <div class="col">
                        <input type="password" id="new_confirm_password" name="new_confirm_password"  class="form-control" placeholder="Confirm Password">
                        <input type="checkbox" onclick="myFunction()">Show Password
                      </div>
                    </div>

                {{-- <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                    <div class="col-md-6">
                        <br>
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="new-password" placeholder="password..">
                        <input type="checkbox" onclick="passFunction()">Show Password
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                    <div class="col-md-6">
                        <br>
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="new-confirm-password" placeholder="password..">
                        <input type="checkbox" onclick="myFunction()">Show Password
                    </div>
                </div> --}}
                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
          </div>
        </div> 

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
