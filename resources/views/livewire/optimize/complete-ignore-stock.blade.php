@php

    $dLosss = ($completeIgnore['current_share_price'] * $completeIgnore['share_number']) - ($completeIgnore['ave_cost'] * $completeIgnore['share_number']);
    $pLoss = abs((($completeIgnore['ave_cost'] / $completeIgnore['ave_cost'])-1)*100);

    $potentialSavings = $dLosss * 40 / 100;
    if ($completeIgnore['type'] == 0) {

        $getCompareData = getRelated_stock_etf($completeIgnore['stock_ticker']);

    }
@endphp
{{--@if($dLosss < 0 && $pLoss > 3)--}}
    <div class="m-2">
            <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                <div class="mt-3 my-1">
                    <div class="flex flex-col float-left xs:flex-col xl:flex-col md:flex-col pl-3">

                        @if($completeIgnore['share_number'] == 0)
                            @php
                                $todaydate = \Carbon\Carbon::now()->format('Y-m-d');
                                $beforeDate = date('Y-m-d', strtotime('-31 day'));
                                $selldate = App\Models\Transaction::where(['stock_id' => $completeIgnore['id'], 'type' => 1])->first();
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
                    <div class="float-right xs:flex-col xl:flex-col md:flex-col pr-3">
                        <a wire:click="confirmSection( {{ $completeIgnore['id'] }} )" class="tooltip cursor-pointer " title="Add Section"><span class="font-bold"><i class="fa fa-plus"></i></span></a>
                    </div>
                    <div class="flex flex-col items-center xs:flex-col xl:flex-col md:flex-col">
                        <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                            @php
                                $string = $completeIgnore['ticker_logo'];
                                if (strpos($string, "http") === 0) {
                                    $logoUrl = $completeIgnore['ticker_logo'];
                                }
                            @endphp
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                @if(isset($logourl))
                                    <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                                @else
                                    @php
                                        $count= strlen($completeIgnore["stock_ticker"])
                                    @endphp
                                    <div class="{{ $count > 7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                        <span class="break-all">{{ strtoupper($completeIgnore["stock_ticker"])}}</span>
                                    </div>
                                @endif
                            </h5>
                            <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                <a class="whitespace-normal" >{{ strtoupper($completeIgnore["stock_ticker"]) }}</a>
                            </h5>
                            @php
                                $companyname=explode('-',$completeIgnore['security_name'])
                            @endphp
                            <p class="mb-1 break-words text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">
                                @if($completeIgnore['security_name'] != null && convertType($completeIgnore['issuetype']) == "ETF")
                                    {{ isset($companyname[1]) ? $companyname[1] : $companyname[0] }}

                                @else
                                    {{ $completeIgnore['company_name'] }}
                                @endif
                            </p>
                            <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $completeIgnore["long_term_gain"] }}</p>
                            <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $completeIgnore["account"]['account_name'] }}	</p>
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
                                                <p class="break-all text-red-700">(${{ number_format(abs($dLosss),2) }})</p>
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
                                                <p class="break-all text-red-700">({{ number_format(abs($pLoss),2) }}%)</p>
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
                                                <p class="break-all text-green-700">${{ number_format(abs($potentialSavings),2) }}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            @if(count($getCompareData['stock'])>0 || count($getCompareData['etf'])>0)
                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                    <p class="border-dash w-60"></p>
                                    @if(count($getCompareData['stock'])>0)
                                        <p class="mb-1 break-words break-all py-1 text-center text-lg font-sans font-light text-gray-900">Comparable Stocks</p>
                                        <div class="flex-row w-60 text-center">
                                            @foreach($getCompareData['stock'] as $cs)
                                                <button wire:click="$emit('company', '{{ $cs }}')"><span class="custome-border">{{ $cs }}</span></button>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if(count($getCompareData['etf'])>0)
                                        <p class="my-2 break-words break-all py-1 text-center text-lg font-sans font-light text-gray-900">Comparable ETFs</p>
                                        <div class="flex-row w-60 text-center">
                                            @foreach($getCompareData['etf'] as $ce)
                                                <button wire:click="$emit('company', '{{ $ce }}')"><span class="custome-border">{{ $ce }}</span></button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div class="flex flex-col justify-between leading-normal align items-center" style="width: 255px">
                                <a href="{{ route('analyzeticker', ['ticker' => $completeIgnore["stock_ticker"]]) }}" class="mb-1 cursor-pointer break-words break-all py-1 text-center underline text-sm font-sans font-light text-gray-900">View More Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-jet-dialog-modal wire:model="confirmSection" wire:click.away="cancelSection">
                <x-slot name="title">
                    {{ __('Add  Section') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('') }}
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="cancelSection()" wire:loading.attr="disabled">
                        {{ __('No') }}
                    </x-jet-secondary-button>

                    <x-jet-button class="ml-2" wire:click="section()" wire:loading.attr="disabled">
                        {{ __('yes') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-dialog-modal>
    </div>
{{--@endif--}}
