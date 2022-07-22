<div>
    <link rel="stylesheet" type="text/css" href="/css/animated.css"/>
    <div class="mt-8">

        <div class="grid grid-cols-1 gap-4 justify-center xs:flex-col xs:flex xs:text-center xs:justify-center m-2">
            <div class="col-start-1 col-span-1 xs:flex-col xs:flex xs:text-center xs:justify-center bg-white shadow-2xl rounded">
                <div class="flex justify-between items-center w-full border-b-2 border-gray-300 mb-2 mt-6">
                    @if($etfs)
                        <h2 class="text-xl font-black">Comparable ETFs to {{$companyname}}</h2>
                    @else
                        <h2 class="text-xl font-black">Comparable Stocks to {{$companyname}}</h2>
                    @endif
                    <a wire:click="showETFs" class="bg-green-300 inline-flex items-center px-4 py-2 mb-2 bg-white border border-gray-300 mr-2 ml-2 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition cursor-pointer" id="buttons">
                        @if($etfs)
                            {{ __('Show Stocks Only') }}
                        @else
                            {{ __('Show ETFs Only') }}
                        @endif
                    </a>
                    <div class="flex justify-center items-center spinner hidden mt-2 mb-2 mr-5" id="spinner">
                        <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-green-500 spinner" id="spinner" role="status" aria-hidden="true">
                            <span class="visually-hidden">.</span>
                        </div>
                    </div>
                </div>




                    <div wire:init="init2" class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 lg:grid-cols-3 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">

                        @if($ticker != "" & count($correlation)>0)
                        @if ($loadData)
                            @foreach($correlation->sortByDesc("correlation")->unique() as $result)

                            @php $result = App\Models\SecCompare::find($result['id']); @endphp
                            
                            @if(isset($result) && isset($result->ticker2) && $result->ticker2 != $ticker)
                                <div class="m-2">
                                    <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                                        <div class="mt-3 my-1">
                                            <div class="flex flex-row items-center xs:flex-col">
                                                <div wire:click="$emit('company', '{{ $result->ticker2 }}')" class="flex flex-col cursor-pointer justify-between p-4 leading-normal align items-center xs:w-full md:w-2/5 xl:w-2/5" style="background: #f3f4f6">
                                                    @php
                                                        $string = $result->ticker2;
                                                        if (strpos($string, "http") === 0) {
                                                            $logoUrl = $result->ticker2;
                                                        }
                                                    @endphp
                                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                        @if(isset($logourl))
                                                            <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                                                        @else
                                                            @php
                                                                $count= strlen($result->ticker2)
                                                            @endphp
                                                            <div class="{{ $count>7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-white flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                                                <span class="break-all">{{strtoupper($result->ticker2)}}</span>
                                                            </div>
                                                        @endif
                                                    </h5>
                                                    <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                                        <a class=" cursor-pointer whitespace-normal">{{ strtoupper($result->ticker2) }}</a>
                                                    </h5>
                                                    @php
                                                        $companyName = explode('-', $result->SI2->security_name);
                                                    @endphp
                                                    <span class="mb-1 break-words text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">
                                                        @if($result->SI2->security_name != null && $result->SI2->type == "ETF")
                                                            {{ isset($companyName[1]) ? $companyName[1] : $companyName[0] }}
                                                        @else
                                                            {{ $result->SI2->company_name }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="flex flex-col justify-between leading-normal xs:w-full md:pl-3 xl:pl-15 md:w-3/5 xl:w-3/5">
                                                    <div class="flow-root">
                                                        <ul role="list" class="divide-y divide-gray-200 m-2 dark:divide-gray-700">
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <span class="text-sm font-medium text-black-900 break-all dark:text-white">Correlation with {{$ticker}}:</span>
                                                                    </div>
                                                                    <div class="inline-flex items-center break-all text-sm">
                                                                        <span class="break-all">{{pct_format($result->correlation)}}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <span class="text-sm font-medium text-black-900 break-all dark:text-white">Beta:</span>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm">{{acct_format($result->SI2->beta)}}</div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <span class="text-sm font-medium text-black-900 break-all dark:text-white">Dividend Yield:</span>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm">{{number_format($result->SI2->div_yield*100,2).'%'}}</div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <span class="text-sm font-medium text-black-900 break-all dark:text-white">
                                                                            @if($etfs)
                                                                                AUM:
                                                                            @else
                                                                                Market Cap:
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm text-black">${{number_format($result->SI2->marketcap/1000,0).'M'}}</div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <span class="text-sm font-medium text-black-900 break-all dark:text-white">
                                                                            @if($etfs)
                                                                                Expense Ratio:
                                                                            @else
                                                                                PE Ratio:
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm text-black">
                                                                        {{ acct_format($result->SI2->peRatio) }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1">
                                                                        <span class="text-sm font-medium text-black-900 break-all dark:text-white">1 Year % Change:</span>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm text-right {{$result->SI2->year1ChangePercent*100<0? "text-red-600":"text-green-600"}}">{{pct_format($result->SI2->year1ChangePercent)}}</div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1">
                                                                        <span class="text-sm font-medium text-black-900 break-all dark:text-white">Total Weight:</span>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm text-right">{{acct_format($result->total_weights)}}</div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-1 sm:py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="items-center break-words text-center text-sm">
                                                    @php
                                                        $data = $tag;
                                                        $inarr = false;
                                                    @endphp
                                                    @if(isset($result->SI2['company_tags']))
                                                    @foreach(json_decode($result->SI2['company_tags']) as $g)
                                                        <div class="mr-1 mb-1 inline-block">
                                                            <div class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-sm text-gray-800 tracking-widest focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150" style="background: {{ $inarr == true ? "#4fed4f47" : "#f3f4f6" }}">
                                                                {!! $inarr == true ? "<b>".$g."</b>" : "".$g."" !!}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-1 sm:py-4">
                                            <div class="flex items-center space-x-4">
                                                <div id="bar-1" class="bar-main-container azure mt-8">
                                                    <div class="">
                                                        <div class="flex flex-col w-full items-center justify-center">
                                                            <div class="flex justify-between items-center w-full">
                                                                <div class="text-sm font-semibold">{{dollar_format($result->SI2->week52Low)}}</div>
                                                                <div class="text-sm font-medium text-brand-grey-base text-center mx-2">52-Week Price Range</div>
                                                                <div class="text-sm font-semibold">{{dollar_format($result->SI2->week52High)}}</div>
                                                            </div>
                                                            <div class="flex w-full h-1 bg-gradient-to-r from-brand-tango to-brand-green-dark rounded-lg"></div>
                                                            <div class="w-full relative">
                                                                @php
                                                                    $val = ceil((int)$result->SI2->iexClose);
                                                                    if($val > 700)
                                                                    {
                                                                       if($val > 1000)
                                                                       {
                                                                           $left = (int)$result->SI2->iexClose/1000;
                                                                       }
                                                                       else
                                                                       {
                                                                           $left = (int)$result->SI2->iexClose/100;
                                                                       }
                                                                    }
                                                                    elseif($val >100)
                                                                    {
                                                                        $left = (int)$result->SI2->iexClose/10;
                                                                    }
                                                                    else
                                                                    {
                                                                        $left = (int)$result->SI2->iexClose;
                                                                    }
                                                                @endphp
                                                                <div class="w-4 overflow-hidden absolute" style="left:{{$left}}%">
                                                                    <div class=" h-2 w-2 bg-black rotate-45 transform origin-bottom-left"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif(!isset($result->ticker2))
                                <div class="px-4 py-2 px-6 py-3 text-center font-bold text-lg">
                                    <span>No Data Found</span>
                                </div>
                                @break
                            @endif
                        @endforeach
                    </div>
                    @else
                        <div class="px-4 py-2 px-6 py-3 text-center font-bold text-lg">
                            <span>No comparable stocks found</span>
                        </div>
                    @endif
                @else
                    <div class="px-4 py-2 px-6 py-3 text-center font-bold text-lg">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-rose-500 focus:border-rose-700 active:bg-rose-700 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading...
                        </button>
                    </div>
                @endif
            </div>
        </div>
        {{--  Company Detail  --}}
        @livewire('company-detail-modal')
        {{-- End Company detail  --}}
    </div>


