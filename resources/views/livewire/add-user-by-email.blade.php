<div>
{{--    <x-jet-section-border/>--}}

<!-- Add Team Member -->
    <div class="mt-10 sm:mt-0">
{{--        <x-jet-form-section submit="{{ $invitation ? 'updateInvitation' : 'addNewUser' }}">--}}
        <x-jet-form-section submit="addNewUser">
            <x-slot name="title">
                {{ __('Invite New User') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Invite a new user to join '. appName() .', allowing them access to the full platform.') }}
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6">
                    <div class="max-w-xl text-sm text-gray-600">
                        {{ __('Please provide the email address of the person you would like to add to this team.') }}
                    </div>
                </div>

                {{-- Member Name --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="first_name" value="{{ __('First Name') }}"/>
                    <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name"/>
                    <x-jet-input-error for="first_name" class="mt-2"/>
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="last_name" value="{{ __('Last Name') }}"/>
                    <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name"/>
                    <x-jet-input-error for="last_name" class="mt-2"/>
                </div>

                {{-- Member Email --}}
                {{--                @if(!$invitation)--}}
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}"/>
                    <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="email"/>
                    <x-jet-input-error for="email" class="mt-2"/>
                </div>
                {{--                @endif--}}

                {{-- Member Title --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="title" value="{{ __('Title (optional)') }}"/>
                    <x-jet-input id="title" type="text" class="mt-1 block w-full"
                                 wire:model.defer="title"/>
                    <x-jet-input-error for="title" class="mt-2"/>
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3 text-green-500" on="saved">
                    {{ __('New user has been invited successfully.') }}
                </x-jet-action-message>


                    <x-jet-button>
                        {{ __('Invite') }}
                    </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>
</div>
