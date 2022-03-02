<div class="relative" style="">
    <x-jet-dropdown align="right" width="60" dropdownClasses="notification-drop">
        <x-slot name="trigger">
            <div class="inline-flex rounded-md">
                <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        wire:click.debounce.debounce.4000ms="open">
                    @if($unreadCount > 0)
                        <i class="mdl-badge fa fa-bell count_icon lg:text-lg" data-badge="{{$unreadCount}} "></i>
                    @else
                        <i class="mdl-badge fa fa-bell lg:text-lg no_notifications"></i>
                    @endif
                </button>
            </div>
        </x-slot>

        <x-slot name="content">
            <!-- Account Management -->
            <div class="block px-4 py-2 text-xs text-gray-400" wire:loading.attr="showing">
                {{ __('Recent Notifications') }}
            </div>

            <div class="border-t border-gray-200"></div>
            <x-jet-dropdown-link href="{{ url('notifications')}}" class="text-sm text-gray-400">
                View All Notifications
            </x-jet-dropdown-link>
        </x-slot>
    </x-jet-dropdown>
</div>



