
<x-guest-layout>
    @include('sweetalert::alert')

   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
   <style>
       form i {
    margin-left: 8px;
    cursor: pointer;
}
   </style>

    <x-auth-card>
       
        <x-slot name="logo">
            <a href="/">
                <B><h1>BPM FT-UNTAD | LOGIN</h1></B>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                
            </div>
            <i class="bi bi-eye-slash" id="togglePassword"></i>

            <br><br><br>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
               
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Lupa Katasandi?') }}
                    </a>
                @endif

                <x-button class="ml-3" style="color: coral">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

    
    </x-auth-card>
</x-guest-layout>
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
