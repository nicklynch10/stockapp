<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Optimize')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <div class="container mx-auto px-4 py-10 md:py-12 grid grid-cols-12 gap-2">
        <div class="flex flex-col bg-yellow-200 sm:rounded-lg px-4 py-4 col-start-1 col-span-4 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Potential Trades') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">{{ count($toploss) }}</h2>
                    </div>
                </div>
            </div>
        </div>
        {{-- Box1  --}}

        <div class="flex flex-col bg-green-300 sm:rounded-lg px-4 py-4 col-start-5 col-span-4 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Harvestable Losses') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">{{$this->harvestableLosses<0?"($".(number_format(abs($this->harvestableLosses),2)).")":"$".number_format($this->harvestableLosses,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>
        {{-- Box2  --}}

    </div>
    <div class="mx-auto px-4 py-2 md:py-12">
        <div class="grid grid-cols-12 gap-2">
            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="inline-flex items-center space-x-2 float-right">
                            <select  wire:model="sortBy" class="shadow appearance-none border w-60 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Filter By Account</option>
                                @foreach($this->account as $account)
                                    <option value="{{$account->id}}">{{$account->account_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full mb-5 overflow-hidden" style="height: 100%">
                            <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">
                                @if(isset($toploss) && count($toploss)>0)
                                    @foreach($toploss as $key=>$tl)
                                        <div class="m-2">
                                            <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                                                <div class="mt-3 my-1">
                                                    <div class="flex flex-col items-center xs:flex-col xl:flex-col md:flex-col">
                                                        <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                                            @php
                                                                $string = $tl['ticker_logo'];
                                                                if (strpos($string, "http") === 0) {
                                                                    $logoUrl = $tl['ticker_logo'];
                                                                }
                                                            @endphp
                                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                                @if(isset($logourl))
                                                                    <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                                                                @else
                                                                    @php
                                                                        $count= strlen($tl["ticker"])
                                                                    @endphp
                                                                    <div class="{{ $count>7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                                                        <span class="break-all">{{$tl["ticker"]}}</span>
                                                                    </div>
                                                                @endif
                                                            </h5>
                                                            <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                                                <a class="whitespace-normal" >{{ $tl["ticker"] }}</a>
                                                            </h5>
                                                            <p class="mb-1 break-words break-all text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">{{ $tl["company_name"] }}</p>
                                                            {{--                                                            <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ \Carbon\Carbon::createFromTimestamp(strtotime($tl["dateofpurchase"]))->format('F jS, Y') }}</p>--}}
                                                            <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $tl["long_term_gain"] }}</p>
                                                            <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $tl["account"] }}	</p>
                                                        </div>
                                                        <div class="flex flex-col justify-between p-4 leading-normal">
                                                            <div class="flow-root">
                                                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    $ Loss
                                                                                </p>
                                                                            </div>
                                                                            <div class="inline-flex items-center break-all text-sm">
                                                                                <p class="break-all text-red-700">(${{ number_format($tl['dloss'],2) }})</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    % Loss
                                                                                </p>
                                                                            </div>
                                                                            <div class="inline-flex items-center text-sm">
                                                                                <p class="break-all text-red-700">({{ number_format($tl['ploss'],2) }}%)</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    Potential Savings
                                                                                </p>
                                                                            </div>
                                                                            <div class="inline-flex items-center text-sm">
                                                                                <p class="break-all text-green-700">${{ number_format($tl['potentialSavings'],2) }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                                                <p class="border-dash w-60"></p>
                                                                <p class="mb-1 break-words break-all py-1 text-center text-lg font-sans font-light text-gray-900">Comparable Stocks / ETFs</p>
                                                                <div class="flex-row w-60">
                                                                    <button wire:click="$emit('company','AAPL')"><span class="custome-border">AAPL</span></button>
                                                                    <button wire:click="$emit('company','GOOGL')"><span class="custome-border">GOOGL</span></button>
                                                                    <button wire:click="$emit('company','SPY')"><span class="custome-border">SPY</span></button>
                                                                    <button wire:click="$emit('company','QQQ')"><span class="custome-border">QQQ</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h2 class="text-lg text-black text-center"><i class="fa fa-chart-line"></i> Not fount any optimize stock data</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  Company Detail  --}}
    @livewire('company-detail-modal')
    {{-- End Company detail  --}}
</main>
