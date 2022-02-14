
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('portfolio')}}
        <x-jet-button class="float-right"><a href="{{ route('stock') }}" >{{__('Add Transaction')}}</a></x-jet-button>
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Current Holdings') }}
            </h2>
            <br>
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No.</th>
                    <th wire:click="sort('company_name')"
                        class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500  tracking-wider font-bold">Company Name<span>
                                @if($sortColumn === 'company_name')
                                <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                            </span></th>
                    <th wire:click="sort('stock_ticker')"
                        class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500 tracking-wider font-bold">Stock Ticker<span>
                                @if($sortColumn === 'stock_ticker')
                                <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                            </span></th>
                    <th wire:click="sort('current_share_price')"
                        class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem] text-left font-medium text-gray-500 tracking-wider font-bold">Current Price of Stock<span>
                                @if($sortColumn === 'current_share_price')
                                <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                            </span></th>
                    <th class="px-4 py-2">Total  % Change</th>
                    <th class="px-4 py-2">Total  $ Change</th>
                    <th class="px-4 py-2">Tax Treatment</th>
                </tr>
                </thead>
                <tbody>
                @php $i=1; @endphp
                @forelse($currentholding as $curr)
                    @php
                        $diff=date_diff(date_create(\Carbon\Carbon::createFromTimestamp(strtotime($curr->date_of_purchase))->format('Y-m-d')),date_create(date('Y-m-d')));
                    @endphp
                    <tr>
                        <td class="border px-4 py-2">{{ $i++ }}</td>
                        <td class="border px-4 py-2">{{ $curr->company_name }}</td>
                        <td class="border px-4 py-2">{{ $curr->stock_ticker }}</td>
                        <td class="border px-4 py-2">{{ $curr->current_share_price }}</td>
                        <td class="border px-4 py-2">({{ abs($curr->current_share_price/$curr->ave_cost-1) }}%)</td>
                        <td class="border px-4 py-2">(${{ abs(($curr->current_share_price-$curr->ave_cost)*$curr->share_number) }}%)</td>
                        <td class="border px-4 py-2">{{$diff->format("%a")>366?"Long":"Short"}}</td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Historical Trades') }}
            </h2>
            <br>
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No.</th>
                    <th class="px-4 py-2">Trade</th>
                    <th class="px-4 py-2">Summary</th>
                    <th class="px-4 py-2">Ticker</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Proceeds</th>
                </tr>
                </thead>
                <tbody>
                @php $i=1; @endphp
                @foreach($tradesdata as $trad)

                    <tr>
                        <td class="border px-4 py-2">{{ $i++ }}</td>
                        <td class="border px-4 py-2">{{ $trad->type==0?'Buy':'Sell' }}</td>
                        <td class="border px-4 py-2">{{ $trad->type==0?'Bought '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.$trad->date_of_transaction.' for $'.number_format($trad->share_price).' per share':'Sold '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.$trad->date_of_transaction.' for $'.number_format($trad->share_price).' per share' }}</td>
                        <td class="border px-4 py-2">{{ $trad->stock_ticker }}</td>
                        <td class="border px-4 py-2">{{ $trad->date_of_transaction }}</td>
                        <td class="border px-4 py-2 {{$trad->type==0?'text-red-600':'text-green-600'}}">{{ $trad->type==0?'($'.number_format($trad->stock*$trad->share_price).')':'($'.number_format($trad->stock*$trad->share_price).')' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-5 mt-3">
{{--                {{ $tradesdata->links() }}--}}
            </div>
        </div>
    </div>
</div>


















