<div class="relative" style="">
    <x-jet-dropdown align="right" width="60" dropdownClasses="notification-drop">
        <x-slot name="trigger">
            <div class="inline-flex rounded-md">
                <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        wire:click.debounce.debounce.4000ms="open">
                    @if($unreadCount > 0)
                        <i class="mdl-badge fa fa-bell count_icon lg:text-lg text-red-700 text-red-600" data-badge="{{$unreadCount}}"></i>
                        <span class="cart-basket d-flex align-items-center justify-content-center count-icon">
                            {{$unreadCount}}
                        </span>
                    @else
                        <i class="mdl-badge fa fa-bell lg:text-lg no_notifications "></i>
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
                @foreach($this->unread as $r)
                    <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                    style="
                        word-break: break-word;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        line-height: 16px;
                        max-height: 58px;
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;">
                        {{$r->data["tagline"]}}
                    </a>
                @endforeach
                @if(count($this->read)>0)
                    <x-jet-dropdown-link href="{{ url('notifications')}}" class="text-sm text-gray-400">
                        View All Notifications
                    </x-jet-dropdown-link>
                @else
                    <x-jet-dropdown-link class="text-sm text-gray-400">
                        No Notifications
                    </x-jet-dropdown-link>
                @endif
        </x-slot>
    </x-jet-dropdown>
</div>



