<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
    <table class="historical">
        <thead class="bg-gray-300 mt:hidden">
            <tr>
                <th class="px-6 py-4">Date</th>
                <th class="px-6 py-4">Trade</th>
                <th class="px-6 py-4">Ticker</th>
                <th class="px-6 py-4">Company Name</th>
                <th class="px-6 py-4">Summary</th>
                <th class="px-6 py-4">Taxable Gain / (Loss)</th>
                <th class="px-6 py-4">Transaction Proceeds (Cost)</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($tradesdata as $trad)
            @php
                $taxable=($trad->share_price-$trad->ave_cost)*($trad->stock);
                $companyname=explode('-',$trad->security_name)
            @endphp
            <tr class="mt:flex mt:flex-col mt:border-2-solid-black mt:border-r-11 mt:mb-2">
                <td data-label="Date" class="p-3 whitespace-nowrap text-center text-gray-900 mt:grid mt:text-xs mt:text-left mt:py-1 mt:px-3">{{\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y') }}</td>
                <td data-label="Trade" class="p-3 whitespace-nowrap text-center text-gray-900 mt:grid mt:text-xs mt:text-left mt:py-1 mt:px-3">{{ $trad->type==0?'Buy':'Sell' }}</td>
                <td data-label="Ticker" class="p-3 whitespace-nowrap text-center text-gray-900 mt:grid mt:text-xs mt:text-left mt:py-1 mt:px-3"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $trad->stock_id }})">{{ $trad->stock_ticker }}</a></td>
                <td data-label="Company Name" class="p-3 whitespace-nowrap text-center text-gray-900 mt:grid mt:text-xs mt:text-left mt:py-1 mt:px-3"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $trad->stock_id }})"><p class="whitespace-normal">{{$trad->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$trad->company_name}}</p></a></td>
                <td data-label="Summary" class="p-3 whitespace-nowrap text-center text-gray-900 mt:grid mt:text-xs mt:text-left mt:py-1 mt:px-3"><p class="whitespace-normal">{!! $trad->type==0?'Purchased '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share':'Sold '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share'  !!}</p></td>
                <td data-label="Taxable Gain / (Loss)" class="p-3 whitespace-nowrap text-center mt:grid mt:text-xs mt:text-left mt:py-1 mt:px-3 {{$taxable<0?"text-red-600":"text-green-600"}}">{{$trad->type==1?$taxable<0?"($".number_format(abs($taxable),2).")":"$".number_format($taxable,2):'-'}}</td>
                <td data-label="Proceeds" class="p-3 whitespace-nowrap text-center mt:grid mt:text-xs mt:text-left mt:py-1 mt:px-3 {{$trad->type==0?'text-red-600':'text-green-600'}}">{{ $trad->type==0?'($'.number_format($trad->stock*$trad->share_price,2).")":'$'.number_format($trad->stock*$trad->share_price,2) }}</td>
            </tr>
        @empty
            <tr>
                <th class="text-center px-6 py-4" colspan="8">No Stock Found</th>
            </tr>
        @endforelse
        </tbody>
    </table>
    @if(count($tradesdata->links()['elements'][0])>1)
        <div class="p-5">
            {{$tradesdata->links()}}
        </div>
    @endif
</div>
