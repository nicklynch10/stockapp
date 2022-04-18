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
<div class="grid grid-cols-8 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-8 lg:grid-cols-8 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">
    @forelse($currentholding as $curr)
        @php
            $companyname=explode('-',$curr->security_name)
        @endphp
        @if($curr->share_number!=0)
            <div class="m-2">
                <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                    <div class="mt-3 my-1">
                        <div class="flex justify-center">
                            <img src="{{ $curr->ticker_logo }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16">
                        </div>
                        <div class="text-center mt-1">
                            <a class="cursor-pointer text-black font-black hover:bg-gray-100 text-xl" >
                                {{ $curr->stock_ticker }}
                            </a>
                            <p class="pb-2 text-sm font-sans font-light text-grey-dark italic sm:text-xs">
                                {{ $curr->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$curr->company_name }}
                            </p>
                            <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                                {{ $curr->share_number }} Shares
                            </p>
                            <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                                Cost Basis : ${{ number_format($curr->ave_cost,2) }}
                            </p>
                            <p class="pb-2 text-sm font-sans font-light text-grey-dark">
                                Share Price : ${{ number_format($curr->ave_cost,2) }}
                            </p>
                        </div>
                    </div>
                    <div class="text-center text-sm mt-3 border-gray-200 border-t -my-2 p-2 text-gray-600">
                        <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                            $ Change : {{ $curr->dchange<0?"($".number_format(abs($curr->dchange),2).")":"$".number_format(abs($curr->dchange),2) }}
                        </p>
                        <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                            $ Change : {{ $curr->pchange<0?"(".number_format(abs($curr->pchange),2)."%)":number_format(abs($curr->pchange),2)."%" }}
                        </p>
                        <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                            Market Value : {{ $curr->current_total_value<0?"($".number_format(abs($curr->current_total_value),2).")":"$".number_format(abs($curr->current_total_value),2) }}
                        </p>
                        <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                            Total Cost : {{$curr->total_cost<0?"($".number_format(abs($curr->total_cost),2).")":"$".number_format(abs($curr->total_cost),2)}}
                        </p>
                        <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                            Total Gain / (Loss) : {{$curr->total_gain_loss<0?"($".number_format(abs($curr->total_gain_loss),2).")":"$".number_format(abs($curr->total_gain_loss),2)}}
                        </p>
                        <p class="pb-1 text-sm font-sans font-light text-grey-dark">
                            Tax Classification : {{$curr->total_long_term_gains}}
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @empty
    @endforelse
</div>

