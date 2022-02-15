
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('portfolio')}}
        <x-jet-button class="float-right"><a href="{{ route('stock') }}" >{{__('Add Transaction')}}</a></x-jet-button>
    </h2>
</x-slot>

<main class="p-0 m-0 flex-grow ">
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col bg-white shadow-xl sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Current Holdings') }}
                        </h2>
                    </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        <table>
                            <thead class="bg-gray-100">
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
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $price['companyName'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $curr->stock_ticker }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $price['latestPrice'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">({{ abs(($price['latestPrice']/$curr->ave_cost)-1) }}%)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">(${{ abs(($price['latestPrice']-$curr->ave_cost)*$curr->share_number) }}%)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$diff->format("%a")>366?"Long":"Short"}}</td>
                                </tr>
                            @empty
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
                            {{ __('Historical Trades') }}
                        </h2>
                    </div>
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
                            @foreach($tradesdata as $trad)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $i++ }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->type==0?'Buy':'Sell' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->type==0?'Bought '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.$trad->date_of_transaction.' for $'.number_format($trad->share_price).' per share':'Sold '.$trad->stock.' shares of '.$trad->stock_ticker.' on '.$trad->date_of_transaction.' for $'.number_format($trad->share_price).' per share' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->stock_ticker }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ $trad->date_of_transaction }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center {{$trad->type==0?'text-red-600':'text-green-600'}}">{{ $trad->type==0?'($'.number_format($trad->stock*$trad->share_price).')':'($'.number_format($trad->stock*$trad->share_price).')' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


















