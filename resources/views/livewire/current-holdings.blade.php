<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
    <table>
        <thead class="bg-gray-100">
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-20">No.</th>
            <th wire:click="sort('stock_ticker')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Stock Ticker<span>
            @if($sortColumn === 'stock_ticker')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('company_name')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Number of Shares<span>
            @if($sortColumn === 'share_number')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('share_number')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Cost Basis<span>
            @if($sortColumn === 'share_number')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('ave_cost')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Current Price<span>
            @if($sortColumn === 'current_share_price')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th class="px-4 py-2"> $ Change</th>
            <th class="px-4 py-2"> % Change</th>
            <th class="px-4 py-2"> Current Total Value</th>
            <th class="px-4 py-2"> Total Cost</th>
            <th class="px-6 py-4">Total $ Gains/Losses</th>
            <th class="px-6 py-4">Total  $ Long Term Gains</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @php $i=1; @endphp
        @forelse($currentholding as $curr)
            @php
                $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                $endpoint = 'https://cloud.iexapis.com/';
                $current = Http::get($endpoint . 'stable/stock/'.$curr->stock_ticker.'/quote?token=' . $token);
                $price_current = $current->json();
                dd($current);
                $buy=0;
                $sell=0;
                $totalshare=0;
                $sharebuy=0;
                $sharesell=0;
                foreach($transaction as $tra)
                {
                      if($tra->stock_id==$curr->id)
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
                $current_total_value=($price_current['latestPrice']*$curr->share_number);
                $total_cost=($curr->ave_cost*$curr->share_number);
                $gain=($sharesell)*($sell-$buy);
                $diff=date_diff(date_create(\Carbon\Carbon::createFromTimestamp(strtotime($curr->date_of_purchase))->format('Y-m-d')),date_create(date('Y-m-d')));
                $dchange=($price_current['latestPrice']-$curr->ave_cost)*$curr->share_number;
                $pchange=($price_current['latestPrice']/$curr->ave_cost)-1;
            @endphp
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$i++}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->stock_ticker}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->share_number}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">${{number_format($curr->ave_cost,2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">${{number_format($price_current['latestPrice'],2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$dchange<0?"($".number_format(abs($dchange),2).")":"$".number_format(abs($dchange),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$pchange<0?"(".number_format(abs($pchange),2)."%)":number_format(abs($pchange),2)."%"}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$current_total_value<0?"($".number_format(abs($current_total_value),2).")":"$".number_format(abs($current_total_value),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$total_cost<0?"($".number_format(abs($total_cost),2).")":"$".number_format(abs($total_cost),2)}}</td>
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
