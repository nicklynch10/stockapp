<main class="p-0 m-0 flex-grow ">
    <div class="mx-auto px-4 py-2 md:py-12 pt-10">
        <div class="grid grid-cols-12 gap-2">
            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5 overflow-hidden" style="height: 100%">
{{--                            <div class="grid border-b-2 border-gray-300 grid-cols-8 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-4 xl:grid-cols-8 lg:grid-cols-8 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">--}}
{{--                                <div class="flex justify-between items-center w-full">--}}
{{--                                    <h2 class="text-xl font-black">Your Portfolio</h2>--}}
{{--                                </div>--}}
{{--                                <div></div><div></div><div></div><div></div><div></div>--}}
{{--                                <div class="inline-flex items-center space-x-2">--}}
{{--                                    <select  wire:model="sortBy" class="shadow appearance-none border w-60 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                                        <option value="">Filter By Account</option>--}}
{{--                                        @foreach($this->account as $account)--}}
{{--                                            <option value="{{$account->id}}">{{$account->account_name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="text-center">--}}
{{--                                    <x-jet-button wire:click="create()" class="py-2 px-4 my-3" id="add">{{__('Buy New Stock') }}</x-jet-button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="grid border-b-2 border-gray-300 grid-cols-8 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-4 xl:grid-cols-8 lg:grid-cols-8 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">
                                <div class="col-start-1 col-span-1 sm:flex sm:flex-col sm:col-stat-1 md:col-start-1 flex justify-between items-center w-full">
                                    <h2 class="text-xl font-black">Your Portfolio</h2>
                                </div>
                                <div
                                    class="lg:col-start-7 xl:col-start-7 md:col-start-3 col-span-1 xs:col-start-1  inline-flex items-center xs:justify-right">
                                    <select  wire:model="sortBy" class="shadow appearance-none border w-60 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Filter By Account</option>
                                        @foreach($this->account as $account)
                                            <option value="{{$account->id}}">{{$account->account_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="lg:col-start-8 xl:col-start-8  md:col-start-4 col-span-1 xs:col-start-1 sm:text-center lg:text-center xl:text-center md:text-center xs:text-right">
                                    <x-jet-button wire:click="create()" class="py-2 px-3 my-3" id="add">{{__('Buy New Stock') }}</x-jet-button>
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
                                                                <a class="border border-gray-100 cursor-pointer text-sm text-black block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate "
                                                                   style="border-top: none" wire:click="sell({{ $s->id }})">
                                                                    {{ __('Sell Stock') }}
                                                                </a>

                                                                <a class="border border-gray-100 cursor-pointer text-sm text-blue-500 block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate "
                                                                   style="border-top: none" wire:click="buy({{ $s->id }})">
                                                                    {{ __('Buy Stock') }}
                                                                </a>

                                                                <a class="border border-gray-100 cursor-pointer text-sm text-green-500 block px-2 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out truncate "
                                                                   style="border-top: none" wire:click="editStock({{ $s->id }})">
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
                                                        }
                                                        ?>
                                                        @if(isset($logourl))
                                                            <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                                                        @else
                                                            @php
                                                                $count= strlen($s->stock_ticker)
                                                            @endphp
                                                            <div class="{{ $count>7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                                                <span class="break-all">{{ strtoupper($s->stock_ticker) }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="text-center p-1 mt-1">
                                                        <a class="cursor-pointer pb-2 text-black break-words font-black hover:bg-gray-100 xs:text-lg bold font-sans hover:bg-gray-100" wire:click="company({{ $s->id }})">
                                                            {{ strtoupper($s->stock_ticker) }}
                                                        </a>
                                                        <p class="pb-2 text-sm font-sans break-words font-light text-grey-dark italic sm:text-xs">
                                                            {{ $s->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$s->company_name }}
                                                        </p>
                                                        <p class="pb-2 text-sm font-sans break-words font-light text-grey-dark italic sm:text-xs">
                                                            {{ convertType($s->issuetype) }}
                                                        </p>
                                                        <p class="pb-1 text-sm font-sans break-words font-light text-green-600">
                                                            ${{ number_format($s->ave_cost * $s->share_number,2)}}
{{--                                                            ${{ number_format((int)$s->ave_cost,2) * round((int)$s->share_number, 2) }}--}}
                                                        </p>
                                                        <p class="text-sm font-sans break-words font-light text-grey-dark">
                                                            {{round($s->share_number, 2)  }} @if($s->share_number == 1) Share @else Shares @endif
                                                        </p>
                                                    </div>
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
        <div class="mt-5 flex flex-col sm:rounded-lg px-4 py-4 flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
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
    @livewire('stock-share-sell')
    {{-- End Stock Share Sell Confirmation --}}
</main>
