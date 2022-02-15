
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
                                <th class="px-6 py-4">Total  $ Losses</th>
                                <th class="px-6 py-4">Total  $ Gains</th>
                                <th class="px-6 py-4">Total  $ Long Term Gains</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $i=1;
                            @endphp
                            @forelse($this->stocks as $stock)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$i++}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$stock->stock_ticker}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$stock->ave_cost*$stock->current_share_price}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">-</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No Data Found</td>
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
            "{{$st->stock_ticker}}",
            @endforeach];
        var yValues = [
            @foreach($this->stocks as $st)
                @php
                    $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                    $endpoint = 'https://cloud.iexapis.com/';
                    $current_price = Http::get($endpoint . 'stable/stock/' . $st->stock_ticker . '/quote?token=' . $token);
                    $price = $current_price->json();
                @endphp
                {{ $st->share_number*$price['latestPrice']}},
            @endforeach];
        var barColors = ["#10B981", "#FECACA", "#BFDBFE",
            "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#F87171", "#4338CA", "#EFF6FF", "#FDF2F8", "#ECFDF5", "#FEF3C7", "#F3F4F6", "#EDE9FE", "#F9A8D4", "#BFDBFE", "#FECACA", "#F87171",
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




















