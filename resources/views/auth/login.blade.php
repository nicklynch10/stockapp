<x-guest-layout>
    <x-jet-authentication-card style="background-image: url('/images/green-rounded.png');background-size: cover">
        <x-slot name="logo">
{{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {!! session('status') !!}
            </div>
        @endif

        <div class="flex justify-center mb-6 my-2 text-xl font-bold">
            <x-jet-authentication-card-logo /><br>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
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
                    <a class="ml-5 text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex mt-4 justify-center">
                <x-jet-button class="w-full bhrborder-radius justify-center text-lg h-9">
                    {{ __('Log In') }}
                </x-jet-button>
            </div>
            <div class="flex justify-between items-center mt-8 text-center">
                <span class="border border-solid text-gray-800 w-28"></span>
                <span class="text-md text-gray-700">Or login with</span>
                <span class="border border-solid text-gray-800 w-28"></span>
            </div>
            <div class=" justify-between items-center my-4 text-center">
                <a href="{{ url('auth/google') }}"><span><img src="/images/glogo.png" style="height: 35px;"></span></a>
            </div>

            <div class="justify-between items-center my-4 text-center">
                <span>Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Create new one</a></span>
            </div>


{{--            <div class="block mt-4 flex justify-between">--}}
{{--                <label class="flex">--}}
{{--                    <span class="ml-2 text-lg text-sm text-gray-600">New to {{ appName() }}?</span>--}}
{{--                </label>--}}
{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}" class="float-left mr-5 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">{{ __('Get Started') }}</a>--}}
{{--                @endif--}}
{{--            </div>--}}

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
