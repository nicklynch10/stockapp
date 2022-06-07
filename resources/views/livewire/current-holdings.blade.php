<div>
    <div class="flex justify-between items-center w-full border-b-2 border-gray-300">
        <h2 class="text-xl font-black">Current Holdings</h2>
        <select wire:change="sort($event.target.value)" class="shadow appearance-none border mb-3 w-60 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="0">Sort By</option>
            <option value="stock_ticker">Stock Ticker</option>
            <option value="company_name">Company Name</option>
            <option value="share_number">Share Number</option>
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
    <div class="grid grid-cols-3 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-3 xl:grid-cols-3 lg:grid-cols-3 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">
        @forelse($currentholding as $curr)
            @php
                $companyname=explode('-',$curr->security_name)
            @endphp
            @if($curr->share_number!=0)
                <div class="m-2">
                    <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                        <div class="mt-3 my-1">
                            <div class="flex flex-row items-center xs:flex-col xl:flex-col md:flex-col">
                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 115px">
                                    <?php
                                    $string = $curr->ticker_logo;
                                    if (strpos($string, "http") === 0) {
                                        $logoUrl = $curr->ticker_logo;
                                    } else {
                                        $logoUrl = 'https://ui-avatars.com/api/?name='.$curr->stock_ticker.'&color=7F9CF5&background=EBF4FF';
                                    }
                                    ?>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16"></h5>
                                </div>
                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                   <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                        <a class=" cursor-pointer whitespace-normal " wire:click="company({{ $curr->id }})">{{ $curr->stock_ticker }}</a>
                                    </h5>
                                    <p class="mb-1 break-words break-all text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">{{ $curr->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$curr->company_name }}</p>
                                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">{{ $curr->share_number }} @if($curr->share_number>1) Shares @else Share @endif</p>
                                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">Cost Basis: ${{ number_format($curr->ave_cost,2) }}</p>
                                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">Share Price: ${{ number_format($curr->current_share_price,2) }}</p>

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
                                                    <div class="inline-flex items-center break-all text-sm">
                                                        <p class="break-all">{{ $curr->dchange<0?"($".number_format(abs($curr->dchange),2).")":"$".number_format(abs($curr->dchange),2) }}</p>
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
                                                    <div class="inline-flex items-center text-sm {{$curr->total_gain_loss<0?"text-red-600":"text-green-600"}}">
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
            <h4>No Current Holdings Found</h4>
        @endforelse
        @livewire('company-detail-modal')
    </div>
</div>


