<div>
    <x-jet-confirmation-modal wire:model="issellShareOpen">
        <x-slot name="title">
            {{ __('Enter valid share') }}
        </x-slot>

        <x-slot name="content">
            <span class="text-red-700">{{ __('You can never sell more shares than you have') }}</span>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeSellShareModal()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-confirmation-modal>
</div>
