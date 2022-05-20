<div>
    <link rel="stylesheet" type="text/css" href="/css/animated.css" />

    <div class="">
        <x-jet-section-title>
            <x-slot name="title"></x-slot>
            <x-slot name="description"></x-slot>
        </x-jet-section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="profile-page  mx-auto bg-white shadow rounded-md overflow-hidden p-2">
                <div class="grid grid-cols-12 w-full flex justify-center">
                    <div class="col-start-3 col-span-8">
                        <div class=" flex justify-center mt-4 mx-6">
                            @php
                                $token = env('IEX_CLOUD_KEY', null);
                                $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                                $logo = Http::get($endpoint . 'stable/stock/' . $this->ticker . '/logo?token=' . $token);
                                $logo_url = $logo->json();
                                $tickerLogo = $logo_url ? $logo_url['url'] : '';
                                $string = $tickerLogo;
                                if (strpos($string, "http") === 0) {
                                $logoUrl = $tickerLogo;;
                                } else {
                                $logoUrl = 'https://ui-avatars.com/api/?name='.$this->ticker.'&color=7F9CF5&background=EBF4FF';
                                }
                            @endphp
                            <img src="{{ $logoUrl }}" class="h-24 w-24 rounded-full object-contain hover:bg-gray-100 h-16">
                            {{--                        <img src="{{ isset($logoUrl) ? $logoUrl : 'https://ui-avatars.com/api/?name=UBS&color=7F9CF5&background=EBF4FF' }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">--}}
                        </div>
                        <div class="text-center">
                            <div class="col-span-6 sm:col-span-4 p-4">
                                <form wire:submit.prevent="" enctype="multipart/form-data" method="post" >
                                    @csrf
                                    <x-jet-label for="ticker" value="{{ __('Enter Ticker to Compare') }}" />
                                    <input wire:model.debounce.500ms="ticker"
                                           type="ticker"
                                           id="tickerbar"
                                           autocomplete="off"
                                           placeholder="Enter Ticker..."
                                           class="focus:outline-none border-gray-200 p-1 py-2  sm:mr-0"
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
                                @if($company['companyName'])
                                <div class="flow-root">
                                    <label><b>Company Name :</b></label>
                                    <span>{{ $company['companyName'] }}</span>
                                </div>
                                @endif

                                @if($company['sector'])
                                <div class="flow-root">
                                    <label><b>Sector :</b></label>
                                    <span>{{ $company['sector'] }}</span>
                                </div>
                                @endif

                                @if($company['issueType'])
                                <div class="flow-root">
                                    <label><b>Type :</b></label>
                                    <span>{{ convertType($company['issueType'], true) }}</span>
                                </div>
                                @endif

                                @if($tag)
                                <div class="flow-root">
                                    <label><b>Tags :</b></label>
                                    @if(isset($tag))
                                        @foreach($tag as $t)
                                            <span>[ {{ $t }} ] </span>
                                        @endforeach
                                    @endif
                                </div>
                                @endif

                                @if($company['description'])
                                <div class="grid grid-cols-12  w-full flex ">
                                    <div class="col-span-12">
                                        <label><b>Company Description :</b></label>
                                        <span>{{ $company['description'] }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
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


            <div class="container px-4 py-10 mx-auto md:py-12">
                <div class="p-8 my-10 bg-white shadow overflow-auto border-b border-gray-200 sm: rounded-lg table-align mt-5">
                    <table>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td class=""></td>
                            <td class=""></td>
                            <td class="mr-10">
                                <div class="ruler-container">
                                    <ul class="ruler" data-items="3"></ul>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td class=""></td>
                            <td> <label><b>Growth </b></label></td>
                            <td class="">
                                <div class="wrapper mb-5">
                                    <div class='blind right' id="blindRight"></div>
                                    <div class='blind left' id="blindLeft"></div>
                                </div>
                            </td>
                            <td> <label><b>Value </b></label></td>
                            <td class=""></td>
                        </tr>
                        <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                            <td></td>
                            <td> <label><b>Small Cap </b></label></td>
                            <td class="">
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
                            <td class="">
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
                            <td>
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
                            <td>
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
                            <td>
                                <div class="wrapper mb-5">
                                    <div class='blindsFixed right' id="FixedRight"></div>
                                    <div class='blindsFixed left' id="FixedLeft"></div>
                                </div>
                            </td>
                            <td> <label><b>Equities </b></label></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align mt-10 hidden">
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
    </div>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap");

        .blind.left-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            right: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
        }

        .blind.right-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            left: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
            right: auto;
        }

        .blinds.right-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            left: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
            right: auto;
        }
        .blinds.left-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            right: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
        }


        .blindsLow.left-demo:before {
            content: "";
            background-image:url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            right: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
        }

        .blindsLow.right-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            left: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
            right: auto;
        }


        .blindsLagging.left-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            right: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
        }
        .blindsLagging.right-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            left: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
            right: auto;
        }

        .blindsFixed.left-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            right: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
        }
        .blindsFixed.right-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            left: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
            right: auto;
        }


        .blindsEmerging.left-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            right: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
        }
        .blindsEmerging.right-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 33px 33px;
            background-repeat: no-repeat;
            position: absolute;
            left: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
            right: auto;
        }

    </style>
    <script type="text/javascript" id="scriptid" class="selectpicker" src="/js/animated.js"></script>
    <script>
        $("#mytable").bind("DOMSubtreeModified", function() {
            $(this).delay(1000).queue(function(){
                window.location.reload();
            });
        });
    </script>
</div>
