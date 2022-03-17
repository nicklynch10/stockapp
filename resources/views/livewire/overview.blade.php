<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Overview')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <style>
        @media screen and (max-width: 600px) {
            table tr td{
                display: block;
                font-size: 12px;
            }
            table thead{
                display: none;
            }
            table td{
                text-align: right !important;
            }
            table td:last-child{
                border-bottom: 0;
            }
            table, thead, tbody, th, td, tr {
                display: block;
                font-size: 12px;
                text-align: left !important;
            }
            table td::before{
                content: attr(data-label);
                float: left;
                font-weight: bold;
                width: 15px;
            }
            table td:last-child{
                border-bottom: 1px solid;
            }
            table tr:nth-child(even){background-color: #ffffff !important;}
        }
        table tr:nth-child(even){background-color: #f2f2f294;}
    </style>
    <div class="container mx-auto px-4 py-10 md:py-12 grid grid-cols-12 gap-2">

        {{-- Box1  --}}
        <div class="flex flex-col p-8 bg-blue-200 sm:rounded-lg px-4 py-4 col-start-2 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Total Tax Savings Realized') }}
                        </h3>
                        <h2 class="pt-2 text-2xl">${{$this->totalSavingsRealized}}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Box2  --}}
        <div class="flex flex-col bg-gray-200 sm:rounded-lg px-4 py-4 col-start-4 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Total Taxable Gain / (Loss)') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">${{number_format($this->totalTaxableGainLoss,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Box3  --}}
        <div class="flex flex-col bg-yellow-200 sm:rounded-lg px-4 py-4 col-start-6 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Total Unrealized Gain / (Loss)') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">${{number_format($this->totalUnrealizedGainLoss,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Box4  --}}
        <div class="flex flex-col bg-green-100 sm:rounded-lg px-4 py-4 col-start-8 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Harvestable Losses') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">${{number_format($this->harvestableLosses,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Box5  --}}
        <div class="flex flex-col bg-pink-100 sm:rounded-lg px-4 py-4 col-start-10 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Unrealized Gain') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">${{number_format($this->unrealizedGain,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <div class="chart has-fixed-height" id="pie_basic" style="width: 100%;height: 500px;">

                        </div>
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
                            {{ __('CUMMULATIVE "Taxable Gain / (Loss)"') }}
                        </h2>
                    </div>
                    <div class="overflow-hidden sm: rounded-lg table-align">
                        <div id="google-line-chart" style="height: 600px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>





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
                    formatter: "<b>{b}</b>: ${c}"
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

                            {value: {{ $st->total_stock*$price['latestPrice'] }}, name: '{{$st->stock_ticker}}'},
                            @endif
                        @endforeach
                    ]
                }]
            });
        }
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Date', 'Cummulative'],

                    @php
                        foreach($this->date as $d)
                        {
                            $total=0; $value='';
                            foreach($this->tran as $t)
                            {
                                if($d->date_of_transaction==$t->date_of_transaction)
                                {
                                    if($t->type==0)
                                    {
                                        $total+=$t->stock;
                                    }
                                    elseif($t->type==1)
                                    {
                                        $total-=$t->stock;
                                    }
                                    $value.= $t->type==0?$total." => ".$t->stock." Buy of ".$t->ticker_name." for $".number_format($t->share_price,2)." per share <br>":$total." => ".$t->stock." sale of ".$t->ticker_name." for $".number_format($t->share_price,2)." per share <br>";
                                }
                            }
                            echo "['".$d->date_of_transaction."', $total],";
                        }
                    @endphp
                ]);

                var options = {
                    title: '',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('google-line-chart'));

                chart.draw(data, options);
            }
        </script>
</main>




















