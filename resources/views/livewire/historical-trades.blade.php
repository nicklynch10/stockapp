<div class="grid grid-cols-12 w-full my-5 py-3 rounded">
    <div class="col-span-12 grid grid-cols-12 sm:grid border bg-gray-50 xs:hidden">
        <div class="col-start-1 sm:col-start-1 col-span-1 text-left sm:text-xs md:text-xs lg:text-sm font-semibold m-2 pl-1">
            Date
        </div>

        <div class="col-start-2 sm:col-start-2 col-span-1 sm:text-xs font-semibold md:text-xs lg:text-sm text-center m-2">
            Trade
        </div>

        <div class="col-start-3 sm:col-start-3 col-span-2 sm:col-span-2 sm:text-xs md:text-xs text-center lg:text-sm font-semibold m-2">
            Ticker
        </div>

        <div class="col-start-5 sm:col-start-5 col-span-3 sm:col-span-2 sm:text-xs md:text-xs text-center lg:text-sm font-semibold m-2">
            Company Name
        </div>

        <div class="col-start-8 sm:col-start-7 col-span-3 sm:col-span-2 sm:text-xs md:text-xs text-center lg:text-sm font-semibold m-2">
            Summary
        </div>
        <div class="col-start-11 sm:col-start-9 col-span-1 sm:col-span-2 sm:text-xs md:text-xs text-center lg:text-sm font-semibold m-2">
            Taxable Gain / (Loss)
        </div>
        <div class="col-start-12 sm:col-start-11 col-span-1 sm:col-span-2 sm:text-xs md:text-xs text-center lg:text-sm font-semibold m-2">
            Transaction Proceeds (Cost)
        </div>
        <div class="col-start-1 col-span-12 border-b border-gray-500 mb-1"></div>
            @forelse($tradesdata as $trad)
                @php
                    $stock = $trad->stock()->first();
                    $taxable=($trad->share_price-$trad->ave_cost)*($trad->stock);
                    $companyname=explode('-',$trad->security_name)
                @endphp
                <div class="col-start-1 sm:col-start-1 col-span-1 mx-1 text-left text-sm pl-1 py-1">
                    {{\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y') }}
                </div>

                <div class="col-start-2 sm:col-start-2 col-span-1 mx-1 text-sm text-center py-1 truncate">
                    {{ $trad->type == 0 ?'Buy':'Sell' }}
                </div>

                <div class="col-start-3 sm:col-start-3 col-span-2 sm:col-span-2 mx-1 text-sm text-center py-1 break-words">
                    <a class="cursor-pointer whitespace-normal text-blue-600" wire:click="company({{ $stock->id }})">
                        {{ strtoupper($stock->stock_ticker) }}
                    </a>
                </div>

                <div class="col-start-5 sm:col-start-5 col-span-3 sm:col-span-2 mx-1 text-sm text-center py-1 break-words">
                    <a class="cursor-pointer whitespace-normal" wire:click="company({{ $stock->id }})">
                        <p class="whitespace-normal text-blue-600">
                            @if($stock->security_name != null && convertType($stock->issuetype) == "ETF")
                                {{ isset($companyname[1]) ? $companyname[1] : $companyname[0] }}
                            @else
                                {{ $stock->company_name }}
                            @endif
                        </p>
                    </a>
                </div>

                <div class="col-start-8 sm:col-start-7 col-span-3 sm:col-span-2  mx-1 text-sm text-center  py-1 break-words" >
                    <p class="whitespace-normal">{!! $trad->type == 0 ?
                        'Purchased '.number_format(round($trad->stock, 2)).' '.($trad->stock == 1 ? "Share" : "Shares" ).' of '.strtoupper($stock->stock_ticker).' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share':
                        'Sold '.number_format(round($trad->stock, 2)).' '.($trad->stock == 1 ? "Share" : "Shares" ).' of '.strtoupper($stock->stock_ticker).' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share'  !!}</p>
                </div>

                <div class="col-start-11 sm:col-start-9 col-span-1 sm:col-span-2 mx-1 text-sm text-center  py-1">
                    <p class="@if($taxable < 0) text-red-600 @else text-green-600 @endif">{{$trad->type==1?$taxable<0?"($".number_format(abs($taxable),2).")":"$".number_format($taxable,2):'-'}}</p>
                </div>

                <div class="col-start-12 sm:col-start-11 col-span-1 sm:col-span-2 mx-1 text-sm text-center py-1">
                    <p class="@if($trad->type == 0) text-red-600 @else text-green-600 @endif">{{ $trad->type==0?'($'.number_format(abs($trad->stock*$trad->share_price),2).")":'$'.number_format(abs($trad->stock*$trad->share_price),2) }}</p>

                </div>
                <div class="col-start-1 col-span-12 border-b border-gray-300 mb-1"></div>
            @empty
                <div class="col-start-1 col-span-12 border-b border-gray-300 text-gray-500 border-dashed mb-1">
                    No Stock Found
                </div>
            @endforelse
        <div class="col-start-1 col-span-12 my-6">
            @if(count($tradesdata->links()['elements'][0])>1)
                <div class="p-5">
                    {{$tradesdata->links()}}
                </div>
            @endif
        </div>
        <p class="col-start-1 col-span-12 border-t border-gray-400 mt-1"></p>

    </div>

    <div class="col-span-12 block xl:hidden lg:hidden md:hidden sm:hidden overflow-auto">
        @forelse($tradesdata as $trad)
            @php
                $stock = $trad->stock()->first();
                $taxable=($trad->share_price-$trad->ave_cost)*($trad->stock);
                $companyname=explode('-',$trad->security_name)
            @endphp
            <table class="mb-4" style="">
                <tbody class="flex-1">
                <tr class="border border-gray-400">
                    <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Date</td>
                    <td class="text-left text-sm">{{\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y') }}</td>
                </tr>

                <tr class="border border-gray-400">
                    <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Trade</td>
                    <td class="text-left truncate" style="font-size: 0.750rem;line-height: 1.25rem;">{{ $trad->type==0?'Buy':'Sell' }}</td>
                </tr>

                <tr class="border border-gray-400">
                    <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Ticker</td>
                    <td class="text-blue-600 text-left truncate" style="font-size: 0.750rem;line-height: 1.25rem;">
                        <a class="cursor-pointer whitespace-normal" wire:click="company({{ $stock->id }})">{{ $stock->stock_ticker }}</a>
                    </td>
                </tr>

                <tr class="border border-gray-400">
                    <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Company Name</td>
                    <td class="text-blue-600 text-left truncate" style="font-size: 0.750rem;line-height: 1.25rem;">
                        <a class="cursor-pointer whitespace-normal" wire:click="company({{ $stock->id }})">
                            <p class="whitespace-normal">
                                @if($stock->security_name != null && convertType($stock->issuetype) == "ETF")
                                    {{ isset($companyname[1]) ? $companyname[1] : $companyname[0] }}
                                @else
                                    {{ $stock->company_name }}
                                @endif
                            </p>
                        </a>
                    </td>
                </tr>

                <tr class="border border-gray-400">
                    <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Summary</td>
                    <td class=" text-left truncate" style="font-size: 0.750rem;line-height: 1.25rem;">
                        <p class="whitespace-normal">{!! $trad->type==0?'Purchased '.round($trad->stock, 2).' '.($trad->stock == 1 ? "Share" : "Shares" ).' of '.$stock->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share':'Sold '.$trad->stock.' shares of '.$stock->stock_ticker.' on '.\Carbon\Carbon::createFromTimestamp(strtotime($trad->date_of_transaction))->format('F jS, Y').' for $'.number_format($trad->share_price,2).' per share'  !!}</p>
                    </td>
                </tr>

                <tr class="border border-gray-400">
                    <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Taxable Gain / (Loss)</td>
                    <td class="text-left truncate" style="font-size: 0.750rem;line-height: 1.25rem;
                        {{$taxable<0? "text-red-600":"text-green-600"}}">{{$trad->type==1?$taxable<0?"($".number_format(abs($taxable),2).")":"$".number_format($taxable,2):'-'}}
                    </td>
                </tr>
                <tr class="border border-gray-400">
                    <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Transaction Proceeds (Cost)</td>
                    <td class="text-left truncate" style="font-size: 0.750rem;line-height: 1.25rem;
                        {{$trad->type==0?'text-red-600':'text-green-600'}}">{{ $trad->type==0?'($'.number_format($trad->stock*$trad->share_price,2).")":'$'.number_format($trad->stock*$trad->share_price,2) }}
                    </td>
                </tr>
                </tbody>
            </table>
        @empty
            <tr>
                <th class="text-center px-6 py-4" colspan="8"><i class="fa fa-chart-line"></i>No Stock Found</th>
            </tr>
        @endforelse
    </div>
</div>
