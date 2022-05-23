{{-- Company Detail Modal --}}
<x-jet-dialog-modal wire:model="isCompanyOpen">
    <x-slot name="title">
        {{ __('Compnay Detail') }}
        <button wire:click="editStock({{$this->stock_id}})" class="float-right"><i class="fa fa-edit"></i></button>
    </x-slot>


    <x-slot name="content">

        <!-- Role -->
        <div class="col-span-6 lg:col-span-4">
            <div class="mb-4">
                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Stock Ticker:</b></label>
                <label>{{$this->stock_ticker}}</label>
            </div>
            <div class="mb-4">
                <label for="companyname" class="block text-gray-700 font-bold mb-2"><b>Company Name:</b></label>
                <label>{{$this->company_name}}</label>
            </div>
            @if($this->description)
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2"><b>Description:</b></label>
                    <label>{{$this->description}}</label>
                </div>
            @endif
            @if($this->issuetype)
                <div class="mb-4">
                    <label for="issuetype" class="block text-gray-700 font-bold mb-2"><b>Issue Type:</b></label>
                    <label>{{$this->issuetype}}</label>
                </div>
            @endif
            @if($this->sector)
                <div class="mb-4">
                    <label for="sector" class="block text-gray-700 font-bold mb-2"><b>Sector:</b></label>
                    <label>{{$this->sector}}</label>
                </div>
            @endif
            @if($this->market_cap)
                <div class="mb-4">
                    <label for="marketcap" class="block text-gray-700 font-bold mb-2"><b>Market cap:</b></label>
                    <label>{{$this->market_cap}}</label>
                </div>
            @endif
            @if($this->alltags)
                <div class="mb-4">
                    <label for="tage" class="block text-gray-700 font-bold mb-2"><b>Tags:</b></label>
                    @if(!empty($this->alltags))
                        @foreach($this->alltags as $t)
                            <label>{{$t}}</label><br>
                        @endforeach
                    @endif
                </div>
            @endif
            <div class="mb-4">
                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Current Share Price:</b></label>
                <label>${{$this->current_share_price}}</label>
            </div>
            <div class="mb-4">
                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Average Purchase Price:</b></label>
                <label>${{$this->average_cost}}</label>
            </div>
            <div class="mb-4">
                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Number of Shares:</b></label>
                <label>{{$this->share_number}}</label>
            </div>
            <x-jet-button wire:click="sell({{ $this->stock_id }})" class="py-2 px-4">{{__('Sell')}}</x-jet-button>
            <x-jet-button wire:click="buy({{ $this->stock_id }})" class="py-2 px-4">{{__('Buy')}}</x-jet-button>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeCompanyModal()">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

    </x-slot>
</x-jet-dialog-modal>
{{-- Company Detail Modal --}}
