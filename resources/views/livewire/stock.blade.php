


<main class="p-0 m-0 flex-grow ">
    <div class="mx-auto px-4 py-2 md:py-12 pt-10">
        <div class="grid grid-cols-12 gap-2">
            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5 overflow-hidden" style="height: 100%">
                            <div class="flex justify-between items-center w-full border-b-2 border-gray-300">
                                <h2 class="text-xl font-black">Your Stocks Portfolio</h2>
                                <div class="inline-flex items-center space-x-2">
                                    <x-jet-button wire:click="create()" class="py-2 px-4 my-3" id="add">{{__('Buy New Stock') }}</x-jet-button>
                                </div>
                            </div>

                            <div class="grid grid-cols-8 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-8 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">
                                @if(count($stocks)>0)
                                @foreach($stocks as $s)
                                    @if(round($s->share_number,2)!=0 && round($s->share_number,2)!=0.00)
                                        @php
                                            $companyname=explode('-',$s->security_name)
                                        @endphp
                                        <div class="m-2 text-center relative">
                                            <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 flex flex-col justify-between" style="min-width: 100px; ">
                                                <div class="absolute right-2 top-1.5" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                                                    <div @click="open = ! open">
                                                        <span
                                                            class="inline-flex rounded-md text-gray-500 opacity-80 hover:opacity-100 cursor-pointer text-sm">
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
                                                                <a class="border border-gray-100 cursor-pointer text-sm text-green-500 block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate "
                                                                   style="border-top: none"
                                                                   wire:click="editStock({{ $s->id }})">
                                                                    {{ __('Edit Stock') }}
                                                                </a>

                                                                <a class="cursor-pointer block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate text-sm text-red-500"
                                                                   wire:click="deletestock({{ $s->id }})">
                                                                    {{ __('Delete Stock') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3 my-2">
                                                    <div class="flex justify-center">
                                                        <?php
                                                        $string = $s->ticker_logo;
                                                        if (strpos($string, "http") === 0) {
                                                            $logoUrl = $s->ticker_logo;
                                                        } else {
                                                            $logoUrl = 'https://ui-avatars.com/api/?name='.$s->stock_ticker.'&color=7F9CF5&background=EBF4FF';
                                                        }
                                                        ?>
                                                        <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                                                    </div>
                                                    <div class="text-center p-1 mt-1">
                                                        <a class="cursor-pointer pb-2 text-black break-words font-black hover:bg-gray-100 xs:text-lg bold font-sans hover:bg-gray-100" wire:click="company({{ $s->id }})">
                                                            {{ $s->stock_ticker }}
                                                        </a>
                                                        <p class="pb-2 text-sm font-sans break-words font-light text-grey-dark italic sm:text-xs">
                                                            {{ $s->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$s->company_name }}
                                                        </p>
                                                        <p class="pb-2 text-sm font-sans break-words font-light text-grey-dark italic sm:text-xs">
                                                            {{ convertType($s->issuetype) }}
                                                        </p>
                                                        <p class="pb-1 text-sm font-sans break-words font-light text-green-600">
                                                            ${{ number_format($s->ave_cost,2) }}
                                                        </p>
                                                        <p class="text-sm font-sans break-words font-light text-grey-dark">
                                                            {{round($s->share_number, 2)  }} @if($s->share_number>1) Shares @else Share @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center text-sm mt-3 border-gray-200 border-t -my-2 p-2 text-gray-600">
                                                    <button type="submit" class="inline-flex items-center bg-green-800 border border-transparent rounded-full font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition py-1 px-2" wire:click="sell({{ $s->id }})">
                                                        Sell
                                                    </button>
                                                    <button type="submit" class="inline-flex items-center bg-green-800 border border-transparent rounded-full font-black text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition py-1 px-2" wire:click="buy({{ $s->id }})">
                                                        Buy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @else
                                    <div class="pt-3 text-lg text-center text-black"><i class="fa fa-chart-line"></i> No Stock Found</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Historical Trades') }}
                        </h2>
                    </div>
                    @livewire('historical-trades')
                </div>
            </div>
        </div>
    </div>


    {{--  Company Detail  --}}
    @livewire('company-detail-modal')
    {{-- End Company detail  --}}

    {{-- Stock Purchase Add  --}}
    @livewire('stock-add-edit-modal')
    {{--   End Stock Purchase Input  --}}

    {{-- Stock Sell Modal  --}}
    @livewire('stock-sell-modal')
    {{--   End Stock Sell Modal  --}}

    {{-- Stock Buy Modal  --}}
    @livewire('stock-buy-modal')
    {{--   End Stock Buy Modal  --}}

    {{-- Delete Stock --}}
    @livewire('stock-delete-modal')
    {{-- End Delete Stock --}}

    {{--  Ave price update confirmation  --}}
    @livewire('ave-cost-update')
    {{--  End Ave price update confirmation  --}}

    {{-- Stock Share Sell Confirmation --}}
    @livewire('stock-share-sell');
    {{-- End Stock Share Sell Confirmation --}}
</main>
