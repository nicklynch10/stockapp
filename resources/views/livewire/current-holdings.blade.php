<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
    <table>
        <thead class="bg-gray-300">
        <tr>
            <th wire:click="sort('stock_ticker')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Stock Ticker<span>
                @if($sortColumn === 'stock_ticker')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('stock_ticker')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Company name<span>
                @if($sortColumn === 'company_name')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('share_number')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Share Count<span>
                @if($sortColumn === 'share_number')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('ave_cost')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Cost Basis<span>
                @if($sortColumn === 'ave_cost')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('current_share_price')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Share Price<span>
                @if($sortColumn === 'current_share_price')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('dchange')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> $ Change<span>
                @if($sortColumn === 'dchange')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('pchange')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> % Change<span>
                @if($sortColumn === 'pchange')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('current_total_value')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> Market Value<span>
                @if($sortColumn === 'current_total_value')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('total_cost')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> Total Cost<span>
                @if($sortColumn === 'total_cost')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('total_gain_loss')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Total Gain / (Loss)<span>
                @if($sortColumn === 'total_gain_loss')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('total_long_term_gains')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Tax Classification<span>
                @if($sortColumn === 'total_long_term_gains')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($currentholding as $curr)
            @php
                $companyname=explode('-',$curr->security_name);
            @endphp
            @if($curr->share_number!=0)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$curr->stock_ticker}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker"><p class="whitespace-normal">{{$curr->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$curr->company_name}}</p></td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Share Count">{{$curr->share_number}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Cost Basis">${{number_format($curr->ave_cost,2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Share Price">${{number_format($curr->current_share_price,2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="$ Change">{{$curr->dchange<0?"($".number_format(abs($curr->dchange),2).")":"$".number_format(abs($curr->dchange),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="% Change">{{$curr->pchange<0?"(".number_format(abs($curr->pchange),2)."%)":number_format(abs($curr->pchange),2)."%"}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Market Value">{{$curr->current_total_value<0?"($".number_format(abs($curr->current_total_value),2).")":"$".number_format(abs($curr->current_total_value),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Total Cost">{{$curr->total_cost<0?"($".number_format(abs($curr->total_cost),2).")":"$".number_format(abs($curr->total_cost),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center {{$curr->total_gain_loss<0?"text-red-600":"text-green-600"}}" data-label="Total Gain / (Loss)">{{$curr->total_gain_loss<0?"($".number_format(abs($curr->total_gain_loss),2).")":"$".number_format(abs($curr->total_gain_loss),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Tax Classification">{{$curr->total_long_term_gains}}</td>
            </tr>
            @endif
        @empty
            <tr>
                <th class="text-center px-6 py-4" colspan="11">No Stock Found</th>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

