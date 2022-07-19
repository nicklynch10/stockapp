@php

    $dLosss = ($toploss['current_share_price'] * $toploss['share_number']) - ($toploss['ave_cost'] * $toploss['share_number']);
    $pLoss = abs((($toploss['current_share_price'] / $toploss['ave_cost'])-1)*100);

    $potentialSavings = $dLosss * 40 / 100;
    if ($toploss['type'] == 0) {

        $getCompareData = getRelated_stock_etf($toploss['stock_ticker']);

    }
@endphp

<div class="m-2">
    <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between"
        style="min-width: 100px; ">
        <div class="mt-3 my-1">
            <div class="float-right xs:flex-col xl:flex-col md:flex-col pr-3">
                <a wire:click="confirmCompleteSection( {{ $toploss['id'] }} )"
                   class="tooltip cursor-pointer text-green-600 mr-2" title="Add Completed Section"><span
                        class="font-bold"><i class="fa fa-check"></i></span></a>
                {{--                                                    </div>--}}
                {{--                                                    <div class="flex flex-col float-right xs:flex-col xl:flex-col md:flex-col pr-3">--}}
                <a wire:click="confirmIgnoreSection( {{ $toploss['id'] }} )" class="tooltip cursor-pointer"
                   title="Add Ignored Section"><span class="font-bold">X</span></a>
            </div>
            <div class="flex flex-col items-center xs:flex-col xl:flex-col md:flex-col">
                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                    @php
                        $string = $toploss['ticker_logo'];
                        if (strpos($string, "http") === 0) {
                            $logoUrl = $toploss['ticker_logo'];
                        }
                    @endphp
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        @if(isset($logourl))
                            <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                        @else
                            @php
                                $count= strlen($toploss["stock_ticker"])
                            @endphp
                            <div class="{{ $count > 7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                <span class="break-all">{{ strtoupper($toploss["stock_ticker"])}}</span>
                            </div>
                        @endif
                    </h5>
                    <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                        <a class="whitespace-normal">{{ strtoupper($toploss["stock_ticker"]) }}</a>
                    </h5>
                    @php
                        $companyname=explode('-',$toploss['security_name'])
                    @endphp
                    <p class="mb-1 break-words text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">
                        @if($toploss['security_name'] != null && convertType($toploss['issuetype']) == "ETF")
                            {{ isset($companyname[1]) ? $companyname[1] : $companyname[0] }}
                        @else
                            {{ $toploss['company_name'] }}
                        @endif
                    </p>
                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $toploss["total_long_term_gains"] }}</p>
                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $toploss["account"]['account_name'] }}    </p>
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
                                        <p class="break-all text-green-700">
                                            ${{ number_format(abs($potentialSavings),2) }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @if(count($getCompareData['stock'])>0 || count($getCompareData['etf'])>0)
                        <div class="flex flex-col justify-between p-4 leading-normal align items-center"
                             style="width: 255px">
                            <p class="border-dash w-60"></p>
                            @if(count($getCompareData['stock'])>0)
                                <p class="mb-1 break-words break-all py-1 text-center text-lg font-sans font-light text-gray-900">
                                    Comparable Stocks</p>
                                <div class="flex-row w-60 text-center">
                                    @foreach($getCompareData['stock'] as $cs)
                                        <button wire:click="$emit('company', '{{ $cs }}')"><span
                                                class="custome-border">{{ $cs }}</span></button>
                                    @endforeach
                                </div>
                            @endif
                            @if(count($getCompareData['etf'])>0)
                                <p class="my-2 break-words break-all py-1 text-center text-lg font-sans font-light text-gray-900">
                                    Comparable ETFs</p>
                                <div class="flex-row w-60 text-center">
                                    @foreach($getCompareData['etf'] as $ce)
                                        <button wire:click="$emit('company', '{{ $ce }}')"><span
                                                class="custome-border">{{ $ce }}</span></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="flex flex-col justify-between leading-normal align items-center" style="width: 255px">
                        <a href="{{ route('analyzeticker', ['ticker' => $toploss["stock_ticker"]]) }}"
                           class="mb-1 cursor-pointer break-words break-all py-1 text-center underline text-sm font-sans font-light text-gray-900">View
                            More Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="confirmIgnoreSection" wire:click.away="cancelIgnoreSection">
        <x-slot name="title">
            {{ __('Mark as ignored') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Mark as ignored') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelIgnoreSection()" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="ignoreSection()" wire:loading.attr="disabled">
                {{ __('yes') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    <x-jet-dialog-modal wire:model="confirmCompleteSection" wire:click.away="cancelCompleteSection">
        <x-slot name="title">
            {{ __('Mark As Complete') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Mark As Complete') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelCompleteSection()" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="completeSection()" wire:loading.attr="disabled">
                {{ __('yes') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>