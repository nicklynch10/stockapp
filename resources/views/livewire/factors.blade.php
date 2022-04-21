<div>
<x-jet-form-section submit="doNothing">


    <x-slot name="title">
        {{ __('Find Similar Stocks & ETFs') }}
    </x-slot>

    <x-slot name="description">
        {{ __('TaxGhost can help identify similar stocks & ETFs so you can tax loss harvest effectively') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="ticker" value="{{ __('Enter Ticker to Compare') }}" />
            <input wire:model.debounce.1000ms="ticker"
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



<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align mt-10">
    <table>
        <thead class="bg-gray-300">
            <tr>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Factor
                </th>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Correlation @if($ticker != "")with {{$ticker}}@endif
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

             @if($ticker != "" & count($correlations)>0)
            @foreach($correlations->slice(0, 20) as $result)

            @php
            //dd($result);
            $result = App\Models\FactorCompare::find($result["id"]);
            $factor = App\Models\Factor::find($result->factor["id"]);
            @endphp

                <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$factor->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$result->correlation}}</td>
                    </tr>
            @endforeach
        @endif
       
                   
               
        </tbody>
    </table>
    
</div>


<div>

   

        </div>

</div>