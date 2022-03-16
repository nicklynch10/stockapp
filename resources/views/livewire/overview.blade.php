<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Overview')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Current Holdings') }}
                        </h2>
                    </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        @livewire('current-holdings')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col bg-white shadow-xl sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Asset Allocation') }}
                        </h2>
                    </div>
                    <div class="overflow-hidden sm: rounded-lg table-align">
{{--                        <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>--}}
                        <div class="chart has-fixed-height" id="pie_basic" style="width: 100%;height: 500px;"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





{{--    <script type="text/javascript">--}}
{{--        window.onload = function () {--}}
{{--            var chart = new CanvasJS.Chart("chartContainers",--}}
{{--                {--}}
{{--                    data: [--}}
{{--                        {--}}
{{--                            type: "pie",--}}
{{--                            showInLegend: true,--}}
{{--                            toolTipContent: "{hover}",--}}
{{--                            legendText: "{indexLabel}",--}}
{{--                            dataPoints: [--}}
{{--                                @foreach($this->sto as $st)--}}
{{--                                    @php $total=0; $value=''; @endphp--}}
{{--                                    @foreach($this->tran as $t)--}}
{{--                                        @if($st->stock_ticker==$t->ticker_name)--}}
{{--                                            @php--}}
{{--                                                if($t->type==0)--}}
{{--                                                {--}}
{{--                                                    $total+=$t->stock;--}}
{{--                                                }--}}
{{--                                                elseif($t->type==1)--}}
{{--                                                {--}}
{{--                                                    $total-=$t->stock;--}}
{{--                                                }--}}
{{--                                                $value.= $t->type==0?$total." => ".$t->stock." Buy of ".$t->ticker_name." for $".number_format($t->share_price,2)." per share <br>":$total." => ".$t->stock." sale of ".$t->ticker_name." for $".number_format($t->share_price,2)." per share <br>";--}}
{{--                                            @endphp--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                    {  y: {{$total}}, indexLabel: "{{$st->stock_ticker}}",hover:"{!! $value !!}" },--}}
{{--                                @endforeach--}}
{{--                            ]--}}
{{--                        }--}}
{{--                    ]--}}
{{--                });--}}
{{--            chart.render();--}}
{{--        }--}}
{{--    </script>--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.1/echarts.min.js" integrity="sha512-41TNls7qBS/8rKqfgMho0blSRty2TgHbdHq1h8x248EseHj1ZfFPAbjWVBQssJtkXptUwaBLVC3F1W8he53bgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var pie_basic_element = document.getElementById('pie_basic');
        if (pie_basic_element) {
            var pie_basic = echarts.init(pie_basic_element);
            pie_basic.setOption({

                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 18
                },
                title: {
                    text: '',
                    left: 'center',
                    textStyle: {
                        fontSize: 20,
                        fontWeight: 800,
                        color:'#000',
                    },
                    subtextStyle: {
                        fontSize: 12
                    }
                },

                tooltip: {
                    trigger: 'item',
                    backgroundColor: '#fff',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 15,
                        color:'#000',
                        fontWeight: 500,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{b}: ${c}"
                },

                legend: {
                    orient: 'horizontal',
                    bottom: '0%',
                    left: 'center',
                    data: [
                        @foreach($this->sto as $st)
                        '{{$st->stock_ticker}}',
                        @endforeach
                    ],
                    itemHeight: 8,
                    itemWidth: 8
                },

                series: [{
                    name: 'Product Type',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '50%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: [
                        @foreach($this->sto as $st)
                            @if($st->total_stock!=0)
                            @php
                                $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                                $endpoint = 'https://cloud.iexapis.com/';
                                $current_price = Http::get($endpoint . 'stable/stock/' . $st->stock_ticker . '/quote?token=' . $token);
                                $price = $current_price->json()
                            @endphp

                            {value: {{ $st->total_stock*$price['latestPrice']}}, name: '{{$st->stock_ticker}}'},
                            @endif
                        @endforeach
                    ]
                }]
            });
        }
    </script>
{{--    <script type="text/javascript" src="/js/chart.js"></script>--}}
</main>




















