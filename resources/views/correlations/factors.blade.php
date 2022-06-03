@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Find Underlying Return Information') }}
            </h2>
        </x-slot>

        <div>
            <div class="mx-auto px-4 py-10 md:py-5">
                @livewire('factors')
            </div>
        </div>
    </x-app-layout>
@else
    <x-guest-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Find Underlying Return Information') }}
            </h2>
        </x-slot>

        <div>
            <div class="mx-auto px-4 py-10 md:py-5">
                @livewire('factors')
            </div>
        </div>
    </x-guest-layout>
@endauth

