<div>
<x-jet-form-section submit="">


    <x-slot name="title">
        {{ __('Find Similar Stocks & ETFs') }}
    </x-slot>

    <x-slot name="description">
        {{ __('TaxGhost can help identify similar stocks & ETFs so you can tax loss harvest effectively') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="ticker" value="{{ __('Enter Ticker to Compare') }}" />
            <input wire:model.debounce.2000ms="ticker"
           type="ticker"
           id="tickerbar"
           autocomplete="off"
           placeholder="Enter Ticker..."
           class="focus:outline-none border-gray-200 p-1 py-2 w-2/4 sm:w-3/4 sm:mr-0"
           style="border-top:none; border-left: none; border-right: none; border-bottom: 2px solid #d1d5da; padding-bottom: 5px">
            <x-jet-input-error for="ticker" class="mt-2" />
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


<div class="flex justify-between items-center w-full m-2 p-2">
          <a wire:click="showETFs" class="bg-green-300 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition cursor-pointer">
            @if($etfs)
            {{ __('Show Stocks Only') }}
            @else
            {{ __('Show ETFs Only') }}
            @endif

            </a>
    </div>

<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align mt-10">



    <table>
        <thead class="bg-gray-300">
            <tr>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Stock Ticker / Name
                </th>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Correlation @if($ticker != "")with {{$ticker}}@endif
                </th>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Beta (S&P 500)
                </th>

                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Dividend Yield
                </th>

                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Market Cap / Assets Under Management (AUM)
                </th>

                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">PE Ratio
                </th>

                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">1 Year % Change
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
             @if($ticker != "" & count($correlations)>0)
                @foreach($correlations->sortByDesc("correlation")->slice(0, 500) as $result)
                    @if($result && isset($result->ticker2))
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$result->ticker2}} <br> {{$result->SI2->company_name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{number_format($result->correlation*100,0)}}%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{number_format($result->SI2->calced_beta,2)}} / {{number_format($result->SI2->beta,2)}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{number_format($result->SI2->div_yield*100,2)}}%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">${{number_format($result->SI2->marketcap/1000,0)}}M</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">@if($result->SI2->peRatio >0){{number_format($result->SI2->peRatio,2)}}@else N/A @endif</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{number_format($result->SI2->year1ChangePercent*100,2)}}%</td>
                        </tr>
                    @endif
                @endforeach
             @endif
        </tbody>
    </table>
</div>
<div>
        </div>
</div>
