<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <style type="text/css">
        .NavbarMobile__signupBtn {
            width: 100%;
            max-width: 450px;
            margin: 5px;
            text-align: center;
        }
        @media screen and (min-width: 1000px){
            .logo{
                height: 30px ;
                width: auto;
            }
        }

        @media screen and (max-width: 1000px) and (min-width: 500px){
            .logo{
                height: 2.5rem ;
                /*width: 6rem;*/
            }
        }
        @media screen and (max-width: 500px){
            .logo{
                height: 25px ;

            }
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('overview') }}">
                        <img src="/images/logo2.png" class="logo">
                    </a>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="ml-3 relative">
                    @auth
                        <a href="{{ route('portfolio') }}" class="float-left mr-5 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Go</a>
                    @else
                        <a href="{{ route('register') }}" class="float-left mr-5 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">{{ __('Register') }}</a>
                        <a href="{{ route('login') }}" class="float-left mr-5 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Log in</a>
                    @endauth
                </div>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <div class="w-full m-auto text-center" style="z-index: 100;">
                @auth
                    <a class="NavbarMobile__signupBtn px-4 py-2 bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{ route('portfolio') }}" target="_blank">
                        Go
                    </a>
                @else
                    <a class="NavbarMobile__signupBtn px-4 py-2  bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                    <a class="px-4 py-2 bg-green-800 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition NavbarMobile__signupBtn" href="{{ route('login') }}" style="background-color: #9CA3AF;
            border: 2px solid #9CA3AF;">
                        Log in
                    </a>
                @endauth
            </div>
        </div>


    </div>
</nav>
