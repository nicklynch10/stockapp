<div>
    <div class="max-w-7xl mx-auto py-10 ">
        <style>
            .visually-hidden {
                position: absolute !important;
                width: 1px !important;
                height: 1px !important;
                padding: 0 !important;
                margin: -1px !important;
                overflow: hidden !important;
                clip: rect(0, 0, 0, 0) !important;
                white-space: nowrap !important;
                border: 0 !important;
            }

            .spinner-border {
                vertical-align: -0.125em;
                border: 0.25em solid;
                border-right-color: transparent;
            }

            .hidden {
                display: none;
            }
        </style>
        <x-jet-form-section submit="">
            <x-slot name="title">
                {{ __('Find Similar Stocks & ETFs') }}
            </x-slot>

            <x-slot name="description">
                {{ __('TaxGhost can help identify similar stocks & ETFs so you can tax loss harvest effectively') }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="ticker" value="{{ __('Enter Ticker to Compare') }}"/>
                    <input wire:model.debounce.2000ms="ticker"
                           type="ticker"
                           id="tickerbar"
                           autocomplete="off"
                           placeholder="Enter Ticker..."
                           class="focus:outline-none border-gray-200 p-1 py-2 w-2/4 sm:w-3/4 sm:mr-0 "
                           style="border-top:none; border-left: none; border-right: none; border-bottom: 2px solid #d1d5da; padding-bottom: 5px">
                    <span class="mdl-badge material-icons count_icon fa fa-search" wire:loading.class="hidden"
                          wire:target="ticker" id="search_icon"></span>
                    <x-jet-input-error for="ticker" class="mt-2"/>
                    <div wire:loading.delay.shortest wire:target="ticker">
                        <div
                            class="select-none text-sm text-indigo-500 flex flex-1 items-center justify-center text-center flex-1">
                            <svg class="animate-spin h-6 w-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('searching...') }}
                </x-jet-action-message>
            <!--
        <x-jet-button>
            {{ __('Search!') }}
                </x-jet-button> -->
            </x-slot>

        </x-jet-form-section>


        <div class="flex justify-between items-center w-full m-2 ml-3 p-2">
            <a wire:click="showETFs"
               class="bg-green-300 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition cursor-pointer"
               id="buttons">
                @if($etfs)
                    {{ __('Show Stocks Only') }}
                @else
                    {{ __('Show ETFs Only') }}
                @endif
            </a>
        </div>
        <div class="flex justify-center items-center spinner hidden mt-4" id="spinner">
            <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-green-500 spinner"
                 id="spinner" role="status" aria-hidden="true">
                <span class="visually-hidden">.</span>
            </div>
        </div>
    </div>

    {{--<div class="shadow overflow-auto border-b border-gray-200 sm: rounded-lg table-align mt-10">--}}
    {{--    <table>--}}
    {{--        <thead class="bg-gray-300">--}}
    {{--        <tr>--}}
    {{--            <th--}}
    {{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Stock Ticker / Name--}}
    {{--            </th>--}}
    {{--            <th--}}
    {{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Correlation @if($ticker != "")--}}
    {{--                    with {{$ticker}}@endif--}}
    {{--            </th>--}}
    {{--            <th--}}
    {{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Beta (S&P 500)--}}
    {{--            </th>--}}

    {{--            <th--}}
    {{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Dividend Yield--}}
    {{--            </th>--}}

    {{--            <th--}}
    {{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Market Cap / Assets Under Management--}}
    {{--                (AUM)--}}
    {{--            </th>--}}

    {{--            <th--}}
    {{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">PE Ratio--}}
    {{--            </th>--}}

    {{--            <th--}}
    {{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">1 Year % Change--}}
    {{--            </th>--}}
    {{--        </tr>--}}
    {{--        </thead>--}}
    {{--        <tbody class="bg-white divide-y divide-gray-200">--}}
    {{--        @if($ticker != "" & count($correlations)>0)--}}
    {{--            @foreach($correlations->sortByDesc("correlation")->slice(0, 200)->unique() as $result)--}}
    {{--                @if($result && isset($result->ticker2))--}}
    {{--                    <tr>--}}
    {{--                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$result->ticker2}}--}}
    {{--                            <br> {{$result->SI2->company_name}}</td>--}}
    {{--                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{number_format($result->correlation*100,0)}}--}}
    {{--                            %--}}
    {{--                        </td>--}}
    {{--                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{number_format($result->SI2->calced_beta,2)}}--}}
    {{--                            / {{number_format($result->SI2->beta,2)}}</td>--}}
    {{--                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{number_format($result->SI2->div_yield*100,2)}}--}}
    {{--                            %--}}
    {{--                        </td>--}}
    {{--                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">--}}
    {{--                            ${{number_format($result->SI2->marketcap/1000,0)}}M--}}
    {{--                        </td>--}}
    {{--                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">@if($result->SI2->peRatio >0){{number_format($result->SI2->peRatio,2)}}@else--}}
    {{--                                N/A @endif</td>--}}
    {{--                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{number_format($result->SI2->year1ChangePercent*100,2)}}--}}
    {{--                            %--}}
    {{--                        </td>--}}
    {{--                    </tr>--}}
    {{--                @else--}}
    {{--                    <tr>--}}
    {{--                        <th class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]" colspan="7">No data found</th>--}}
    {{--                    </tr>--}}
    {{--                    @break--}}
    {{--                @endif--}}
    {{--            @endforeach--}}
    {{--        @else--}}
    {{--            <tr>--}}
    {{--                <th colspan="7" class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]" >No data found</th>--}}
    {{--            </tr>--}}
    {{--        @endif--}}
    {{--        </tbody>--}}
    {{--    </table>--}}
    {{--</div>--}}
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">

        <div
            class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg bg-gray-100">
            <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5 overflow-hidden">
                        <div
                            class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-1 xl:grid-cols-1 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4 w-full mt-2 ">

                            @if($ticker != "" & count($correlations)>0)
                                @foreach($correlations->sortByDesc("correlation")->slice(0, 500) as $result)
                                    @if($result && isset($result->ticker2))
                                        <div class="m-2 relative">
                                            <div
                                                class="w-full shadow-sm h-full rounded shadow-xl overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between"
                                                style="min-width: 100px; ">
                                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                                    <li class="py-1 sm:py-4">
                                                        <div class="flex items-center space-x-4 px-8">
                                                            <div class="flex-1 min-w-0">
                                                                <label class="text-black">
                                                                    <b>Stock Ticker / Name:</b>
                                                                </label>
                                                            </div>
                                                            <div class="inline-flex items-center break-all text-sm">
                                                                <p class="break-all">{{$result->ticker2}}
                                                                    [ {{$result->SI2->company_name}}]</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="py-1 sm:py-4">
                                                        <div class="flex items-center space-x-4 px-8">
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-black">
                                                                    <b>Correlation
                                                                        @if($ticker != "")
                                                                            with {{$ticker}}
                                                                        @endif:
                                                                    </b>
                                                                </p>
                                                            </div>
                                                            <div class="inline-flex items-center break-all text-sm">
                                                                <p class="break-all">{{number_format($result->correlation*100,0)}}
                                                                    %</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="py-1 sm:py-4">
                                                        <div class="flex items-center space-x-4 px-8">
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-black">
                                                                    <b>Beta (S&P 500):</b>
                                                                </p>
                                                            </div>
                                                            <div class="inline-flex items-center break-all text-sm">
                                                                <p class="break-all">{{number_format($result->SI2->calced_beta,2)}}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="py-1 sm:py-4">
                                                        <div class="flex items-center space-x-4 px-8">
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-black">
                                                                    <b>Dividend Yield:</b>
                                                                </p>
                                                            </div>
                                                            <div class="inline-flex items-center break-all text-sm">
                                                                <p class="break-all">{{number_format($result->SI2->div_yield*100,2)}}
                                                                    %</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="py-1 sm:py-4">
                                                        <div class="flex items-center space-x-4 px-8">
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-black">
                                                                    <b>
                                                                        @if($etfs)
                                                                            Assets Under Management(AUM):
                                                                        @else
                                                                            Market Cap:
                                                                        @endif
                                                                    </b>
                                                                </p>
                                                            </div>
                                                            <div class="inline-flex items-center break-all text-sm">
                                                                <p class="break-all">
                                                                    ${{number_format($result->SI2->marketcap/1000,0)}}
                                                                    M</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="py-1 sm:py-4">
                                                        <div class="flex items-center space-x-4 px-8">
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-black">
                                                                    <b>
                                                                        @if($etfs)
                                                                            Expense Ratio:
                                                                        @else
                                                                            PE Ratio:
                                                                        @endif
                                                                    </b>
                                                                </p>
                                                            </div>
                                                            <div class="inline-flex items-center break-all text-sm">
                                                                <p class="break-all">
                                                                    @if($result->SI2->peRatio >0)
                                                                        {{number_format($result->SI2->peRatio,2)}}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="py-1 sm:py-4">
                                                        <div class="flex items-center space-x-4 px-8">
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-black">
                                                                    <b>1 Year % Change:</b>
                                                                </p>
                                                            </div>
                                                            <div class="inline-flex items-center break-all text-sm">

                                                                <p class="break-all">{{$result->SI2->year1ChangePercent*100<0?"(".number_format(abs($result->SI2->year1ChangePercent*100),2)."%)":number_format($result->SI2->year1ChangePercent*100,2)."%"}}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @elseif(!isset($result->ticker2))
                                        <div>
                                            <span class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">No Data Found</span>
                                        </div>
                                        @break
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).on('click', '#buttons', function () {
        console.log("hello");
        $('#spinner').show();
        $(this).hide();
    });
</script>
