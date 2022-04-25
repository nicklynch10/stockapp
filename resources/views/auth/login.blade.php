<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />

        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {!! session('status') !!}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex justify-center my-2">
                <a href="{{ url('auth/google') }}">
                    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                </a>
            </div>
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full password-field" type="password" name="password" required autocomplete="current-password" />
                <span toggle=".password-field" class="fa fa-fw fa-eye field-icon toggle-password float-right -mt-8 mr-3"></span>
            </div>

            <div class="block mt-4 flex justify-between">
                <label for="remember_me" class="flex">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="ml-5 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex mt-4 justify-between">
                <x-jet-button>
                    {{ __('Log in') }}
                </x-jet-button>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="float-left mr-5 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">{{ __('Register') }}</a>
                @endif

            </div>

        </form>
        <script>
            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>
    </x-jet-authentication-card>
</x-guest-layout>
