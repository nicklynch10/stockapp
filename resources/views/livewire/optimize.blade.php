<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Optimize')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <style>
        .circleBase {
            border-radius: 50%;
        }
        .circle1 {
            width: 20px;
            height: 20px;
            background: #FDE14DFF;
            border: 1px solid #FDE14DFF;
        }
        .circle2 {
            width: 20px;
            height: 20px;
            background: red;
            border: 1px solid red;
        }
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            top: -5px;
            right: 105%;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>
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
                                                    <div class="flex flex-col float-right xs:flex-col xl:flex-col md:flex-col">
                                                        @if($tl['share_number'] == 0)
                                                            @php
                                                                $todaydate = \Carbon\Carbon::now()->format('Y-m-d');
                                                                $beforeDate = date('Y-m-d', strtotime('-31 day'));
                                                                $selldate = App\Models\Transaction::where(['stock_id' => $tl['id'], 'type' => 1])->first();
                                                            @endphp
                                                            @if($selldate != null)
                                                                @if(($selldate['date_of_transaction'] <= $todaydate) && ($selldate['date_of_transaction'] >= $beforeDate))
                                                                    <div class="circleBase circle2 tooltip">
                                                                        <span class="tooltiptext">You sold this security within 30 days. Purchasing it again would likely trigger a wash sale</span>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <div class="circleBase circle1 tooltip">
                                                                <span class="tooltiptext">You currently own shares of this security</span>
                                                            </div>
                                                         @endif
                                                    </div>
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
                                                                    <div class="{{ $count > 7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                                                        <span class="break-all">{{ strtoupper($tl["ticker"])}}</span>
                                                                    </div>
                                                                @endif
                                                            </h5>
                                                            <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                                                <a class="whitespace-normal" >{{ strtoupper($tl["ticker"]) }}</a>
                                                            </h5>
                                                            @php
                                                                $companyname=explode('-',$tl['security_name']);
                                                            @endphp
                                                            <p class="mb-1 break-words text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">
                                                                @if($tl['security_name'] != null && convertType($tl['issuetype']) == "ETF")
                                                                    {{ isset($companyname[1]) ? $companyname[1] : $companyname[0] }}
                                                                @else
                                                                    {{ $tl['company_name'] }}
                                                                @endif
                                                            </p>
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
                                                                                <p class="break-all text-red-700">(${{ number_format(abs($tl['dloss']),2) }})</p>
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
                                                                                <p class="break-all text-red-700">({{ number_format(abs($tl['ploss']),2) }}%)</p>
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
                                                            @if(count(json_decode($tl['compare_stock']))>0 || count(json_decode($tl['compare_eft']))>0)
                                                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                                                    <p class="border-dash w-60"></p>
                                                                    @if(count(json_decode($tl['compare_stock']))>0)
                                                                        <p class="mb-1 break-words break-all py-1 text-center text-lg font-sans font-light text-gray-900">Comparable Stocks</p>
                                                                        <div class="flex-row w-60 text-center">
                                                                            @foreach(json_decode($tl['compare_stock']) as $cs)
                                                                                <button wire:click="$emit('company', '{{ $cs }}')"><span class="custome-border">{{ $cs }}</span></button>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                    @if(count(json_decode($tl['compare_eft']))>0)
                                                                        <p class="my-2 break-words break-all py-1 text-center text-lg font-sans font-light text-gray-900">Comparable ETFs</p>
                                                                        <div class="flex-row w-60 text-center">
                                                                            @foreach(json_decode($tl['compare_eft']) as $ce)
                                                                                <button wire:click="$emit('company', '{{ $ce }}')"><span class="custome-border">{{ $ce }}</span></button>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h2 class="text-lg text-black text-center"><i class="fa fa-chart-line"></i> Not found</h2>
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
</main>
