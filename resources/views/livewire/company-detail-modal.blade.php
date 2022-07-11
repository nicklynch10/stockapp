{{-- Company Detail Modal --}}
<x-jet-dialog-modal wire:model="isCompanyOpen">
    <x-slot name="title">
        {{ __('Company Details') }}
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
        @else
            <button wire:click="closeCompanyModal()" class="float-right"><i class="fa fa-close"></i></button>
        @endif
    </x-slot>
    <x-slot name="content">
        <!-- Role -->
        <div class="col-span-6 lg:col-span-4">
            <div class="mb-4">
                <?php
                $string = $this->tickerLogo;
                if (strpos($string, "http") === 0) {
                    $logoUrl = $this->tickerLogo;
                }
                ?>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    @if(isset($logourl))
                        <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                    @else
                        @php
                            $count= strlen($this->stock_ticker)
                        @endphp
                        <div class="{{ $count>7 ? "text-sm w-24 h-24" : "text-sm w-16 h-16" }} rounded-full text-center border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center flex-shrink-0 mx-auto">
                            <span class="break-all">{{$this->stock_ticker}}</span>
                        </div>
                    @endif
                </h5>
                <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
                    @php
                        $companyname=explode('-',$this->security_name);
                    @endphp
                    <p class="font-bold">{{$this->stock_ticker}}</p>
                    <p class="text-sm text-gray-700 mt-1 italic">
                        @if($this->security_name != null && convertType($this->issuetype) == "ETF")
                            {{ isset($companyname[1]) ? $companyname[1] : $companyname[0]}}
                        @else
                            {{ $this->company_name }}
                        @endif
                    </p>

                    @if($this->issuetype)
                        <p class="text-sm text-gray-700 mt-1 italic">{{convertType($this->issuetype)}}</p>
                    @endif

                    @if($this->share_number)
                        <p class="text-sm text-gray-700 mt-1">{{round($this->share_number, 2)  }} @if($this->share_number == 1) Share @else Shares @endif</p>
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
                        <p class="m-2"><b>Market cap: </b> ${{ number_format($this->market_cap, 2) }}M</p>
                    @endif

                    @if($this->description)
                        <p class="text-gray-700 mt-1">{{$this->description}}</p>
                    @endif
                </div>
            </div>
            @if(!empty($this->alltags))
            <div class="w-full text-center px-4 lg:px-8 my-2">
                <div class="m-1"><b>Tags:</b></div>
                    @foreach($this->alltags as $t)
                        <div class="mr-2 my-2 inline-block">
                            <div class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-sm text-gray-800 tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                {{ $t }}
                            </div>
                        </div>
                    @endforeach
            </div>
            @endif
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeCompanyModal()">
            {{ __('Close') }}
        </x-jet-secondary-button>

    </x-slot>
</x-jet-dialog-modal>
{{-- Company Detail Modal --}}
