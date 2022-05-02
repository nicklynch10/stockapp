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
                <input wire:model.debounce.500ms="ticker"
                       type="ticker"
                       id="tickerbar"
                       autocomplete="off"
                       placeholder="Enter Ticker..."
                       class="focus:outline-none border-gray-200 p-1 py-2 w-2/4 sm:w-3/4 sm:mr-0"
                       style="border-top:none; border-left: none; border-right: none; border-bottom: 2px solid #d1d5da; padding-bottom: 5px">
                <x-jet-input-error for="ticker" class="mt-2" />
            </div>
            <div class="col-span-12 sm:col-span-12">
                <div class="m-2">
                    <div class="w-full h-full rounded overflow-hidden bg-white px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                        <div class="mt-3 my-1">
                            <div class="flex flex-row items-center xs:flex-col xl:flex-col md:flex-col">
                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 1000px !important;">
                                    @php
                                    $string = $this->logo;
                                    if (strpos($string, "http") === 0) {
                                        $logoUrl = $this->logo;
                                    } else {
                                        $logoUrl = 'https://storage.googleapis.com/iex/api/logos/'.$this->ticker.'.png';
                                    }
                                    @endphp

                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><img src="{{ isset($this->logo) ? $logoUrl : 'https://ui-avatars.com/api/?name='.$this->ticker.'&color=7F9CF5&background=EBF4FF' }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16"></h5>
                                </div>
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <div class="flow-root">
                                        <label><b>Company Name :</b></label>
                                        <span>{{ $this->company }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Company Description :</b></label>
                                        <span>{{ $this->description }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Sector :</b></label>
                                        <span>{{ $this->sector }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Type :</b></label>
                                        <span>{{ $this->type }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Tags :</b></label>
                                        @foreach($this->tag as $t)
                                            <span>[ {{ $t }} ] </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
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
                @foreach($correlations->sortByDesc("correlation")->slice(0, 20) as $result)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$result->factor->name}}</td>
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
