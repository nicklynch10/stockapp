<div>
    <div class="container mx-auto px-4 py-10 md:py-12 grid grid-cols-12 gap-2">

            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-8 sm:col-span-8 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ __('Asset Allocation') }}
                            </h3>
                            <div class="overflow-hidden sm: rounded-lg table-align justify-center flex-row pt-10">
                                <canvas id="myChart" height="500" style="width:100%;max-width:2000px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex shadow flex-col bg-white sm:rounded-lg px-4 py-4 col-start-9 col-span-4 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight font-black pb-3">
                                {{ __('Stocks') }}
                            </h2>
                            <hr>
                            <div class="overflow-hidden sm: rounded-lg table-align">
                                <div class="bg-white rounded self-start">
                                    @foreach($this->stock as $s)
                                        @php
                                            $token = env('IEX_CLOUD_KEY', null);
                                            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                                            $current_price = Http::get($endpoint . 'stable/stock/' . $s->stock_ticker . '/quote?token=' . $token);
                                            $price = $current_price->json()
                                        @endphp
                                    <div class="grid grid-cols-12 flex items-center md:text-center border-gray-200 py-4 px-4 lg:px-6 border-b-2 space-x-2 w-full xs:flex-col xs:flex xs:text-center xs:flex-wrap xs:justify-center">
                                        <div class="col-span-8 col-start-1 xs:col-start-3 col-end-8 text-left xs:text-center">
                                             <span class=" h-full text-left font-black">{{ $s->stock_ticker }}</span><br>
                                             <span>{{ $s->share_number }} Shares</span>
                                        </div>
                                        <div class="col-span-2 col-start-10 p-2">
                                            <span>${{ $price['latestPrice'] }}</span><br>
                                            <span>{{ $price['changePercent']*100 }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
