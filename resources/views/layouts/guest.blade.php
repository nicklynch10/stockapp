<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TaxGhost | Investment Tax Harvesting Platform</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="icon" type="image/x-icon" href="/images/favicon.png">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <x-jet-banner />
            @if(request()->routeIs('factors') || request()->routeIs('correlation-check')) @include('guest-menu') @endif
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            {{ $slot }}
        </div>
        @stack('modals')
        @livewireScripts
    </body>
</html>


