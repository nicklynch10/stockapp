<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
    <table>
        <thead class="bg-gray-300">
        <tr>
            <th class="px-4 py-2 w-20">No.</th>
            <th wire:click="sort('stock_ticker')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Stock Ticker<span>
                @if($sortColumn === 'stock_ticker')
                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                @else
                    <i class="fas fa-sort"></i>
                @endif
        </span></th>
            <th wire:click="sort('share_number')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Number of Shares<span>
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
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Current Price<span>
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
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> Current Total Value<span>
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
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Total $ Gains/Losses<span>
                @if($sortColumn === 'total_gain_loss')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('total_long_term_gains')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Total  $ Long Term Gains<span>
                @if($sortColumn === 'total_long_term_gains')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @php $i=1; @endphp
        @forelse($currentholding as $curr)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$i++}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->stock_ticker}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->share_number}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">${{number_format($curr->ave_cost,2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">${{number_format($curr->current_share_price,2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->dchange<0?"($".number_format(abs($curr->dchange),2).")":"$".number_format(abs($curr->dchange),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->pchange<0?"(".number_format(abs($curr->pchange),2)."%)":number_format(abs($curr->pchange),2)."%"}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->current_total_value<0?"($".number_format(abs($curr->current_total_value),2).")":"$".number_format(abs($curr->current_total_value),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->total_cost<0?"($".number_format(abs($curr->total_cost),2).")":"$".number_format(abs($curr->total_cost),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center {{$curr->total_gain_loss<0?"text-red-600":"text-green-600"}}">{{$curr->total_gain_loss<0?"($".number_format(abs($curr->total_gain_loss),2).")":"$".number_format(abs($curr->total_gain_loss),2)}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$curr->total_long_term_gains}}</td>
            </tr>
        @empty
            <tr>
                <th class="text-center px-6 py-4" colspan="11">No Stock Found</th>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
