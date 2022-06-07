<div>
    <link rel="stylesheet" type="text/css" href="/css/animated.css" />


    <div class="">
        <x-jet-section-title>
            <x-slot name="title"></x-slot>
            <x-slot name="description"></x-slot>

        </x-jet-section-title>
        <div class="flex justify-center overflow-auto">
            <img src="/images/logo2.png" class="logo" style="height: 40px;">
        </div>
        <div class="flex justify-center mt-6 lg:text-lg overflow-auto  ">
            <span>Stock Analysis And Screening tool for investors in USA.</span>
        </div>
{{--        <div class=" justify-center mt-1">--}}
{{--            <div class="nosubmit ">--}}
{{--                <input wire:model.debounce.2000ms="ticker"  class="nosubmit lg:ml-120  text-lg lg:ml-48 lg:px-8 sm:px-8 py-2 lg:w-1/4 sm:w-2/4 xs:w-auto xs:ml-1"--}}
{{--                       type="ticker" placeholder="Enter Ticker..." id="tickerbar">--}}
{{--                <x-jet-input-error for="ticker" class="mt-2"/>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="flex justify-center mt-6 lg:text-lg overflow-auto">
            <div class="factor-width">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input wire:model.debounce.2000ms="ticker" type="search" id="default-search" class="inline p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" placeholder="Enter Ticker...">
                    <button type="submit" class="absolute top-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="search_button">Search</button>
                    <button disabled="" type="button" class="hidden absolute right-2 top-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="spinner_icon" >
                        <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"></path>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"></path>
                        </svg>
                    </button>

                </div>
            </div>
        </div>
{{--        <div class="grid grid-cols-12 sm:grid-cols-6  md:grid-cols-8  lg:grid-cols-8 gap-6">--}}
{{--            <div class="col-start-4 col-span-3">--}}
{{--                <div class="">--}}
{{--                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>--}}
{{--                    <div class="relative">--}}
{{--                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">--}}
{{--                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>--}}
{{--                        </div>--}}
{{--                        <input wire:model.debounce.2000ms="ticker" type="search" id="default-search" class="inline p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" placeholder="Enter Ticker...">--}}
{{--                        <button type="submit" class="absolute top-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="search_button">Search</button>--}}
{{--                        <button disabled="" type="button" class="hidden absolute right-2 top-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="spinner_icon" >--}}
{{--                            <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"></path>--}}
{{--                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"></path>--}}
{{--                            </svg>--}}
{{--                            Loading...--}}
{{--                        </button>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <div class="mt-5 md:mt-0 md:col-span-2">

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
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="profile-page mx-auto p-2">
                <div class="grid grid-cols-12 w-full flex justify-center xs:flex-col xs:flex xs:text-center xs:justify-center">
                    <div class="col-start-1 col-span-4 mr-3 bg-white shadow-2xl rounded-md xs:mb-2">
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
                                dd($logoUrl);
                                }
                            @endphp
                            @if(count($correlations)>0)
                            <img src="{{ $logoUrl }}" class="h-24 w-24 rounded-full object-contain hover:bg-gray-100 h-16">
                            @endif
                            {{--                        <img src="{{ isset($logoUrl) ? $logoUrl : 'https://ui-avatars.com/api/?name=UBS&color=7F9CF5&background=EBF4FF' }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">--}}
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
                            input.nosubmit {
                                border: 1px solid #246ab2;
                                /*width: 30%;*/
                                /*margin-left: 35%;*/
                                padding: 9px 4px 9px 10px;
                                background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
                                background-position: 95% 50%;
                            }
                            @keyframes spinner {
                                to {transform: rotate(360deg);}
                            }

                            .spinner:before {
                                content: '';
                                box-sizing: border-box;
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                width:30px;
                                height: 30px;
                                margin-top: 40px;
                                /*margin-left: -10px;*/
                                border-radius: 50%;
                                border: 2px solid #ccc;
                                border-top-color: #000;
                                animation: spinner .6s linear infinite;
                            }

                        </style>
                        <div class="text-center">
                            <div class="flex flex-col justify-between p-4 leading-8">
                                @php
                                    $token = env('IEX_CLOUD_KEY', null);
                                    $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                                    $symbol = Http::get($endpoint . 'stable/stock/'.$this->ticker.'/company?token=' . $token);
                                    $company = $symbol->json();
                                    $tag = $company ? $company['tags'] : []
                                @endphp

                                @if($company !== null)
                                    @if($company['companyName'])
                                        <div class="">
                                            <span >{{ $company['companyName'] }}</span>
                                        </div>
                                    @endif

                                    @if($company['sector'])
                                        <div class="flow-root">
                                            <span>{{ $company['sector'] }}</span>
                                        </div>
                                    @endif

                                    @if($company['issueType'])
                                        <div class="flow-root">
                                            <span>{{ convertType($company['issueType']) }}</span>
                                        </div>
                                    @endif

                                    @if($tag)
                                        <div class="flow-root">
{{--                                            <label><b>Tags: </b></label>--}}
                                            @if(isset($tag))
                                                @foreach($tag as $t)
                                                    {{ $loop->first ? '' : ', ' }}
                                                    <span> {{ $t }} </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif

                                    @if($company['description'])
                                        <div class="grid grid-cols-12  w-full flex ">
                                            <div class="col-span-12 leading-5">
{{--                                                <label><b>Company Description:</b></label>--}}
                                                <span>{{ $company['description'] }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <h2 class="font-semibold text-lg font-medium text-gray-900 processing">No Ticker Found</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-start-5 col-span-8 bg-white shadow-2xl overflow-auto border-b border-gray-200 sm:rounded-lg table-align progressbar ">
                        <div class="px-4 py-10 mx-auto md:py-12 xs:flex-col xs:flex xs:text-center xs:justify-center">
                            @if($ticker != "" & count($correlations)>0)
                                <table class="displayprocess" id ="">
                                    <tbody class="bg-white divide-y divide-gray-200 ">
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
                                <h2 class="font-semibold text-lg font-medium text-gray-900 processing"></h2>
                            @else
                                <div class="text-center">
                                    <h2 class="font-semibold text-lg font-medium text-gray-900 processing ">No data found in this stock</h2>
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
    </div>
    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align mt-10 hidden">
        <table id="mytable">
            <thead class="bg-gray-300">
            <tr>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Factor
                </th>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]" >Correlation @if($ticker != "")with {{$ticker}}@endif
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
<script type="text/javascript" id="scriptid" class="selectpicker" src="/js/animated.js"></script>
<script>
    var oldurl = window.location.href
    $("#mytable").bind("DOMSubtreeModified", function() {
        $(this).delay(1000).queue(function(){
            $('.displayprocess').hide();
            window.location.reload(true);

            $('.processing').addClass('spinner');
            var newurl = window.location.href;
            if (oldurl === newurl){
                $('.displayprocess').hide();
                $('.processing').addClass('spinner');
            }
        });
    });

    $('#search_button').on('click', function () {
        console.log("hello");
        $('#search_button').hide();
        $('#spinner_icon').show();
        $(this).hide();
    });
</script>
</div>
