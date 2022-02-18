<div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
    <table>
        <thead class="bg-gray-100">
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-20">No.</th>
            <th wire:click="sort('stock_ticker')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500 tracking-wider font-bold">Ticker<span>
            @if($sortColumn === 'stock_ticker')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('company_name')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500  tracking-wider font-bold w-20">Stock<span>
            @if($sortColumn === 'company_name')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('share_number')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500  tracking-wider font-bold">Shares<span>
            @if($sortColumn === 'share_number')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('ave_cost')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500 tracking-wider font-bold">Cost basis<span>
            @if($sortColumn === 'ave_cost')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th wire:click="sort('current_share_price')"
                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500 tracking-wider font-bold">Current Price<span>
            @if($sortColumn === 'current_share_price')
                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                    @else
                        <i class="fas fa-sort"></i>
                    @endif
        </span></th>
            <th class="px-4 py-2"> $ Change</th>
            <th class="px-4 py-2"> % Change</th>
            <th class="px-4 py-2">Tax Treatment</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @php $i=1; @endphp
        @forelse($currentholding as $curr)
            @php
                $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                $endpoint = 'https://cloud.iexapis.com/';
                $current_price = Http::get($endpoint . 'stable/stock/' . $curr->stock_ticker . '/quote?token=' . $token);
                $price = $current_price->json();
                $diff=date_diff(date_create(\Carbon\Carbon::createFromTimestamp(strtotime($curr->date_of_purchase))->format('Y-m-d')),date_create(date('Y-m-d')));
            @endphp
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $i++ }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $curr->stock_ticker }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $price['companyName'] }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $curr->share_number }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">${{ $curr->ave_cost }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">${{ $price['latestPrice'] }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">(${{ abs(round(($price['latestPrice']-$curr->ave_cost)*$curr->share_number,2)) }})</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">({{ abs(round(($price['latestPrice']/$curr->ave_cost-1),2)) }}%)</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{$diff->format("%a")>366?"Long":"Short"}}</td>
            </tr>
        @empty
            <tr>
                <th class="text-center px-6 py-4" colspan="9">No Stock Found</th>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
