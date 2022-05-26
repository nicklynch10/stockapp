<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <style type="text/css">
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
                        <img src="/images/logo.png" class="logo">
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
        </div>
    </div>
</nav>
