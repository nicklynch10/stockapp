
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Overview')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col bg-white shadow-xl sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Tax Basis') }}
                        </h2>
                    </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        <table>
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 w-20">No.</th>
                                <th class="px-6 py-4">Stock Ticker</th>
                                <th class="px-6 py-4">Current total value</th>
                                <th class="px-6 py-4">Total cost</th>
                                <th class="px-6 py-4">Number of unique stocks</th>
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
                                    $current = Http::get($endpoint . 'stable/stock/VOE/quote?token=' . $token);
                                    $price_current = $current->json();
                                    $buy=0;
                                    $sell=0;
                                    $totalshare=0;
                                    $sharebuy=0;
                                    $sharesell=0;
                                    foreach($this->transaction as $tra)
                                    {
                                          if($tra->s_id==$stock->id)
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
                                    $current_total_value=($price_current['latestPrice']*($buy-$sell));
                                    $total_cost=($stock->ave_cost*($buy-$sell)); //
                                    $gain=($sharesell)*($sell-$buy);
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$i++}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$stock->stock_ticker}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{round($current_total_value,2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{round($total_cost,2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$sharebuy-$sharesell}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center {{$current_total_value/$total_cost-1<0?"text-red-600":"text-green-600"}}">{{$current_total_value/$total_cost-1<0?"(".abs(number_format(($current_total_value/$total_cost)-1,2)).")":abs(number_format(($current_total_value/$total_cost)-1,2))}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center {{$current_total_value-$total_cost<0?"text-red-600":"text-green-600"}}">{{$current_total_value-$total_cost<0?"(".number_format(abs($current_total_value-$total_cost),2).")":number_format(abs($current_total_value-$total_cost),2)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center {{$gain<0?"text-red-600":"text-green-600"}}">{{$gain<0?"(".abs($gain).")":abs($gain)}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
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
                           if($st->id==$tran->s_id)
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




















