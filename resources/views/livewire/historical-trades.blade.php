<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
    <table>
        <thead class="bg-gray-300">
            <tr>
                <th class="px-6 py-4 w-20">No.</th>
                <th class="px-6 py-4">Trade</th>
                <th class="px-6 py-4">Company Name</th>
                <th class="px-6 py-4">Summary</th>
                <th class="px-6 py-4">Ticker</th>
                <th class="px-6 py-4">Date</th>
                <th class="px-6 py-4">Taxable Gain / (Loss)</th>
                <th class="px-6 py-4">Proceeds</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @php $i=1; @endphp
        @forelse($tradesdata as $trad)
            @php
                $taxable=($trad->share_price-$trad->ave_cost)*($trad->stock);
                $securityname=explode("-",$trad->security_name);
            @endphp
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $i++ }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->type==0?'Buy':'Sell' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ isset($securityname[1])?$securityname[1]:$securityname[0] }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->type==0?'Purchased '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share':'Sold '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->stock_ticker }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center {{$taxable<0?"text-red-600":"text-green-600"}}">{{$trad->type==1?$taxable<0?"($".number_format(abs($taxable),2).")":"$".number_format($taxable,2):'-'}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center {{$trad->type==0?'text-red-600':'text-green-600'}}">{{ $trad->type==0?'($'.number_format($trad->stock*$trad->share_price,2).")":'$'.number_format($trad->stock*$trad->share_price,2) }}</td>
            </tr>
        @empty
            <tr>
                <th class="text-center px-6 py-4" colspan="8">No Stock Found</th>
            </tr>
        @endforelse
        </tbody>
    </table>
    @if($tradesdata->links())
        <div class="p-5">
            {{$tradesdata->links()}}
        </div>
    @endif
</div>

