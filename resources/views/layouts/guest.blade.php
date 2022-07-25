<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ appName() }} | Investment Tax Harvesting Platform</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="icon" type="image/x-icon" href="/images/ghost.png">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" type="text/css" href="/css/tooltipster.bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/tooltipster-sideTip-borderless.min.css" />

    @livewireStyles
    <!-- Scripts -->

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript" src="/js/tooltipster.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.tooltip').tooltipster({
                theme: 'tooltipster-borderless',
                delay: 100,
                trigger: ('ontouchstart' in window) ? 'click' : 'hover',
            });
        });
    </script>

    <script src=css/notification.css></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar:true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('alert',({detail:{type,message}})=>{
            Toast.fire({
                icon:type,
                title:message
            })
        })
    </script>

</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    <x-jet-banner />
    {{--            @if(request()->routeIs('factors') || request()->routeIs('correlation-check')) @include('home.home-top') @endif--}}
    @include('home.home-top')
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    {{ $slot }}
</div>
@include("layouts.footer")
@stack('modals')
@livewireScripts
</body>
</html>


