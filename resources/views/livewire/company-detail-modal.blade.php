{{-- Company Detail Modal --}}
<x-jet-dialog-modal wire:model="isCompanyOpen">
    <x-slot name="title">
        {{ __('Company Detail') }}
{{--        <button wire:click="editStock({{$this->stock_id}})" class="justify-end float-right"><i class="fa fa-edit"></i></button>--}}
        @if($this->stock_id)
        <div class="justify-end">
            <div class="right-2" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                <div @click="open = ! open">
                    <span
                        class="inline-flex rounded-md text-gray-500 opacity-80 hover:opacity-100 cursor-pointer text-lg">
                        <i class="fa fa-ellipsis-v ml-2 -mr-0.5 h-4 w-4"></i>
                    </span>
                </div>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute z-50 mt-2 w-36 rounded-md shadow-lg origin-top-right right-0"
                     @click="open = false" style="display: none;">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                        <div>
                            <a class="border border-gray-100 text-center cursor-pointer text-sm text-blue-500 block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate"
                               wire:click="sell({{$this->stock_id}})">
                                {{ __('Sell Stock') }}
                            </a>

                            <a class="border border-gray-100 text-center cursor-pointer text-sm block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate"
                               wire:click="buy({{$this->stock_id}})">
                                {{ __('Buy Stock') }}
                            </a>

                            <a class="border border-gray-100 text-center cursor-pointer text-sm text-green-500 block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate"
                               style="border-top: none"
                               wire:click="editStock({{$this->stock_id}})">
                                {{ __('Edit Stock') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </x-slot>
    <x-slot name="content">
        <!-- Role -->
        <div class="col-span-6 lg:col-span-4">
            <div class="mb-4">
                <div class="rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                    {{$this->stock_ticker}}
                </div>
                <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
                    <p class="font-bold">{{$this->stock_ticker}}</p>
                    <p class="text-sm text-gray-700 mt-1 italic">{{$this->company_name}}</p>

                    @if($this->issuetype)
                        <p class="text-sm text-gray-700 mt-1 italic">{{convertType($this->issuetype)}}</p>
                    @endif

                    @if($this->share_number)
                        <p class="text-sm text-gray-700 mt-1">{{round($this->share_number, 2)  }} @if($this->share_number>1) Shares @else Share @endif</p>
                    @endif

                    @if($this->current_share_price)
                        <p class="m-2"><b>Current Share Price: </b> ${{$this->current_share_price}}</p>
                    @endif

                    @if($this->average_cost)
                        <p class="m-2"><b>Average Purchase Price: </b> ${{$this->average_cost}}</p>
                    @endif

                    @if($this->sector)
                        <p class="m-2"><b>Sector: </b> {{$this->sector}}</p>
                    @endif

                    @if($this->market_cap)
                        <p class="m-2"><b>Market cap: </b> {{$this->market_cap}}</p>
                    @endif

                    @if($this->description)
                        <p class="text-gray-700 mt-1">{{$this->description}}</p>
                    @endif
                </div>
            </div>
            <div class="w-full text-center px-4 lg:px-8 my-2">
                <div class="m-1"><b>Tags:</b></div>
                @if(!empty($this->alltags))
                    @foreach($this->alltags as $t)
                        <div class="mr-2 my-2 inline-block">
                            <div class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-sm text-gray-800 tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                {{ $t }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

{{--            <div class="mb-4">--}}
{{--                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Stock Ticker:</b></label>--}}
{{--                <label>{{$this->stock_ticker}}</label>--}}
{{--            </div>--}}
{{--            <div class="mb-4">--}}
{{--                <label for="companyname" class="block text-gray-700 font-bold mb-2"><b>Company Name:</b></label>--}}
{{--                <label>{{$this->company_name}}</label>--}}
{{--            </div>--}}
{{--            @if($this->description)--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="description" class="block text-gray-700 font-bold mb-2"><b>Description:</b></label>--}}
{{--                    <label>{{$this->description}}</label>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            @if($this->issuetype)--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="issuetype" class="block text-gray-700 font-bold mb-2"><b>Issue Type:</b></label>--}}
{{--                    <label>{{convertType($this->issuetype)}}</label>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            @if($this->sector)--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="sector" class="block text-gray-700 font-bold mb-2"><b>Sector:</b></label>--}}
{{--                    <label>{{$this->sector}}</label>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            @if($this->market_cap)--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="marketcap" class="block text-gray-700 font-bold mb-2"><b>Market cap:</b></label>--}}
{{--                    <label>{{$this->market_cap}}</label>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            @if($this->alltags)--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="tage" class="block text-gray-700 font-bold mb-2"><b>Tags:</b></label>--}}
{{--                    @if(!empty($this->alltags))--}}
{{--                        @foreach($this->alltags as $t)--}}
{{--                            <label>{{$t}}</label><br>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="mb-4">--}}
{{--                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Current Share Price:</b></label>--}}
{{--                <label>${{$this->current_share_price}}</label>--}}
{{--            </div>--}}
{{--            <div class="mb-4">--}}
{{--                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Average Purchase Price:</b></label>--}}
{{--                <label>${{$this->average_cost}}</label>--}}
{{--            </div>--}}
{{--            <div class="mb-4">--}}
{{--                <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Number of Shares:</b></label>--}}
{{--                <label>{{$this->share_number}}</label>--}}
{{--            </div>--}}
{{--            <x-jet-button wire:click="sell({{ $this->stock_id }})" class="py-2 px-4">{{__('Sell')}}</x-jet-button>--}}
{{--            <x-jet-button wire:click="buy({{ $this->stock_id }})" class="py-2 px-4">{{__('Buy')}}</x-jet-button>--}}
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeCompanyModal()">
            {{ __('Close') }}
        </x-jet-secondary-button>

    </x-slot>
</x-jet-dialog-modal>
{{-- Company Detail Modal --}}
