<div>
    <x-jet-confirmation-modal wire:model="isAveOpen">
        <x-slot name="title">
            {{ __('Average Purchase Price') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to Change Average Purchase Price?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class="ml-2" wire:click="closeAveModal(1)" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-jet-button>

            <x-jet-danger-button class="ml-2"  wire:click="closeAveNoModal()" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
