<x-jet-dialog-modal wire:model="issellOpen">
    <x-slot name="title">
        {{ __('Stock Sale') }}
        <button wire:click="closeSellModal()" class="float-right"><i class="fa fa-close"></i></button>
    </x-slot>

    <x-slot name="content">
        <!-- Role -->
        <div class="col-span-6 lg:col-span-4">
            <div class="mb-4">
                <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2"><b>Stock Ticker:</b></label>
                <label>{{ strtoupper($this->stock_ticker) }}</label>
                <input type="text" hidden readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Company Name:</b></label>
                <label>{{$this->company_name}}</label>
                <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Number of {{ $this->share_number == 1 ? "Share" : "Shares" }}:</b></label>
                <label>{{ number_format(round($this->share_number,2)) }}</label>
            </div>
            <div class="mb-4">
                <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Sale Price (Per Share):</b></label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Sale Price" wire:model="share_price">
                @error('share_price') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="share_sold" class="block text-gray-700 text-sm font-bold mb-2"><b>Shares Sold:</b></label>
                <input type="number" id="share_sold" min="1" max="{{ $this->share_number }}" data="{{ $this->share_number }}" class="share_number shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_sold">
                @error('share_sold') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date of Sale:</b></label>
                <input type="date" max="{{date('Y-m-d')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeSellModal()">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="addsell()" wire:loading.attr="disabled">
            {{ __('Sell') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>



