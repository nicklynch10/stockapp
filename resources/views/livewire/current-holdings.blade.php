{{--<div class="overview shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">--}}
{{--    <table>--}}
{{--        <thead class="bg-gray-300 xs:hidden">--}}
{{--        <tr class="xs:bg-white xs:flex xs:flex-col xs:border-2-solid-black xs:mb-2 xs:border-r-11">--}}
{{--            <th wire:click="sort('stock_ticker')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Stock Ticker<span>--}}
{{--                @if($sortColumn === 'stock_ticker')--}}
{{--                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                @else--}}
{{--                    <i class="fas fa-sort"></i>--}}
{{--                @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('stock_ticker')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Company name<span>--}}
{{--                @if($sortColumn === 'company_name')--}}
{{--                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                    @else--}}
{{--                        <i class="fas fa-sort"></i>--}}
{{--                    @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('share_number')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Share Count<span>--}}
{{--                @if($sortColumn === 'share_number')--}}
{{--                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                @else--}}
{{--                    <i class="fas fa-sort"></i>--}}
{{--                @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('ave_cost')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Cost Basis<span>--}}
{{--                @if($sortColumn === 'ave_cost')--}}
{{--                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                @else--}}
{{--                    <i class="fas fa-sort"></i>--}}
{{--                @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('current_share_price')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Share Price<span>--}}
{{--                @if($sortColumn === 'current_share_price')--}}
{{--                    <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                @else--}}
{{--                    <i class="fas fa-sort"></i>--}}
{{--                @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('dchange')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> $ Change<span>--}}
{{--                @if($sortColumn === 'dchange')--}}
{{--                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                    @else--}}
{{--                        <i class="fas fa-sort"></i>--}}
{{--                    @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('pchange')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> % Change<span>--}}
{{--                @if($sortColumn === 'pchange')--}}
{{--                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                    @else--}}
{{--                        <i class="fas fa-sort"></i>--}}
{{--                    @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('current_total_value')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> Market Value<span>--}}
{{--                @if($sortColumn === 'current_total_value')--}}
{{--                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                    @else--}}
{{--                        <i class="fas fa-sort"></i>--}}
{{--                    @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('total_cost')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]"> Total Cost<span>--}}
{{--                @if($sortColumn === 'total_cost')--}}
{{--                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                    @else--}}
{{--                        <i class="fas fa-sort"></i>--}}
{{--                    @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('total_gain_loss')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Total Gain / (Loss)<span>--}}
{{--                @if($sortColumn === 'total_gain_loss')--}}
{{--                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                    @else--}}
{{--                        <i class="fas fa-sort"></i>--}}
{{--                    @endif--}}
{{--        </span></th>--}}
{{--            <th wire:click="sort('total_long_term_gains')"--}}
{{--                class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Tax Classification<span>--}}
{{--                @if($sortColumn === 'total_long_term_gains')--}}
{{--                        <i class="fa {{$sortDirection === 'asc' ? 'fa-chevron-up' : 'fa-chevron-down'}}"></i>--}}
{{--                    @else--}}
{{--                        <i class="fas fa-sort"></i>--}}
{{--                    @endif--}}
{{--        </span></th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody class="bg-white divide-y divide-gray-200">--}}
{{--        @forelse($currentholding as $curr)--}}
{{--            @php--}}
{{--                $companyname=explode('-',$curr->security_name)--}}
{{--            @endphp--}}
{{--            @if($curr->share_number!=0)--}}
{{--            <tr class="xs:bg-white xs:flex xs:flex-col xs:border-2-solid-black xs:mb-2 xs:border-r-11">--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Stock Ticker"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $curr->id }})">{{$curr->stock_ticker}}</a></td>--}}
{{--                <td class="px-6 py-4 text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Stock Ticker"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $curr->id }})"><p class="whitespace-normal">{{$curr->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$curr->company_name}}</p></a></td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Share Count">{{$curr->share_number}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Cost Basis">${{number_format($curr->ave_cost,2)}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Share Price">${{number_format($curr->current_share_price,2)}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="$ Change">{{$curr->dchange<0?"($".number_format(abs($curr->dchange),2).")":"$".number_format(abs($curr->dchange),2)}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="% Change">{{$curr->pchange<0?"(".number_format(abs($curr->pchange),2)."%)":number_format(abs($curr->pchange),2)."%"}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Market Value">{{$curr->current_total_value<0?"($".number_format(abs($curr->current_total_value),2).")":"$".number_format(abs($curr->current_total_value),2)}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Total Cost">{{$curr->total_cost<0?"($".number_format(abs($curr->total_cost),2).")":"$".number_format(abs($curr->total_cost),2)}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center xs:text-right xs:block xs:text-xs xs:py-10 {{$curr->total_gain_loss<0?"text-red-600":"text-green-600"}}" data-label="Total Gain / (Loss)">{{$curr->total_gain_loss<0?"($".number_format(abs($curr->total_gain_loss),2).")":"$".number_format(abs($curr->total_gain_loss),2)}}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs xs:py-10" data-label="Tax Classification">{{$curr->total_long_term_gains}}</td>--}}
{{--            </tr>--}}
{{--            @endif--}}
{{--        @empty--}}
{{--            <tr>--}}
{{--                <th class="text-center px-6 py-4" colspan="11">Nothing's here yet! Add your holdings to continue.</th>--}}
{{--            </tr>--}}
{{--        @endforelse--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    @if(count($currentholding->links()['elements'][0])>1)--}}
{{--        <div class="p-5">--}}
{{--            {{$currentholding->links()}}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    @livewire('company-detail-modal')--}}
{{--</div>--}}
<div>
    <div class="flex justify-between items-center w-full border-b-2 border-gray-300">
        <h2 class="text-xl font-black">Current Holdings</h2>
        <select wire:change="sort($event.target.value)" class="shadow appearance-none border mb-3 w-60 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option>Sort By</option>
            <option value="stock_ticker">Stock Ticker</option>
            <option value="company_name">company_name</option>
            <option value="share_number">share_number</option>
            <option value="ave_cost">Cost Basis</option>
            <option value="current_share_price">Share Price</option>
            <option value="dchange">$ Change</option>
            <option value="pchange">% Change</option>
            <option value="current_total_value">Market Value</option>
            <option value="total_cost">Total Cost</option>
            <option value="total_gain_loss">Total Gain / (Loss)</option>
            <option value="total_long_term_gains">Tax Classification</option>
        </select>
    </div>
    <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">
        @forelse($currentholding as $curr)
            @php
                $companyname=explode('-',$curr->security_name)
            @endphp
            @if($curr->share_number!=0)
                <div class="m-2">
                    <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                        <div class="mt-3 my-1">
                            <div class="flex flex-row items-center xs:flex-col md:flex-col lg:flex-row">
                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><img src="{{ $curr->ticker_logo }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16"></h5>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $curr->id }})">{{ $curr->stock_ticker }}</a></h5>
                                    <p class="mb-1 text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">{{ $curr->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$curr->company_name }}</p>
                                    <p class="mb-1 text-sm font-sans font-light text-grey-dark">{{ $curr->share_number }} Shares</p>
                                    <p class="mb-1 text-sm font-sans font-light text-grey-dark">Cost Basis : ${{ number_format($curr->ave_cost,2) }}</p>
                                    <p class="mb-1 text-sm font-sans font-light text-grey-dark">Share Price : ${{ number_format($curr->current_share_price,2) }}</p>
                                </div>
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <li class="py-1 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                            $ Change
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-sm">
                                                        {{ $curr->dchange<0?"($".number_format(abs($curr->dchange),2).")":"$".number_format(abs($curr->dchange),2) }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-1 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                            % Change
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-sm">
                                                        {{ $curr->pchange<0?"(".number_format(abs($curr->pchange),2)."%)":number_format(abs($curr->pchange),2)."%" }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-1 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                            Market Value
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-sm">
                                                        {{ $curr->current_total_value<0?"($".number_format(abs($curr->current_total_value),2).")":"$".number_format(abs($curr->current_total_value),2) }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-1 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                            Total Cost
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-sm">
                                                        {{ $curr->total_cost<0?"($".number_format(abs($curr->total_cost),2).")":"$".number_format(abs($curr->total_cost),2) }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-1 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                            Total Gain / (Loss)
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-sm">
                                                        {{ $curr->total_gain_loss<0?"($".number_format(abs($curr->total_gain_loss),2).")":"$".number_format(abs($curr->total_gain_loss),2) }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-1 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1">
                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                            Tax Classification
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-sm text-right">
                                                        {{ $curr->total_long_term_gains }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <h4>NO Current Holdings Found</h4>
        @endforelse
        @livewire('company-detail-modal')
    </div>
</div>


