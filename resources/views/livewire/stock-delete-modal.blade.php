<div>
    <x-jet-confirmation-modal wire:model="deletestock">
        <x-slot name="title">
            {{ __('Delete Stock') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete stock?') }}
            <br><br>
            <span class="text-red-700">{{ __('Please note this will remove all transaction history associate with this stock. This cannot be undone.') }}</span>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closedeletestock()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete({{$this->deleteid}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
