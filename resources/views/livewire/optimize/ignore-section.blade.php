<div>
    <main class="p-0 m-0 flex-grow ">
        @if(isset($stockData) && $stockData->count() > 0)
        <div class="mx-auto px-4 py-2 md:py-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="flex flex-col  bg-white sm:rounded-lg col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                        <div class="py-4 border-b-2 border-gray-300 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="inline-flex items-center space-x-2 float-left">
                                <p class="text-xl font-bold">Ignore Section</p>
                            </div>
                        </div>
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="w-full mb-5 overflow-y-scroll" style="height: 500px;">
                                    <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">
                                        @foreach($stockData as $tl)
                                            <div class="m-2">
                                                <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                                                    <div class="mt-3 my-1">
                                                        <div class="float-right xs:flex-col xl:flex-col md:flex-col pr-3">
                                                            <a wire:click="confirmSection( {{ $tl['id'] }} )" class="tooltip cursor-pointer " title="Add Section"><span class="font-bold"><i class="fa fa-plus"></i></span></a>
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
                                                                            $count= strlen($tl["stock_ticker"])
                                                                        @endphp
                                                                        <div class="{{ $count > 7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                                                            <span class="break-all">{{ strtoupper($tl["stock_ticker"])}}</span>
                                                                        </div>
                                                                    @endif
                                                                </h5>
                                                                <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                                                    <a class="whitespace-normal" >{{ strtoupper($tl["stock_ticker"]) }}</a>
                                                                </h5>
                                                                @php
                                                                    $companyname=explode('-',$tl['security_name'])
                                                                @endphp
                                                                <p class="mb-1 break-words text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">
                                                                    @if($tl['security_name'] != null && convertType($tl['issuetype']) == "ETF")
                                                                        {{ isset($companyname[1]) ? $companyname[1] : $companyname[0] }}

                                                                    @else
                                                                        {{ $tl['company_name'] }}
                                                                    @endif
                                                                </p>
                                                                <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $tl["long_term_gain"] }}</p>
                                                                <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $tl["account"]['account_name'] }}	</p>
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
                                                                                    <p class="break-all text-red-700">(${{ number_format(abs($tl["viewupdatestock"]['total_gain_loss']),2) }})</p>
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
                                                                                    <p class="break-all text-red-700">({{ number_format(abs($tl["viewupdatestock"]['pchange']),2) }}%)</p>
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
                                                                                    <p class="break-all text-green-700">{{ dollar_format(abs($tl["viewupdatestock"]['total_gain_loss']* 40 / 100)) }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                @if($tl['type'] == 0)
                                                                    @php
                                                                        $getCompareData = getRelated_stock_etf($tl['stock_ticker']);
                                                                    @endphp
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
                                                                @endif
                                                                <div class="flex flex-col justify-between leading-normal align items-center" style="width: 255px">
                                                                    <a href="{{ route('analyzeticker', ['ticker' => $tl["stock_ticker"]]) }}" class="mb-1 cursor-pointer break-words break-all py-1 text-center underline text-sm font-sans font-light text-gray-900">View More Info</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                            @if($hasMorePagesIgnore)
                                                <div class="text-center">
                                                    <div wire:loading>
                                                        <p>Loading...</p>
                                                    </div>
                                                </div>

                                                <div
                                                    x-data="{
                                    observe () {
                                        let observer = new IntersectionObserver((entries) => {
                                            entries.forEach(entry => {
                                                if (entry.isIntersecting) {
                                                    @this.call('loadMoreIgnore')
                                                }
                                            })
                                        }, {
                                            root: null
                                        })

                                        observer.observe(this.$el)
                                    }
                                }"
                                                    x-init="observe"
                                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-4"
                                                >
                                                </div>
                                            @endif
                                    </div>
{{--                                    {!! $links !!}--}}
                            </div>
                        </div>
                </div>
            </div>
        </div>
        @endif
    </main>
    <x-jet-dialog-modal wire:model="confirmSection" wire:click.away="cancelSection">
        <x-slot name="title">
            {{ __('Add Section') }}
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
