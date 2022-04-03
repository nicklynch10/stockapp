<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find the Best Comparable Stocks/ETFs') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
          @livewire('check-correlations')

           <x-jet-section-border />
        </div>
    </div>
</x-app-layout>
