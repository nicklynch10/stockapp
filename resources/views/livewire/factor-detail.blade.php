<div>
    <link rel="stylesheet" type="text/css" href="/css/animated.css"/>
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
    {{--        <img src="{{ $logoUrl }}" class="h-24 w-24 rounded-full object-contain hover:bg-gray-100 h-16">--}}
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap");

        .blind.left-demo:before {
            content: "";
            background-image: url({{ $logoUrl }});
            background-size: 25px 25px;
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
            background-size: 41px 25px;
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
            background-size: 41px 25px;
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
            background-size: 25px 25px;
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
            background-image: url({{ $logoUrl }});
            background-size: 25px 25px;
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
            background-size: 41px 25px;
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
            background-size: 25px 25px;
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
            background-size: 41px 25px;
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
            background-size: 25px 25px;
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
            background-size: 41px 25px;
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
            background-size: 25px 25px;
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
            background-size: 41px 25px;
            background-repeat: no-repeat;
            position: absolute;
            left: -33px;
            top: 0;
            display: block;
            min-width: 33px;
            min-height: 33px;
            right: auto;
        }

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

        .bar-main-container {
            margin: 18px auto 0px auto;
            width: 70%;
            height: 50px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            font-family: sans-serif;
            font-weight: normal;
            font-size: 0.8em;
        }

        .bar-container {
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            height: 15px;
            background: #da1919 50%;
            width: 100%;
            overflow: hidden;
        }

        .bar {
            float: left;
            background: #008000FF 50%;
            height: 100%;
            -webkit-border-radius: 10px 0px 0px 10px;
            -moz-border-radius: 12px 0px 0px 12px;
            border-radius: 12px 0px 0px 12px;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: alpha(opacity=100);
            -moz-opacity: 1;
            -khtml-opacity: 1;
            opacity: 1;
        }

        .to-brand-green-dark {
            --tw-gradient-to: #33a34d;
        }

        .from-brand-tango {
            --tw-gradient-from: #ed7b1c;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgb(237 123 28/0));
        }

        .bg-gradient-to-r {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
        }

        .bg-black {
            --tw-bg-opacity: 1;
            background-color: rgb(0 0 0/var(--tw-bg-opacity));
        }

        .transform {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .rotate-45 {
            --tw-rotate: 45deg;
        }

        .origin-bottom-left {
            transform-origin: bottom left;
        }

        .w-2 {
            width: 0.5rem;
        }

        .h-2 {
            height: 0.5rem;
        }

    </style>
    <div class="mt-8">
        <div class="mb-3">
            <x-jet-section-title>
                <x-slot name="title"></x-slot>
                <x-slot name="description"></x-slot>
            </x-jet-section-title>
            <div class="flex justify-center overflow-auto">
                <img src="/images/logo2.png" class="logo" style="height: 40px;">
            </div>
            <div class="flex justify-center mt-6 lg:text-lg xs:mx-4">
                <span>Stock Analysis And Screening tool for investors in USA.</span>
            </div>
            <div class="flex justify-center mt-6 lg:text-lg overflow-auto xs:mx-4">
                <div class="factor-width">
                    <form action="{{route('analyze')}}" method="get">
                        <label for="default-search"
                               class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" value="{{ $this->ticker }}" name="ticker" id="default-search"
                                   class="inline p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required="" placeholder="Enter Ticker...">

                            <button type="submit"
                                    class="absolute top-2.5 bottom-2.5 bg-green-600 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    id="search_button">Search
                            </button>
                            <button disabled="" type="button"
                                    class="hidden absolute right-2 top-2.5 bottom-2.5 bg-green-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    id="spinner_icon">
                                <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin"
                                     viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="#E5E7EB"></path>
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentColor"></path>
                                </svg>
                                Loading...
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
            class="grid sm:gap-0.5 md:gap-2 grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 xs:grid-cols-1 sm:grid-cols-1 xl:gap-4 justify-center sm:flex-wrap xs:text-center xs:justify-center">
            <div
                class="col-start-1 xs:col-start-2 md:col-end-6 lg:col-end-6 xs:col-end-12 xs:flex-col xs:flex xs:text-center xs:justify-center bg-white shadow-2xl rounded">
                @php
                    $token = env('IEX_CLOUD_KEY', null);
                    $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                    $symbol = Http::get($endpoint . 'stable/stock/'.$this->ticker.'/company?token=' . $token);
                    $company = $symbol->json();
                    $tag = $company ? $company['tags'] : [];
                    $companyname=explode('-',$company['securityName'])
                @endphp
                <div
                    class="col-start-1 col-span-2  sm:pl-0 md:pl-1 xl:pl-10 lg:pl-10 sm:flex-col  xs:flex-col xs:flex sm:text-center xs:text-center sm:flex sm:flex-wrap sm:justify-center xs:justify-center sm:ml-5 xs:ml-8 xs:px-3 lg:ml-24">
                    <div class="mt-8 mb-4 flex justify-between">
                        <div class="inline-flex items-center">
                            <h5 class="mb-2 tracking-tight text-gray-900 dark:text-white float-left">
                                @php
                                    $count= strlen($this->ticker)
                                @endphp
                                <div
                                    class="{{ $count>7 ? "text-xs" : "text-sm" }} rounded-full border-gray-300 bg-blue-50 flex items-center font-bold text-blue-500 justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                    <span class="break-all">{{strtoupper($this->ticker)}}</span>
                                </div>
                            </h5>
                            <div class="lg:ml-1 xl:ml-5 xs:ml-1 sm:ml-0 md:ml-5">
                                @if($company['companyName'])
                                    <span class="lg:text-4xl xs:text-lg xl:text-xl sm:text-xl font-bold">
                                        {{strtoupper($this->ticker)}} <br>
                                    <span
                                        class="text-blue-500 font-bold lg:text-2xl xs:text-lg sm:text-xl sm:ml-5"> {{ convertType($company['issueType'])=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$company['companyName']}}</span>
                                </span>
                                @endif
                            </div>
                        </div>
                        @php
                            $token = env('IEX_CLOUD_KEY', null);
                            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                            $url = ($endpoint . 'stable/stock/'.$this->ticker.'/quote?token=' . $token);
                            $data = Http::get($url);
                            $stats = $data->json();
                        @endphp
                        <div class="float-right grid-rows-2 mr-10 ">
                            <span
                                class="row-span-1 font-bold text-xl ">${{ number_format(($stats['latestPrice']),2,'.',',')}}</span><br/>
                            <span class="row-span-2 text-gray-700 text-sm">{{$stats['latestTime']}}-Close</span>
                        </div>
                    </div>
                </div>
                <div
                    class="col-start-1 col-span-2 box-content h-auto p-4 border-2 ml-6 rounded-xl bg-white mt-12 mr-10 xs:ml-8 mb-20">
                    <div
                        class="grid  gap-2 xs:flex-col xs:flex xs:text-center mr-1 sm:flex-col sm:flex lg:text-center sm:text-center lg:text-center md:text-center md:flex md:flex-col">
                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">Market Cap:</span>
                            <span class="xs:m-3 mb-3">${{number_format(($stats['marketCap']/1000000))}}M</span>
                        </div>

                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">Current Price:</span>
                            <span class="xs:m-3 mb-3">${{ number_format(($stats['latestPrice']),2,'.',',') }}</span>
                        </div>

                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">High/Low:</span>
                            <span
                                class="xs:m-3 mb-3"> ${{ number_format(($stats['high']),2,'.',',').' / '.'$'.number_format(($stats['low']),2,'.',',') }}</span>
                        </div>

                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">Stock PE:</span>
                            <span class="xs:m-3 mb-3">{{number_format( $stats['peRatio'],2)}} </span>
                        </div>

                        @if($company['sector'])
                            <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                                <span class="font-bold xs:m-3 my-3">Sector:</span>
                                <span class="xs:m-3 mb-3">{{ $company['sector'] }} </span>
                            </div>
                        @endif
                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">Issue Type:</span>
                            <span class="xs:m-3 mb-3">{{ convertType($company['issueType']) }}</span>
                        </div>
                        @php
                            $token = env('IEX_CLOUD_KEY', null);
                            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                            $symbol = Http::get($endpoint . 'stable/stock/'.$this->ticker.'/stats?token=' . $token);
                            $stats = $symbol->json();
                        @endphp
                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">Beta:</span>
                            <span class="xs:m-3 mb-3">{{ number_format($stats['beta'], 2) }}</span>
                        </div>
                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">Dividend Yield:</span>
                            <span class="xs:m-3 mb-3">{{ number_format($stats['dividendYield']*100, 2) }}%</span>
                        </div>
                        <div class="col-span-1 box-content border-1 bg-gray-100 flex flex-col items-center">
                            <span class="font-bold xs:m-3 my-3">1 Year % Change:</span>
                            <span class="xs:m-3 mb-3">{{ $stats['year1ChangePercent'] > 0 ? number_format($stats['year1ChangePercent']*100, 2) : "(".number_format($stats['year1ChangePercent']*100, 2) .")"  }}%</span>
                        </div>
                        <div class="col-span-3 box-content border-1 sm:m-2 lg:mr-10 ">
                            @if(isset($tag))
                                @foreach($tag as $t)
                                    <div class="mr-2 my-2 inline-block">
                                        <div
                                            class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-sm text-gray-800 tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                            {{ $t }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if($company['description'])
                            <div class="col-span-3 box-content border-1  sm:m-2">
                                <p>{{ $company['description'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div
                class="col-start-2 md:col-end-6 lg:col-end-6 xs:flex-col xs:flex sm:flex-col sm:flex xs:text-center xs:justify-center bg-white shadow-2xl rounded">
                <div class="flex justify-between items-center ml-3 mb-5 mt-8 pl-4 ">
                    <h2 class="text-2xl font-black">Factor Analysis <br>
                        <span class="font-bold text-lg">TaxGhost can help identify similar stocks & ETFs so you can tax loss harvest effectively</span>
                    </h2>
                </div>
                <div wire:init="init"
                     class="col-start-1 col-span-2 box-content h-auto p-4 border-2 ml-6 rounded-xl bg-white mt-12 mr-10 xs:ml-8 mb-5 progressbar ">
                    @if ($loadData)
                        @if($ticker != "" & count($correlations)>0)
                            <div class="grid grid-cols-12  xs:grid-cols-1 xl:grid-cols-6 lg:grid-cols-6 flex mt:border-2-solid-black mt:border-r-11 mt:mb-2  md:flex md:flex-col  xs:flex xs:flex-col sm:flex sm:flex-col xs:justify-center xs:text-center">
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b></b></label></div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-3 col-span-8 text-center xs:text-center xl:items-center lg:text-center ">
                                    <td class="mr-10">
                                        <div id="bar-1" class="wrapper-ruler mb-5">
                                            <div class="">
                                                <div class="flex flex-col w-full items-center justify-center">
                                                    <div class="flex justify-between items-center w-full">
                                                        <div class="text-sm font-semibold">-1</div>
                                                        <div class="text-sm font-medium text-brand-grey-base text-center">0</div>
                                                        <div class="text-sm font-semibold">1</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b></b></label></div>
                                </div>
                            </div><hr/>
                            <div class="grid grid-cols-12  xs:grid-cols-1 xl:grid-cols-6 lg:grid-cols-6 flex mt:border-2-solid-black mt:border-r-11 mt:mb-2  md:flex md:flex-col  xs:flex xs:flex-col sm:flex sm:flex-col xs:justify-center xs:text-center">
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b>Growth </b></label></div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-3 col-span-8 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="wrapper mb-5">
                                        <div class='blind right' id="blindRight"></div>
                                        <div class='blind left' id="blindLeft"></div>
                                    </div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-11 col-span-2 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-2 my-5 sm:m-2"><label><b>Value </b></label></div>
                                </div>
                            </div><hr/>
                            <div class="grid grid-cols-12  xs:grid-cols-1 xl:grid-cols-6 lg:grid-cols-6 flex mt:border-2-solid-black mt:border-r-11 mt:mb-2 md:flex md:flex-col xs:flex xs:flex-col sm:flex sm:flex-col xs:justify-center xs:text-center">
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b>Small Cap </b></label></div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-3 col-span-8 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="wrapper mb-5">
                                        <div class='blinds right' id="SmallRight"></div>
                                        <div class='blinds left' id="SmallLeft"></div>
                                    </div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-11 col-span-2 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-2 my-5 sm:m-2"><label><b>Large Cap </b></label></div>
                                </div>
                            </div><hr/>
                            <div class="grid grid-cols-12  xs:grid-cols-1 xl:grid-cols-6 lg:grid-cols-6 flex mt:border-2-solid-black mt:border-r-11 mt:mb-2 md:flex md:flex-col xs:flex xs:flex-col sm:flex sm:flex-col xs:justify-center xs:text-center">
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b>Emerging </b></label></div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-3 col-span-8 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="wrapper mb-5">
                                        <div class='blindsEmerging right' id="EmergingRight"></div>
                                        <div class='blindsEmerging left' id="EmergingLeft"></div>
                                    </div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-11 col-span-2 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-2 my-5 sm:m-2"><label><b>Developed</b></label></div>
                                </div>
                            </div><hr/>
                            <div class="grid grid-cols-12  xs:grid-cols-1 xl:grid-cols-6 lg:grid-cols-6 flex mt:border-2-solid-black mt:border-r-11 mt:mb-2 md:flex md:flex-col xs:flex xs:flex-col sm:flex sm:flex-col xs:justify-center xs:text-center">
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b>Lagging </b></label></div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-3 col-span-8 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="wrapper mb-5">
                                        <div class='blindsLagging right' id="LaggingRight"></div>
                                        <div class='blindsLagging left' id="LaggingLeft"></div>
                                    </div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-11 col-span-2 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-2 my-5 sm:m-2"><label><b>Momentum </b></label></div>
                                </div>
                            </div><hr/>
                            <div class="grid grid-cols-12  xs:grid-cols-1 xl:grid-cols-6 lg:grid-cols-6 flex mt:border-2-solid-black mt:border-r-11 mt:mb-2 md:flex md:flex-col xs:flex xs:flex-col sm:flex sm:flex-col xs:justify-center xs:text-center">
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b>Low Volatility </b></label></div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-3 col-span-8 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="wrapper mb-5">
                                        <div class='blindsLow right' id="LowRight"></div>
                                        <div class='blindsLow left' id="LowLeft"></div>
                                    </div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-11 col-span-2 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-2 my-5 sm:m-2"><label><b>High Volatility</b></label></div>
                                </div>
                            </div><hr/>
                            <div class="grid grid-cols-12 xs:grid-cols-1 xl:grid-cols-6 lg:grid-cols-6 flex mt:border-2-solid-black mt:border-r-11 mt:mb-2 md:flex md:flex-col xs:flex xs:flex-col sm:flex sm:flex-col xs:justify-center xs:text-center">
                                <div class="mt:flex mt:flex-col col-start-1 col-span-2  text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-1 my-5 sm:m-2"><label><b>Fixed Income </b></label></div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-3 col-span-8 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="wrapper mb-5">
                                        <div class='blindsFixed right' id="FixedRight"></div>
                                        <div class='blindsFixed left' id="FixedLeft"></div>
                                    </div>
                                </div>
                                <div class="mt:flex mt:flex-col col-start-11 col-span-2 text-center xs:text-center xl:items-center lg:text-center ">
                                    <div class="sm:flex-col col-start-2 my-5 sm:m-2"><label><b>Equities </b></label></div>
                                </div>
                            </div><hr/>
                            <h2 class="font-semibold text-lg font-medium text-gray-900 processing"></h2>
                        @else
                            <div class="text-center">
                                <h2 class="font-semibold text-lg font-medium text-gray-900 processing ">No data found in this stock</h2>
                            </div>
                        @endif
                    @else
                        <button type="button" class="align-middle inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-rose-500 focus:border-rose-700 active:bg-rose-700 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading Data....
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 justify-center xs:flex-col xs:flex xs:text-center xs:justify-center m-2">
            <div class="col-start-1 col-span-1 xs:flex-col xs:flex xs:text-center xs:justify-center bg-white shadow-2xl rounded">
                <div class="flex justify-between items-center w-full border-b-2 border-gray-300 mb-2 mt-6">
                    @php
                        use App\Models\StockTicker;$SC_old = StockTicker::where('ticker', $this->ticker)->first();
                        $company =$SC_old['ticker_company']
                    @endphp
                    @if($etfs)
                        <h2 class="text-xl font-black">Comparable ETFs to [{{$company}}]</h2>
                    @else

                        <h2 class="text-xl font-black">Comparable Stocks to [{{$company}}]</h2>
                    @endif
                    <a wire:click="showETFs" class="bg-green-300 inline-flex items-center px-4 py-2 mb-2 bg-white border border-gray-300 mr-2 ml-2 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition cursor-pointer" id="buttons">
                        @if($etfs)
                            {{ __('Show Stocks') }}<br> {{ __('Only')}}
                        @else
                            {{ __('Show ETFs') }} <br> {{ __('Only')}}
                        @endif
                    </a>
                    <div class="flex justify-center items-center spinner hidden mt-2 mb-2 mr-5" id="spinner">
                        <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-green-500 spinner" id="spinner" role="status" aria-hidden="true">
                            <span class="visually-hidden">.</span>
                        </div>
                    </div>
                </div>

                <div wire:init="init" class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 lg:grid-cols-3 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">
                    @if ($loadData)
                        @if($ticker != "" & count($correlation)>0)
                            @foreach($correlation->sortByDesc("correlation")->slice(0, 500)->unique()->take(30) as $result)
                                @if($result && isset($result->ticker2))
                                    <div class="m-2">
                                        <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                                            <div class="mt-3 my-1">
                                                <div class="flex flex-row items-center xs:flex-col">
                                                    <div class="flex flex-col justify-between p-4 leading-normal align items-center xs:w-full md:w-2/5 xl:w-2/5" style="background: #f3f4f6">
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
                                                            <a class=" cursor-pointer whitespace-normal">{{ $result->ticker2 }}</a>
                                                        </h5>
                                                        <span class="mb-1 break-words break-all text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">{{$result->SI2->company_name}}</span>
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
                                                                            <span class="break-all">~{{number_format($result->correlation*100,0).'%'}}</span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="py-1 sm:py-4">
                                                                    <div class="flex items-center space-x-4">
                                                                        <div class="flex-1 min-w-0">
                                                                            <span class="text-sm font-medium text-black-900 break-all dark:text-white">Beta:</span>
                                                                        </div>
                                                                        <div class="inline-flex items-center text-sm">{{number_format($result->SI2->beta,2)}}</div>
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
                                                                        <div class="inline-flex items-center text-sm text-green-700">${{number_format($result->SI2->marketcap/1000,0).'M'}}</div>
                                                                    </div>
                                                                </li>
                                                                @php
                                                                    $token = env('IEX_CLOUD_KEY', null);
                                                                    $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                                                                    $url = ($endpoint . 'stable/stock/'.$result->ticker2.'/quote?token=' . $token);
                                                                    $data = Http::get($url);
                                                                    $stats = $data->json()

                                                                @endphp
                                                                @if($stats!='')
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
                                                                            <div class="inline-flex items-center text-sm text-green-700">
                                                                                @if($stats!='')
                                                                                    {{number_format( $stats['peRatio'],2)}}
                                                                                @else
                                                                                    N/A
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                                <li class="py-1 sm:py-4">
                                                                    <div class="flex items-center space-x-4">
                                                                        <div class="flex-1">
                                                                            <span class="text-sm font-medium text-black-900 break-all dark:text-white">1 Year % Change:</span>
                                                                        </div>
                                                                        <div class="inline-flex items-center text-sm text-right {{$result->SI2->year1ChangePercent*100<0? "text-red-600":"text-green-600"}}">{{$result->SI2->year1ChangePercent*100<0?"(".number_format(abs($result->SI2->year1ChangePercent*100),2)."%)":number_format($result->SI2->year1ChangePercent*100,2)."%"}}</div>
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
                                                            $data = $tag
                                                        @endphp
                                                        @foreach(json_decode($result->SI2['company_tags']) as $g)
                                                            @php
                                                                $con = $g;
                                                                $inarr = in_array(sorted($con), array_map("sorted", $data))
                                                            @endphp
                                                            <div class="mr-1 mb-1 inline-block">
                                                                <div
                                                                    class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-sm text-gray-800 tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                                                    {!! $inarr == true ? "<b style='color: #15803d'>".$g."</b>" : "".$g."" !!}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="py-1 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div id="bar-1" class="bar-main-container azure mt-8">
                                                        <div class="">
                                                            <div class="flex flex-col w-full items-center justify-center">
                                                                <div class="flex justify-between items-center w-full">
                                                                    <div class="text-sm font-semibold">{{'$'.number_format(($stats['week52Low']),2,'.',',')}}</div>
                                                                    <div class="text-sm font-medium text-brand-grey-base text-center">52-Week Price Range</div>
                                                                    <div class="text-sm font-semibold">{{'$'.number_format(($stats['week52High']),2,'.',',')}}</div>
                                                                </div>
                                                                <div class="flex w-full h-1 bg-gradient-to-r from-brand-tango to-brand-green-dark rounded-lg"></div>
                                                                <div class="w-full relative">
                                                                    @php
                                                                        $val = ceil((int)$stats['iexClose']);
                                                                        if($val > 700)
                                                                        {
                                                                           if($val > 1000)
                                                                           {
                                                                               $left = (int)$stats['iexClose']/1000;
                                                                           }
                                                                           else
                                                                           {
                                                                               $left = (int)$stats['iexClose']/100;
                                                                           }
                                                                        }
                                                                        elseif($val >100)
                                                                        {
                                                                            $left = (int)$stats['iexClose']/10;
                                                                        }
                                                                        else
                                                                        {
                                                                            $left = (int)$stats['iexClose'];
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
                                    <div>
                                        <span class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">No Data Found</span>
                                    </div>
                                    @break
                                @endif
                            @endforeach
                        @endif
                    @else
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-rose-500 focus:border-rose-700 active:bg-rose-700 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading Data....
                        </button>
                    @endif
                </div>
            </div>
        </div>

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
    </div>

    {{--    <script type="text/javascript" class="selectpicker scriptid" src="/js/animated.js"></script>--}}
    <script class="scriptid">
        window.addEventListener('contentChanged', event => {
            // Growth and Value//
            let currentPercentageState = 0;
            let easing = "cubic-bezier(0.5, 1, 0.89, 1)";
            let duration = 1000;
            let easeReversal = y => (1 - Math.sqrt((y - 1) / -1))


            function animate(percentage) {
                percentage = parseFloat(percentage);

                // determine if we've crossed the 0 threshold, which would force us to do something else here
                let threshold = currentPercentageState / percentage < 0;

                if (!threshold && percentage != 0) {
                    // determine which blind we're animating
                    let blind = percentage < 0 ? "left" : "right";
                    if (percentage < 0) {

                        $("#blindLeft").addClass("left-demo");
                        $("#blindLeft").attr("title", parseFloat(percentage).toFixed(2));
                    } else {
                        $("#blindRight").addClass("right-demo");
                        $("#blindRight").attr("title", parseFloat(percentage).toFixed(2));
                    }
                    $(`.blind.${blind}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageState}%)`,
                                easing: easing
                            },
                            {
                                transform: `translateX(${percentage * 100}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: duration
                        }
                    );
                } else {
                    // this happens when we cross the 0 boundry
                    // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
                    let firstBlind = percentage < 0 ? "right" : "left";
                    let secondBlind = percentage < 0 ? "left" : "right";

                    // get total travel distance
                    let delta = currentPercentageState - percentage;

                    // find the percentage of that travel that the first blind is responsible for
                    let firstTravel = currentPercentageState / delta;
                    let secondTravel = 1 - firstTravel;
                    // animate the first blind.
                    $(`.blind.${firstBlind}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageState}%)`,
                                easing: easing
                            },
                            {
                                // we go towards the target value instead of 0 since we'll cut the animation short
                                transform: `translateX(${percentage}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: duration,
                            // cut the animation short, this should run the animation to this x value of the easing function
                            iterations: easeReversal(firstTravel)

                        }
                    );

                    // animate the second blind
                    $(`.blind.${secondBlind}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageState}%)`,
                                easing: easing
                            },
                            {
                                transform: `translateX(${percentage}%)`
                            }
                        ],

                        {
                            fill: "forwards",
                            duration: duration,
                            // start the iteration where the first should have left off. This should put up where the easing function left off
                            iterationStart: easeReversal(firstTravel),
                            // we only need to carry this aniamtion the rest of the way
                            iterations: 1 - easeReversal(firstTravel),
                            // delay this animation until the first "meets" it
                            delay: duration * easeReversal(firstTravel)
                        }
                    );
                }
                // save the new value so that the next iteration has a proper from keyframe
                currentPercentageState = percentage;
            }


            // the following are just binding set ups for the buttons

            $(document).ready(function () {
                animate($('#Growth').val());
            });

            // animate(20);
            //setTimeout(()=>animate(-100), 1050)

            $(function () {
                // Build "dynamic" rulers by adding items
                $(".ruler[data-items]").each(function () {
                    var ruler = $(this).empty(),
                        len = Number(ruler.attr("data-items")) || 0,
                        item = $(document.createElement("li")),
                        i;

                    for (i = -2; i < len - 2; i++) {
                        ruler.append(item.clone().text(i + 1));
                    }
                });

                // Change the spacing programatically
                function changeRulerSpacing(spacing) {
                    $(".ruler")
                        .css("padding-right", spacing)
                        .find("li")
                        .css("padding-left", spacing);
                }

                changeRulerSpacing("30px");
            });


            // 	Small Cap and 	Large Cap //

            let currentPercentageStates = 0;
            let easings = "cubic-bezier(0.5, 1, 0.89, 1)";
            let durations = 1000;
            let easeReversals = y => (1 - Math.sqrt((y - 1) / -1))


            function animates(percentages) {
                percentages = parseFloat(percentages);

                // determine if we've crossed the 0 threshold, which would force us to do something else here
                let thresholds = currentPercentageStates / percentages < 0;

                if (!thresholds && percentages != 0) {
                    // determine which blind we're animating
                    let blinds = percentages < 0 ? "left" : "right";

                    if (percentages < 0) {
                        $("#SmallLeft").addClass("left-demo");
                        $("#SmallLeft").attr("title", parseFloat(percentages).toFixed(2));
                    } else {
                        $("#SmallRight").addClass("right-demo");
                        $("#SmallRight").attr("title", parseFloat(percentages).toFixed(2));
                    }

                    $(`.blinds.${blinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStates}%)`,
                                easing: easings
                            },
                            {
                                transform: `translateX(${percentages * 100}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durations
                        }
                    );
                } else {
                    // this happens when we cross the 0 boundry
                    // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
                    let firstBlinds = percentages < 0 ? "right" : "left";
                    let secondBlinds = percentages < 0 ? "left" : "right";

                    // get total travel distance
                    let deltas = currentPercentageStates - percentages;
                    // find the percentage of that travel that the first blind is responsible for
                    let firstTravels = currentPercentageStates / deltas;
                    let secondTravels = 1 - firstTravels;


                    // animate the first blind.
                    $(`.blinds.${firstBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStates}%)`,
                                easing: easings
                            },
                            {
                                // we go towards the target value instead of 0 since we'll cut the animation short
                                transform: `translateX(${percentages}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durations,
                            // cut the animation short, this should run the animation to this x value of the easing function
                            iterations: easeReversals(firstTravels)

                        }
                    );

                    // animate the second blind
                    $(`.blinds.${secondBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStates}%)`,
                                easing: easings
                            },
                            {
                                transform: `translateX(${percentages}%)`
                            }
                        ],

                        {
                            fill: "forwards",
                            duration: durations,
                            // start the iteration where the first should have left off. This should put up where the easing function left off
                            iterationStart: easeReversals(firstTravels),
                            // we only need to carry this aniamtion the rest of the way
                            iterations: 1 - easeReversals(firstTravels),
                            // delay this animation until the first "meets" it
                            delay: duration * easeReversals(firstTravels)
                        }
                    );
                }
                // save the new value so that the next iteration has a proper from keyframe
                currentPercentageStates = percentages;
            }


            // the following are just binding set ups for the buttons

            $(document).ready(function () {
                animates($('#Small').val());
            });

            // Low Volatility and 	High Volatility	//
            let currentPercentageStatesLow = 0;
            let easingsLow = "cubic-bezier(0.5, 1, 0.89, 1)";
            let durationsLow = 1000;
            let easeReversalsLow = y => (1 - Math.sqrt((y - 1) / -1))


            function animatesLow(percentagesLow) {
                percentagesLow = parseFloat(percentagesLow);

                // determine if we've crossed the 0 threshold, which would force us to do something else here
                let thresholdsLow = currentPercentageStatesLow / percentagesLow < 0;
                if (!thresholdsLow && percentagesLow != 0) {
                    // determine which blind we're animating
                    let blindsLow = percentagesLow < 0 ? "left" : "right";

                    if (percentagesLow < 0) {
                        $("#LowLeft").addClass("left-demo");
                        $("#LowLeft").attr("title", parseFloat(percentagesLow).toFixed(2));
                    } else {
                        $("#LowRight").addClass("right-demo");
                        $("#LowRight").attr("title", parseFloat(percentagesLow).toFixed(2));
                    }

                    $(`.blindsLow.${blindsLow}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesLow}%)`,
                                easing: easingsLow
                            },
                            {
                                transform: `translateX(${percentagesLow * 100}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsLow
                        }
                    );
                } else {
                    // this happens when we cross the 0 boundry
                    // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
                    let firstBlinds = percentagesLow < 0 ? "right" : "left";
                    let secondBlinds = percentagesLow < 0 ? "left" : "right";

                    // get total travel distance
                    let deltasLow = currentPercentageStatesLow - percentagesLow;
                    // find the percentage of that travel that the first blind is responsible for
                    let firstTravelsLow = currentPercentageStatesLow / deltasLow;
                    let secondTravelsLow = 1 - firstTravelsLow;

                    // animate the first blind.
                    $(`.blindsLow.${firstBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesLow}%)`,
                                easing: easingsLow
                            },
                            {
                                // we go towards the target value instead of 0 since we'll cut the animation short
                                transform: `translateX(${percentagesLow}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsLow,
                            // cut the animation short, this should run the animation to this x value of the easing function
                            iterations: easeReversalsLow(firstTravelsLow)

                        }
                    );

                    // animate the second blind
                    $(`.blindsLow.${secondBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesLow}%)`,
                                easing: easingsLow
                            },
                            {
                                transform: `translateX(${percentagesLow}%)`
                            }
                        ],

                        {
                            fill: "forwards",
                            duration: durationsLow,
                            // start the iteration where the first should have left off. This should put up where the easing function left off
                            iterationStart: easeReversalsLow(firstTravelsLow),
                            // we only need to carry this aniamtion the rest of the way
                            iterations: 1 - easeReversalsLow(firstTravelsLow),
                            // delay this animation until the first "meets" it
                            delay: durationsLow * easeReversalsLow(firstTravelsLow)
                        }
                    );
                }
                // save the new value so that the next iteration has a proper from keyframe
                currentPercentageStatesLow = percentagesLow;
            }

            // the following are just binding set ups for the buttons
            $(document).ready(function () {
                animatesLow($('#Low').val());

            });

            // Fixed Income and Equities	//
            let currentPercentageStatesFixed = 0;
            let easingsFixed = "cubic-bezier(0.5, 1, 0.89, 1)";
            let durationsFixed = 1000;
            let easeReversalsFixed = y => (1 - Math.sqrt((y - 1) / -1))


            function animatesFixed(percentagesFixed) {
                percentagesFixed = parseFloat(percentagesFixed);

                // determine if we've crossed the 0 threshold, which would force us to do something else here
                let thresholdsFixed = currentPercentageStatesFixed / percentagesFixed < 0;
                if (!thresholdsFixed && percentagesFixed != 0) {
                    // determine which blind we're animating
                    let blindsFixed = percentagesFixed < 0 ? "left" : "right";
                    if (percentagesFixed < 0) {
                        $("#FixedLeft").addClass("left-demo");
                        $("#FixedLeft").attr("title", parseFloat(percentagesFixed).toFixed(2));
                    } else {
                        $("#FixedRight").addClass("right-demo");
                        $("#FixedRight").attr("title", parseFloat(percentagesFixed).toFixed(2));
                    }
                    $(`.blindsFixed.${blindsFixed}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesFixed}%)`,
                                easing: easingsFixed
                            },
                            {
                                transform: `translateX(${percentagesFixed * 100}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsFixed
                        }
                    );
                } else {
                    // this happens when we cross the 0 boundry
                    // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
                    let firstBlinds = percentagesFixed < 0 ? "right" : "left";
                    let secondBlinds = percentagesFixed < 0 ? "left" : "right";

                    // get total travel distance
                    let deltasFixed = currentPercentageStatesFixed - percentagesFixed;
                    // find the percentage of that travel that the first blind is responsible for
                    let firstTravelsFixed = currentPercentageStatesFixed / deltasFixed;
                    let secondTravelsFixed = 1 - firstTravelsFixed;


                    // animate the first blind.
                    $(`.blindsFixed.${firstBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesFixed}%)`,
                                easing: easingsFixed
                            },
                            {
                                // we go towards the target value instead of 0 since we'll cut the animation short
                                transform: `translateX(${percentagesFixed}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsFixed,
                            // cut the animation short, this should run the animation to this x value of the easing function
                            iterations: easeReversalsFixed(firstTravelsFixed)

                        }
                    );

                    // animate the second blind
                    $(`.blindsFixed.${secondBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesFixed}%)`,
                                easing: easingsFixed
                            },
                            {
                                transform: `translateX(${percentagesFixed}%)`
                            }
                        ],

                        {
                            fill: "forwards",
                            duration: durationsFixed,
                            // start the iteration where the first should have left off. This should put up where the easing function left off
                            iterationStart: easeReversalsFixed(firstTravelsFixed),
                            // we only need to carry this aniamtion the rest of the way
                            iterations: 1 - easeReversalsFixed(firstTravelsFixed),
                            // delay this animation until the first "meets" it
                            delay: durationFixed * easeReversalsFixed(firstTravelsFixed)
                        }
                    );
                }
                // save the new value so that the next iteration has a proper from keyframe
                currentPercentageStatesFixed = percentagesFixed;
            }

            // the following are just binding set ups for the buttons
            $(document).ready(function () {
                animatesFixed($('#Fixed').val());

            });


            // Lagging and Momentum	//


            let currentPercentageStatesLagging = 0;
            let easingsLagging = "cubic-bezier(0.5, 1, 0.89, 1)";
            let durationsLagging = 1000;
            let easeReversalsLagging = y => (1 - Math.sqrt((y - 1) / -1))


            function animatesLagging(percentagesLagging) {
                percentagesLagging = parseFloat(percentagesLagging);

                // determine if we've crossed the 0 threshold, which would force us to do something else here
                let thresholdsLagging = currentPercentageStatesLagging / percentagesLagging < 0;
                if (!thresholdsLagging && percentagesLagging != 0) {
                    // determine which blind we're animating
                    let blindsLagging = percentagesLagging < 0 ? "left" : "right";
                    if (percentagesLagging < 0) {
                        $("#LaggingLeft").addClass("left-demo");
                        $("#LaggingLeft").attr("title", parseFloat(percentagesLagging).toFixed(2));
                    } else {
                        $("#LaggingRight").addClass("right-demo");
                        $("#LaggingRight").attr("title", parseFloat(percentagesLagging).toFixed(2));
                    }
                    $(`.blindsLagging.${blindsLagging}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesLagging}%)`,
                                easing: easingsLagging
                            },
                            {
                                transform: `translateX(${percentagesLagging * 100}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsLagging
                        }
                    );
                } else {
                    // this happens when we cross the 0 boundry
                    // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
                    let firstBlinds = percentagesLagging < 0 ? "right" : "left";
                    let secondBlinds = percentagesLagging < 0 ? "left" : "right";

                    // get total travel distance
                    let deltasLagging = currentPercentageStatesLagging - percentagesLagging;
                    // find the percentage of that travel that the first blind is responsible for
                    let firstTravelsLagging = currentPercentageStatesLagging / deltasLagging;
                    let secondTravelsLagging = 1 - firstTravelsLagging;


                    // animate the first blind.
                    $(`.blindsLagging.${firstBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesLagging}%)`,
                                easing: easingsLagging
                            },
                            {
                                // we go towards the target value instead of 0 since we'll cut the animation short
                                transform: `translateX(${percentagesLagging}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsLagging,
                            // cut the animation short, this should run the animation to this x value of the easing function
                            iterations: easeReversalsLagging(firstTravelsLagging)

                        }
                    );

                    // animate the second blind
                    $(`.blindsLagging.${secondBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesLagging}%)`,
                                easing: easingsLagging
                            },
                            {
                                transform: `translateX(${percentagesLagging}%)`
                            }
                        ],

                        {
                            fill: "forwards",
                            duration: durationsLagging,
                            // start the iteration where the first should have left off. This should put up where the easing function left off
                            iterationStart: easeReversalsLagging(firstTravelsLagging),
                            // we only need to carry this aniamtion the rest of the way
                            iterations: 1 - easeReversalsLagging(firstTravelsLagging),
                            // delay this animation until the first "meets" it
                            delay: durationLagging * easeReversalsLagging(firstTravelsLagging)
                        }
                    );
                }
                // save the new value so that the next iteration has a proper from keyframe
                currentPercentageStatesLagging = percentagesLagging;
            }

            // the following are just binding set ups for the buttons
            $(document).ready(function () {
                animatesLagging($('#Lagging').val());

            });

            // Emerging  and Developed	//


            let currentPercentageStatesEmerging = 0;
            let easingsEmerging = "cubic-bezier(0.5, 1, 0.89, 1)";
            let durationsEmerging = 1000;
            let easeReversalsEmerging = y => (1 - Math.sqrt((y - 1) / -1))


            function animatesEmerging(percentagesEmerging) {
                percentagesEmerging = parseFloat(percentagesEmerging);

                // determine if we've crossed the 0 threshold, which would force us to do something else here
                let thresholdsEmerging = currentPercentageStatesEmerging / percentagesEmerging < 0;
                if (!thresholdsEmerging && percentagesEmerging != 0) {
                    // determine which blind we're animating
                    let blindsEmerging = percentagesEmerging < 0 ? "left" : "right";
                    if (percentagesEmerging < 0) {
                        $("#EmergingLeft").addClass("left-demo");
                        $("#EmergingLeft").attr("title", parseFloat(percentagesEmerging).toFixed(2));
                    } else {
                        $("#EmergingRight").addClass("right-demo");
                        $("#EmergingRight").attr("title", parseFloat(percentagesEmerging).toFixed(2));
                    }
                    $(`.blindsEmerging.${blindsEmerging}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesEmerging}%)`,
                                easing: easingsEmerging
                            },
                            {
                                transform: `translateX(${percentagesEmerging * 100}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsEmerging
                        },
                    );
                } else {
                    // this happens when we cross the 0 boundry
                    // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
                    let firstBlinds = percentagesEmerging < 0 ? "right" : "left";
                    let secondBlinds = percentagesEmerging < 0 ? "left" : "right";

                    // get total travel distance
                    let deltasEmerging = currentPercentageStatesEmerging - percentagesEmerging;
                    // find the percentage of that travel that the first blind is responsible for
                    let firstTravelsEmerging = currentPercentageStatesEmerging / deltasEmerging;
                    let secondTravelsEmerging = 1 - firstTravelsEmerging;

                    // animate the first blind.

                    $(`.blindsEmerging.${firstBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesEmerging}%)`,
                                easing: easingsEmerging
                            },
                            {
                                // we go towards the target value instead of 0 since we'll cut the animation short
                                transform: `translateX(${percentagesEmerging}%)`
                            }
                        ],
                        {
                            fill: "forwards",
                            duration: durationsEmerging,
                            // cut the animation short, this should run the animation to this x value of the easing function
                            iterations: easeReversalsEmerging(firstTravelsEmerging)

                        }
                    );

                    // animate the second blind
                    $(`.blindsEmerging.${secondBlinds}`)[0].animate(
                        [
                            {
                                transform: `translateX(${currentPercentageStatesEmerging}%)`,
                                easing: easingsEmerging
                            },
                            {
                                transform: `translateX(${percentagesEmerging}%)`
                            }
                        ],

                        {
                            fill: "forwards",
                            duration: durationsEmerging,
                            // start the iteration where the first should have left off. This should put up where the easing function left off
                            iterationStart: easeReversalsEmerging(firstTravelsEmerging),
                            // we only need to carry this aniamtion the rest of the way
                            iterations: 1 - easeReversalsEmerging(firstTravelsEmerging),
                            // delay this animation until the first "meets" it
                            delay: duration * easeReversalsEmerging(firstTravelsEmerging)
                        }
                    );
                }
                // save the new value so that the next iteration has a proper from keyframe
                currentPercentageStatesEmerging = percentagesEmerging;
            }

            // the following are just binding set ups for the buttons
            $(document).ready(function () {
                animatesEmerging($('#Emerging').val());
            });

        });


    </script>
    <script class="scriptid">
        window.addEventListener('contentChanged', event => {
            $(document).on('click', '#buttons', function () {
                $('#spinner').show();
                $(this).hide();
            });
            $('#search_button').on('click', function () {
                $('#search_button').hide();
                $('#spinner_icon').show();
                $(this).hide();
            });
            $('.bar-percentage[data-percentage]').each(function () {
                var progress = $(this);
                let duration = 1000;
                var percentage = Math.ceil($(this).attr('data-percentage'));
                if (percentage > '700') {

                    if (percentage > '1000') {
                        $({countNum: 0}).animate({countNum: percentage / 100}, {
                            duration: duration,
                            easing: 'linear',
                            step: function () {
                                // What todo on every count
                                var pct = Math.floor(this.countNum);

                                progress.text(pct) && progress.siblings().children().css('width', pct);
                            }
                        });
                    }
                    $({countNum: 0}).animate({countNum: percentage / 10}, {
                        duration: duration,
                        easing: 'linear',
                        step: function () {
                            // What todo on every count
                            var pct = Math.floor(this.countNum);

                            progress.text(pct) && progress.siblings().children().css('width', pct);
                        }
                    });

                } else if (percentage < '700') {
                    $({countNum: 0}).animate({countNum: percentage}, {
                        duration: duration,
                        easing: 'linear',
                        step: function () {
                            // What todo on every count
                            var pct = Math.floor(this.countNum);

                            progress.text(pct) && progress.siblings().children().css('width', pct);
                        }
                    });
                }

            });

            $(document).on('click', '#buttons', function () {
                $('#spinner').show();
                $(this).hide();
            });
        });
    </script>
</div>
<script src="https://code.jquery.com/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('#buttons').on('click', function () {
        $('.scriptid').remove();

        function AddNewExternalScriptToThisPage(ExternalScriptURLPath) {
            var headID = document.getElementsByTagName("head")[0];
            var newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            newScript.src = ExternalScriptURLPath;
            newScript.onload = scriptHasLoadedContinue;
            headID.appendChild(newScript);
        }

    });
    $('#search_button').on('click', function () {
        $('.scriptid').remove();

        function AddNewExternalScriptToThisPage(ExternalScriptURLPath) {
            var headID = document.getElementsByTagName("head")[0];
            var newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            newScript.src = ExternalScriptURLPath;
            newScript.onload = scriptHasLoadedContinue;
            headID.appendChild(newScript);
        }

    });


</script>

