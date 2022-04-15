
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Portfolio')}}
    </h2>
</x-slot>

<main class="p-0 m-0 flex-grow ">
    <div class="mx-auto px-4 py-2 md:py-12">
{{--        <div class="flex flex-col sm:rounded-lg px-4 py-4">--}}
{{--            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">--}}
{{--                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">--}}
{{--                    @if (session()->has('message'))--}}
{{--                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">--}}
{{--                            <div class="flex">--}}
{{--                                <div>--}}
{{--                                    <p class="text-sm">{!! session('message') !!}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <x-jet-button wire:click="create()" class="py-2 px-4 my-3" id="add">{{__('Buy New Stock') }}</x-jet-button>--}}
{{--                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">--}}
{{--                        <table class="stock">--}}
{{--                            <thead class="bg-gray-300 xs:hidden">--}}
{{--                                <tr>--}}
{{--                                    <th class="px-6 py-4">Ticker</th>--}}
{{--                                    <th class="px-6 py-4">Company Name</th>--}}
{{--                                    <th class="px-6 py-4">Cost Basis </th>--}}
{{--                                    <th class="px-6 py-4">Number of Shares</th>--}}
{{--                                    <th class="px-6 py-4">Issue Type</th>--}}
{{--                                    <th class="px-6 py-4">Date</th>--}}
{{--                                    <th class="px-6 py-4"></th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--                                @forelse($stocks as $stock)--}}
{{--                                    @if($stock->share_number!=0)--}}
{{--                                        @php--}}
{{--                                            $companyname=explode('-',$stock->security_name)--}}
{{--                                        @endphp--}}
{{--                                        <tr class="xs:flex xs:flex-col xs:border-2-solid-black xs:border-r-11 xs:mb-2">--}}
{{--                                            <td data-label="Ticker" class="px-6 py-2 whitespace-nowrap text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $stock->id }})">{{ $stock->stock_ticker }}</a></td>--}}
{{--                                            <td data-label="Company Name" class="px-6 py-2 whitespace-nowrap text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $stock->id }})">{{$stock->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$stock->company_name}}</a></td>--}}
{{--                                            <td data-label="Cost Basis" class="px-6 py-2 whitespace-nowrap text-center text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">${{ number_format($stock->ave_cost,2) }}</td>--}}
{{--                                            <td data-label="Number of Shares" class="px-6 py-2 whitespace-nowrap text-center text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">{{ $stock->share_number }}</td>--}}
{{--                                            <td data-label="Issue Type" class="px-6 py-2 whitespace-nowrap text-center text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3"> {{$stock->issuetype}} </td>--}}
{{--                                            <td data-label="Date" class="px-6 py-2 whitespace-nowrap text-center text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">{{ \Carbon\Carbon::createFromTimestamp(strtotime($stock->date_of_purchase))->format('F jS, Y')}}</td>--}}
{{--                                            <td data-label="" class="px-6 py-2 whitespace-nowrap text-center text-gray-900 lastcoloumn xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">--}}
{{--                                                <x-jet-button wire:click="sell({{ $stock->id }})" class="py-2 px-4">{{__('Sell')}}</x-jet-button>--}}
{{--                                                <x-jet-button wire:click="buy({{ $stock->id }})" class="py-2 px-4">{{__('Buy')}}</x-jet-button>--}}
{{--                                                <a class="tooltip py-2 px-4" title="Edit Stock" wire:click="editStock({{ $stock->id }})"><i class="fa fa-edit cursor-pointer"></i></a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}
{{--                                @empty--}}
{{--                                    <tr>--}}
{{--                                        <td class="border px-4 py-2 text-center" colspan="7"><b>No Stock Found</b></td>--}}
{{--                                    </tr>--}}
{{--                                @endforelse--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
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

                            <div class="grid grid-cols-8 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-8 lg:grid-cols-8 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">
                                @foreach($stocks as $s)
                                    @if($s->share_number!=0)
                                        @php
                                            $companyname=explode('-',$s->security_name)
                                        @endphp
                                        <div class="m-2">
                                            <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start  flex flex-col justify-between" style="min-width: 100px; ">
                                                <div class="mt-3 my-2">
                                                    <div class="flex justify-center">
                                                        <img src="https://storage.googleapis.com/iex/api/logos/{{ $s->stock_ticker }}.png" class="rounded-full object-cover hover:bg-gray-100 h-16">
                                                    </div>
                                                    <div class="text-center p-1 mt-1">
                                                        <a class="cursor-pointer text-black font-black hover:bg-gray-100 text-xl" wire:click="company({{ $s->id }})">
                                                            {{ $s->stock_ticker }}
                                                        </a>
                                                        <p class="pb-2 text-sm font-sans font-light text-grey-dark italic sm:text-xs">
                                                            {{ $s->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$s->company_name }}
                                                        </p>
                                                        <p class="pb-2 text-sm font-sans font-light text-grey-dark italic sm:text-xs">
                                                            {{ $s->issuetype }}
                                                        </p>
                                                        <p class="pb-1 text-sm font-sans font-light text-green-600">
                                                            ${{ number_format($s->ave_cost,2) }}
                                                        </p>
                                                        <p class="text-sm font-sans font-light text-grey-dark">
                                                            {{ $s->share_number }} Shares
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
                                                    <a href="#" class="pl-1 pr-4">
                                                        <i class="fa-solid fa-edit text-blue-500 tooltip tooltipstered"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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
    <x-jet-confirmation-modal wire:model="deletestock">
        <x-slot name="title">
            {{ __('Delete Stock') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete stock?') }}
            <br><br>
            <span class="text-red-700">{{ __('Please note this will remove all transaction history associate with this stock. This cannot be undone.') }}</span>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closedeletestock()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete({{$this->deleteid}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- End Delete Stock --}}

    <x-jet-confirmation-modal wire:model="isAveOpen">
        <x-slot name="title">
            {{ __('Average Purchase Price') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to Change Average Purchase Price?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class="ml-2" wire:click="closeAveModal(1)" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-jet-button>

            <x-jet-danger-button class="ml-2"  wire:click="closeAveNoModal(1)" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</main>
















