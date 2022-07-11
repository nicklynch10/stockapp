<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Invitations') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-10 md:py-12">
        <livewire:user-invites/>
    </div>
</x-app-layout>
