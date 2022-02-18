<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
    <table>
        <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-4 w-20">No.</th>
            <th class="px-6 py-4">Trade</th>
            <th class="px-6 py-4">Summary</th>
            <th class="px-6 py-4">Ticker</th>
            <th class="px-6 py-4">Date</th>
            <th class="px-6 py-4">Proceeds</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @php $i=1; @endphp
        @forelse($tradesdata as $trad)
            @php
                $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                $endpoint = 'https://cloud.iexapis.com/';
                $current_price = Http::get($endpoint . 'stable/stock/' . $trad->stock_ticker . '/quote?token=' . $token);
                $price = $current_price->json();
            @endphp
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $i++ }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->type==0?'Buy':'Sell' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->type==0?'Bought '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F dS, Y').' for $'.$trad->share_price.' per share':'Sold '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F dS, Y').' for $'.$trad->share_price.' per share' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->stock_ticker }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F dS, Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center {{$trad->type==0?'text-red-600':'text-green-600'}}">{{ $trad->type==0?'($'.number_format($trad->stock*$price['latestPrice'],2).')':'($'.number_format($trad->stock*$price['latestPrice'],2).')' }}</td>
            </tr>
        @empty
            <tr>
                <th class="text-center px-6 py-4" colspan="6">No Stock Found</th>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div>
        {{$tradesdata->links()}}
    </div>
</div>

