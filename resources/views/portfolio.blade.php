<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio') }}

        </h2>
        <br>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-jet-button><a href="{{ route('stock') }}" >{{__('Add Transaction')}}</a></x-jet-button>
        </h2>
    </x-slot>

</x-app-layout>





