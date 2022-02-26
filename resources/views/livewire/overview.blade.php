
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Overview')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col overflow-x-auto bg-white shadow-xl sm:rounded-lg px-4 py-4">
            <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Current Holdings') }}
                        </h2>
                    </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        <table>
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-6 py-4 w-20">No.</th>
                                    <th class="px-6 py-4">Stock Ticker</th>
                                    <th class="px-6 py-4">Number of Shares</th>
                                    <th class="px-6 py-4">Cost Basis</th>
                                    <th class="px-6 py-4">Current Price</th>
{{--                                    <th class="px-6 py-4">$ Change</th>--}}
{{--                                    <th class="px-6 py-4">% Change</th>--}}
                                    <th class="px-6 py-4">Current Total Value</th>
                                    <th class="px-6 py-4">Total Cost</th>
                                    <th class="px-6 py-4">Total  % Change</th>
                                    <th class="px-6 py-4">Total  $ Change</th>
                                    <th class="px-6 py-4">Total $ Gains/Losses</th>
                                    <th class="px-6 py-4">Total  $ Long Term Gains</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $i=1;
                            @endphp
                            @forelse($this->stocks as $stock)
                                @php
                                    $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                                    $endpoint = 'https://cloud.iexapis.com/';
                                    $current = Http::get($endpoint . 'stable/stock/'.$stock->stock_ticker.'/quote?token=' . $token);
                                    $price_current = $current->json();
                                    $buy=0;
                                    $sell=0;
                                    $totalshare=0;
                                    $sharebuy=0;
                                    $sharesell=0;
                                    foreach($this->transaction as $tra)
                                    {
                                          if($tra->stock_id==$stock->id)
                                          {
                                                if($tra->type==0)
                                                {
                                                    $buy=$tra->share_price;
                                                    $sharebuy+=$tra->stock;
                                                }
                                                elseif ($tra->type==1)
                                                {
                                                    $sell=$tra->share_price;
                                                    $sharesell+=$tra->stock;
                                                }
                                          }
                                    }
                                    $current_total_value=($price_current['latestPrice']*$stock->share_number);
                                    $total_cost=($stock->ave_cost*$stock->share_number);
                                    $gain=($sharesell)*($sell-$buy);
                                    $diff=date_diff(date_create(\Carbon\Carbon::createFromTimestamp(strtotime($stock->date_of_purchase))->format('Y-m-d')),date_create(date('Y-m-d')));
                                    $dchange=($price_current['latestPrice']-$stock->ave_cost)*$stock->share_number;
                                    $pchange=($price_current['latestPrice']/$stock->ave_cost)-1;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$i++}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$stock->stock_ticker}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$sharebuy-$sharesell}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">${{number_format($stock->ave_cost,2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">${{number_format($price_current['latestPrice'],2)}}</td>
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$dchange<0?"($".number_format(abs($dchange),2).")":"$".number_format(abs($dchange),2)}}</td>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$pchange<0?"(".number_format(abs($pchange),2)."%)":number_format(abs($pchange),2)."%"}}</td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$current_total_value<0?"($".number_format(abs($current_total_value),2).")":"$".number_format(abs($current_total_value),2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$total_cost<0?"($".number_format(abs($total_cost),2).")":"$".number_format(abs($total_cost),2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center {{$current_total_value/$total_cost-1<0?"text-red-600":"text-green-600"}}">{{$current_total_value/$total_cost-1<0?"(".abs(number_format(($current_total_value/$total_cost)-1,2))."%)":abs(number_format(($current_total_value/$total_cost)-1,2))."%"}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center {{$current_total_value-$total_cost<0?"text-red-600":"text-green-600"}}">{{$current_total_value-$total_cost<0?"($".number_format(abs($current_total_value-$total_cost),2).")":"$".number_format(abs($current_total_value-$total_cost),2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center {{$gain<0?"text-red-600":"text-green-600"}}">{{$gain<0?"($".number_format(abs($gain),2).")":"$".number_format(abs($gain),2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$diff->format("%a")>366?"Long":"Short"}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <th class="text-center px-6 py-4" colspan="10">No Stock Found</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
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
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var xValues = [@foreach($this->stocks as $st)
            @if($st->share_number!=0)
            "{{$st->stock_ticker}}",
            @endif
            @endforeach];
        var yValues = [
            @foreach($this->stocks as $st)
                @if($st->share_number!=0)
                    @php
                        $totalshare=0;
                       foreach($this->transaction as $tran)
                       {
                           if($st->id==$tran->stock_id)
                           {
                               $totalshare+=$tran->stock;
                           }
                       }
                       $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                       $endpoint = 'https://cloud.iexapis.com/';
                       $current_price = Http::get($endpoint . 'stable/stock/' . $st->stock_ticker . '/quote?token=' . $token);
                       $price = $current_price->json();
                    @endphp
                    {{ $totalshare*$price['latestPrice']}},
                @endif
            @endforeach];
        var barColors = ["#10B981", "#FECACA", "#BFDBFE",
            "#D97706", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#F87171", "#4338CA", "#EFF6FF", "#FDF2F8", "#ECFDF5", "#FEF3C7", "#F3F4F6", "#EDE9FE", "#F9A8D4", "#BFDBFE", "#FECACA", "#F87171",
            "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA",
            "#BFDBFE", "#FECACA", "#F87171",
            "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA", "#EFF6FF", "#FDF2F8", "#ECFDF5", "#FEF3C7", "#F3F4F6", "#EDE9FE", "#F9A8D4", "#BFDBFE", "#FECACA", "#F87171",
            "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA" ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data:yValues
                }]
            },
            options: {
                title: {
                    display: true,
                }
            }
        });
    </script>
</main>




















