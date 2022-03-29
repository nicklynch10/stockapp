<x-jet-dialog-modal wire:model="isbuyOpen">
    <x-slot name="title">
        {{ __('Buy Existing Stock ') }}
        <button wire:click="closeBuyModal()" class="float-right"><i class="fa fa-close"></i></button>
    </x-slot>

    <x-slot name="content">
        <!-- Role -->
        <div class="col-span-6 lg:col-span-4">
            <div class="mb-4">
                <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2"><b>Stock Ticker:</b></label>
                <label>{{$this->stock_ticker}}</label>
                <input type="text" hidden readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Company Name:</b></label>
                <label>{{$this->company_name}}</label>
                <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                {{--                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror--}}
            </div>
            <div class="mb-4">
                <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Security Name:</b></label>
                <label>{{$this->security_name}}</label>
                <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="security_name">
                {{--                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror--}}
            </div>
            <div class="mb-4">
                <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Share Price:</b></label>
                <label>{{$this->current_share_price}}</label>
                <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Current Share Price" wire:model="current_share_price">
                @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Cost Per Share:</b></label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" wire:model="average_cost">
                @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Total Number of Shares:</b></label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_number">
                @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date of Purchase:</b></label>
                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2"><b>Description:</b></label>
                <label>{{$this->description}}</label>
                <textarea hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Description" wire:model="description"></textarea>
                {{--                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror--}}
            </div>
            <div class="mb-4">
                <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Sector:</b></label>
                <label>{{$this->sector}}</label>
                <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Sector" wire:model="sector">
                {{--                            @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror--}}
            </div>
            <div class="mb-4">
                <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2"><b>Market Cap ($mm):</b></label>
                <label>{{$this->market_cap}}</label>
                <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Market Cap" wire:model="market_cap">
                {{--                            @error('market_cap') <span class="text-red-500">{{ $message }}</span>@enderror--}}
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeBuyModal()">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="addbuy()" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
