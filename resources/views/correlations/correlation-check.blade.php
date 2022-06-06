@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Find the Best Comparable Stocks/ETFs') }}
            </h2>
        </x-slot>

        <div>
                @livewire('check-correlations')
                <x-jet-section-border />
        </div>
    </x-app-layout>
@else
    <x-guest-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Find the Best Comparable Stocks/ETFs') }}
            </h2>
        </x-slot>
        <div>
            @livewire('check-correlations')
            <x-jet-section-border />
        </div>
    </x-guest-layout>
@endauth


