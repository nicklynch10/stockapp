
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

            .displaynone {
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
                <div class="col-span-5 sm:col-span-4">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input wire:model.debounce.2000ms="ticker" type="search" id="default-search" class="inline p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                        <button type="submit" class="absolute top-2.5 bottom-2.5 bg-green-800 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 " id="search_button">Search</button>
                        <button disabled wire:loading.delay.shortest wire:target="ticker" type="button" class="hidden absolute right-2 top-2.5 bottom-2.5 bg-green-800 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2" id="spinner_icon">
                            <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                            </svg>
                            Loading...
                        </button>

                    </div>
                </div>
                <div class="col-span-4 sm:col-span-4">
                <a wire:click="showETFs"
                   class="bg-green-300 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition cursor-pointer"
                   id="buttons">
                    @if($etfs)
                        {{ __('Show Stocks Only') }}
                    @else
                        {{ __('Show ETFs Only') }}
                    @endif
                </a></div>
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

        <div class="flex justify-center items-center spinner hidden mt-4" id="spinner">
            <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-green-500 spinner"
                 id="spinner" role="status" aria-hidden="true">
                <span class="visually-hidden">.</span>
            </div>
        </div>
    </div>

    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5 overflow-hidden">
                        <div class="flex justify-between items-center w-full border-b-2 border-gray-300">
                            @if($etfs)
                                <h2 class="text-xl font-black">Your Comparable ETFs</h2>
                            @else
                                <h2 class="text-xl font-black">Your Comparable Stocks</h2>
                            @endif
                            <select wire:change="" class="shadow appearance-none border mb-3 w-60 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option>Sort By</option>
                                <option>Stock Ticker</option>
                                <option>Company Name</option>
                                <option>Correlation With Ticker</option>
                                <option>Beta (S&P 500)</option>
                                <option>Dividend Yield</option>
                                <option>@if($etfs)
                                        Assets Under Management(AUM)
                                    @else
                                        Market Cap
                                    @endif</option>
                                <option>@if($etfs)
                                        Expense Ratio
                                    @else
                                        PE Ratio
                                    @endif</option>
                                <option>1 Year % Change</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-3 xl:grid-cols-3 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full">

                            @if($ticker != "" & count($correlations)>0)
                                @foreach($correlations->sortByDesc("correlation")->slice(0, 500)->take(30) as $result)
                                    @if($result && isset($result->ticker2))
                                        <div class="m-2">
                                            <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                                                <div class="mt-3 my-1">
                                                    <div class="flex flex-col items-center xs:flex-col xl:flex-col md:flex-col">
                                                        <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                                            @php
                                                                $string = $result['ticker2'];
                                                                if (strpos($string, "http") === 0) {
                                                                    $logoUrl = $result['ticker2'];
                                                                } else {
                                                                    $logoUrl = 'https://ui-avatars.com/api/?name='.$result["ticker2"].'&color=7F9CF5&background=EBF4FF';
                                                                }
                                                            @endphp
                                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                                <img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                                                            </h5>
                                                            <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                                                <a class="whitespace-normal">{{$result->ticker2}}</a>
                                                            </h5>
                                                            <span class="mb-1 break-words break-all text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">{{$result->SI2->company_name}}</span>
                                                            <span class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark"> <span class="font-bold">~{{number_format($result->correlation*100,0).'%'}}</span><br>
                                                                Correlation  with <br> {{$ticker}}
                                                            </span>
                                                        </div>
                                                        <div class="flex flex-col justify-between p-4 leading-normal" style="width: 255px">
                                                            <div class="flow-root">
                                                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <span class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    Beta (S&P 500):
                                                                                </span>
                                                                            </div>
                                                                            <div class="inline-flex items-center break-all text-sm">
                                                                                <span class="break-all text-red-700">{{number_format($result->SI2->calced_beta,2)}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <span class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    Dividend Yield
                                                                                </span>
                                                                            </div>
                                                                            <div class="inline-flex items-center text-sm">
                                                                                <span class="break-all text-red-700">{{number_format($result->SI2->div_yield*100,2).'%'}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <span class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    @if($etfs)
                                                                                        Assets Under Management(AUM):
                                                                                    @else
                                                                                        Market Cap:
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="inline-flex items-center text-sm">
                                                                                <span class="break-all text-green-700">${{number_format($result->SI2->marketcap/1000,0).''.'M'}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    @php
                                                                        $this->token = env('IEX_CLOUD_KEY', null);
                                                                        $this->endpoint = env('IEX_CLOUD_ENDPOINT', null);
                                                                        $url = ($this->endpoint . 'stable/stock/'.$result->ticker2.'/stats?token=' . $this->token);
                                                                        $data = Http::get($url);
                                                                        $stats = $data->json()

                                                                    @endphp
                                                                    @if($stats!='')
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <span class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    @if($etfs)
                                                                                        Expense Ratio:
                                                                                    @else
                                                                                        PE Ratio:
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="inline-flex items-center text-sm">

                                                                                <span class="break-all text-green-700">
                                                                                    @if($stats!='')
                                                                                        {{number_format( $stats['peRatio'],2)}}
                                                                                    @else
                                                                                        N/A
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    @endif
                                                                    <li class="py-1 sm:py-4">
                                                                        <div class="flex items-center space-x-4">
                                                                            <div class="flex-1 min-w-0">
                                                                                <span class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                                    1 Year % Change:
                                                                                </span>
                                                                            </div>
                                                                            <div class="inline-flex items-center text-sm">
                                                                                <span class="break-all text-green-700">
                                                                                    {{$result->SI2->year1ChangePercent*100<0?"(".number_format(abs($result->SI2->year1ChangePercent*100),2)."%)":number_format($result->SI2->year1ChangePercent*100,2)."%"}}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
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
    $('#search_button').on('click', function () {
        console.log("hello");
        $('#search_button').hide();
        $('#spinner_icon').show();
        $(this).hide();
    });
</script>

