<div>
    <link rel="stylesheet" type="text/css" href="/css/animated.css" />



    <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
            <x-slot name="title"></x-slot>
            <x-slot name="description"></x-slot>
        </x-jet-section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">

                <div class="grid grid-cols-12  w-full flex">
                    <div class="grid-start-1 col-span-3 float-left  flex items-center justify-center">
                        @php
                            $string = $this->logo;
                            if (strpos($string, "http") === 0) {
                                $logoUrl = $this->logo;
                            } else {
                                $logoUrl = 'https://storage.googleapis.com/iex/api/logos/'.$this->ticker.'.png';
                            }
                        @endphp

                        <img src="{{ isset($this->logo) ? $logoUrl : 'https://ui-avatars.com/api/?name=UBS&color=7F9CF5&background=EBF4FF' }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                    </div>
                    <div class="grid-start-4 col-span-9 float-right">
                        <div class="col-span-6 sm:col-span-4 p-4">
                            <form wire:submit.prevent="" enctype="multipart/form-data" method="post" >
                            @csrf
                                <x-jet-label for="ticker" value="{{ __('Enter Ticker to Compare') }}" />
                                <input wire:model.debounce.500ms="ticker"
                                       type="ticker"
                                       id="tickerbar"
                                       autocomplete="off"
                                       placeholder="Enter Ticker..."
                                       class="focus:outline-none border-gray-200 p-1 py-2 w-2/4 sm:w-3/4 sm:mr-0"
                                       style="border-top:none; border-left: none; border-right: none; border-bottom: 2px solid #d1d5da; padding-bottom: 5px">
                                <x-jet-input-error for="ticker" class="mt-2" />
                            </form>
                        </div>
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            @php
                                $token = env('IEX_CLOUD_KEY', null);
                                $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                                $symbol = Http::get($endpoint . 'stable/stock/'.$this->ticker.'/company?token=' . $token);
                                $company = $symbol->json();
                                $tag = $company['tags']
                            @endphp
                            <div class="flow-root">
                                <label><b>Company Name :</b></label>
                                <span>{{ $company['companyName'] }}</span>
                            </div>
                            <div class="flow-root">
                                <label><b>Sector :</b></label>
                                <span>{{ $company['sector'] }}</span>
                            </div>
                            <div class="flow-root">
                                <label><b>Type :</b></label>
                                <span>{{ convertType($company['issueType']) }}</span>
                            </div>
                            <div class="flow-root">
                                <label><b>Tags :</b></label>
                                @foreach($tag as $t)
                                    <span>[ {{ $t }} ] </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12  w-full flex">
                    <div class="col-span-12">
                        <label><b>Company Description :</b></label>
                        <span>{{ $this->description }}</span>
                    </div>
                </div>
                <div class="flow-root">
                    @if($ticker != "" & count($correlations)>0)
                        @foreach($correlations->slice(0, 20) as $key => $result)
                            @php
                                $getWord = strtok($result->factor->name, " ")
                            @endphp
                            <input type="hidden" value="{{$result->correlation}}" id="{{ $getWord }}" data-id="{{$key}}">
                        @endforeach
                    @endif
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                    <table class="historical">
                        <tr>
                            <th class="px-8 py-4"></th>
                            <th class="px-8 py-4"></th>
                            <th class="px-8 py-4"></th>
                            <th class="px-8 py-4"></th>
                            <th class="px-8 py-4"></th>
                        </tr>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td></td>
                            <td> <label><b>Growth </b></label></td>
                            <td class="">
                                <div class="wrapper mb-5">
                                    <div class='blind right' id="blindRight"></div>
                                    <div class='blind left' id="blindLeft"></div>
                                </div>
                            </td>
                            <td> <label><b>Value </b></label></td>
                            <td></td>
                        </tr>
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td></td>
                            <td> <label><b>Small Cap </b></label></td>
                            <td class="mt-8">
                                <div class="wrapper">
                                    <div class='blinds right' id="SmallRight"></div>
                                    <div class='blinds left' id="SmallLeft"></div>
                                </div>
                            </td>
                            <td> <label><b>Large Cap</b></label></td>
                            <td></td>
                        </tr>
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td></td>
                            <td> <label><b>Emerging </b></label></td>
                            <td class="mt-8">
                                <div class="wrapper">
                                    <div class='blindsEmerging right' id="EmergingRight"></div>
                                    <div class='blindsEmerging left' id="EmergingLeft"></div>
                                </div>
                            </td>
                            <td> <label><b>Developed</b></label></td>
                            <td></td>
                        </tr>
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td></td>
                            <td> <label><b>Lagging </b></label></td>
                            <td class="mt-8">
                                <div class="wrapper">
                                    <div class='blindsLagging right' id="LaggingRight"></div>
                                    <div class='blindsLagging left' id="LaggingLeft"></div>
                                </div>
                            </td>
                            <td> <label><b>Momentum</b></label></td>
                            <td></td>
                        </tr>
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td></td>
                            <td> <label><b>Low Volatility </b></label></td>
                            <td class="">
                                <div class="wrapper mb-5">
                                    <div class='blindsLow right' id="LowRight"></div>
                                    <div class='blindsLow left' id="LowLeft"></div>
                                </div>
                            </td>
                            <td> <label><b>High Volatility </b></label></td>
                            <td></td>
                        </tr>
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td></td>
                            <td> <label><b>Fixed Income </b></label></td>
                            <td class="">
                                <div class="wrapper mb-5">
                                    <div class='blindsFixed right' id="FixedRight"></div>
                                    <div class='blindsFixed left' id="FixedLeft"></div>
                                </div>
                                <div class="ruler-container">
                                    <ul class="ruler" data-items="3"></ul>
                                </div>
                            </td>
                            <td> <label><b>Equities </b></label></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6 bg-gray-50 sm:rounded-bl-md sm:rounded-br-md">

                </div>

        </div>
    </div>
    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align mt-10">
            <table>
                <thead class="bg-gray-300">
                <tr>
                    <th
                        class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Factor
                    </th>
                    <th
                        class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]" id="mytable">Correlation @if($ticker != "")with {{$ticker}}@endif
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                @if($ticker != "" & count($correlations)>0)
                    @foreach($correlations->slice(0, 20) as $result)

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" class="dataChange" data-label="Stock Ticker">{{$result->factor->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$result->correlation}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>
    <script type="text/javascript" id="scriptid" class="selectpicker" src="/js/animated.js"></script>
    <script>
        $("#mytable").bind("DOMSubtreeModified", function() {
            $(this).delay(1000).queue(function(){
                window.location.reload();
            });
        });
    </script>
</div>
