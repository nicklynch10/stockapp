
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Portfolio')}}
    </h2>
</x-slot>

<main class="p-0 m-0 flex-grow ">
    <style>
        @media screen and (max-width: 600px) {
            table tr td{
                display: grid;
                font-size: 12px;
                padding: 6px 12px !important;
            }
            table thead{
                display: none;
            }
            table td{
                text-align: left !important;
            }
            table tr{
                display: flex !important;
                flex-direction: column !important;
                border: 2px solid #00000073 !important;
                border-radius: 11px !important;
                margin-bottom: 3px !important;
                background-color: #ffffff !important;
            }
            table td:last-child{
                border-bottom: 0;
            }
            table, thead, tbody, th, td, tr {
                display: block;
                font-size: 12px;
                text-align: left !important;
            }
            table td::before{
                content: attr(data-label);
                float: left;
                font-weight: bold;
                width: 15px;
                color: #000000;
            }
            table td::before{
                content: attr(data-label);
                float: left;
                font-weight: bold;
                width: 15px;
            }
            table tr .lastcoloumn:last-child{
                display: block !important;
            }

            .historical tr{
                display: flex !important;
                flex-wrap: wrap;
                flex-direction: row !important;
            }
            .historical td:nth-child(5) { order: 1; background: #00c80696;border-radius: 7px 7px 0px 0px;width: 100% !important;}
            .historical td:nth-child(1) { order: 2; width: 100% !important;}
            .historical td:nth-child(2) { order: 3; width: 100% !important;}
            .historical td:nth-child(3) { order: 4; width: 100% !important;}
            .historical td:nth-child(4) { order: 5; width: 100% !important;}
            .historical td:nth-child(6) { order: 6; width: 50% !important;}
            .historical td:nth-child(7) { order: 7; width: 50% !important;}
        }
    </style>
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{!! session('message') !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <x-jet-button wire:click="create()" class="py-2 px-4 my-3" id="add">{{__('Buy New Stock') }}</x-jet-button>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        <table>
                            <thead class="bg-gray-300">
                                <tr>
                                    <th class="px-6 py-4">Ticker</th>
                                    <th class="px-6 py-4">Company Name</th>
                                    <th class="px-6 py-4">Cost Basis </th>
                                    <th class="px-6 py-4">Number of Shares</th>
                                    <th class="px-6 py-4">Issue Type</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($stocks as $stock)
                                    @if($stock->share_number!=0)
                                        @php
                                            $companyname=explode('-',$stock->security_name)
                                        @endphp
                                        <tr>
                                            <td data-label="Ticker" class="px-6 py-2 whitespace-nowrap text-gray-900"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $stock->id }})">{{ $stock->stock_ticker }}</a></td>
                                            <td data-label="Company Name" class="px-6 py-2 whitespace-nowrap text-gray-900"><a class="cursor-pointer whitespace-normal" wire:click="company({{ $stock->id }})">{{$stock->issuetype=="ETF"?isset($companyname[1])? isset($companyname[2])?$companyname[1]."-".$companyname[2]:$companyname[1]:$companyname[1]:$stock->company_name}}</a></td>
                                            <td data-label="Cost Basis" class="px-6 py-2 whitespace-nowrap text-center text-gray-900">${{ number_format($stock->ave_cost,2) }}</td>
                                            <td data-label="Number of Shares" class="px-6 py-2 whitespace-nowrap text-center text-gray-900">{{ $stock->share_number }}</td>
                                            <td data-label="Issue Type" class="px-6 py-2 whitespace-nowrap text-center text-gray-900"> {{$stock->issuetype}} </td>
                                            <td data-label="Date" class="px-6 py-2 whitespace-nowrap text-center text-gray-900">{{ \Carbon\Carbon::createFromTimestamp(strtotime($stock->date_of_purchase))->format('F jS, Y')}}</td>
                                            <td data-label="" class="px-6 py-2 whitespace-nowrap text-center text-gray-900 lastcoloumn">
                                                <x-jet-button wire:click="sell({{ $stock->id }})" class="py-2 px-4">{{__('Sell')}}</x-jet-button>
                                                <x-jet-button wire:click="buy({{ $stock->id }})" class="py-2 px-4">{{__('Buy')}}</x-jet-button>
                                                <a class="tooltip py-2 px-4" title="Edit Stock" wire:click="edit({{ $stock->id }})"><i class="fa fa-edit cursor-pointer"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td class="border px-4 py-2 text-center" colspan="7"><b>No Stock Found</b></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                        @if($hasMorePages)
                            <div
                                x-data="{
                                    observe () {
                                        let observer = new IntersectionObserver((entries) => {
                                            entries.forEach(entry => {
                                                if (entry.isIntersecting) {
                                                    @this.call('loadMore')
                                                }
                                            })
                                        }, {
                                            root: null
                                        })

                                        observer.observe(this.$el)
                                    }
                                }"
                                    x-init="observe"
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-4"
                                >
                            </div>
                        @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Historical Trades') }}
                        </h2>
                    </div>
                    @livewire('historical-trades')
                </div>
            </div>
        </div>
    </div>


    {{--  Company Detail  --}}
    <x-jet-dialog-modal wire:model="isCompanyOpen">
        <x-slot name="title">
            {{ __('Compnay Detail') }}
            <button wire:click="edit({{$this->stock_id}})" class="float-right"><i class="fa fa-edit"></i></button>
        </x-slot>


        <x-slot name="content">

            <!-- Role -->
            <div class="col-span-6 lg:col-span-4">
                <div class="mb-4">
                    <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Stock Ticker:</b></label>
                    <label>{{$this->stock_ticker}}</label>
                </div>
                <div class="mb-4">
                    <label for="companyname" class="block text-gray-700 font-bold mb-2"><b>Company Name:</b></label>
                    <label>{{$this->company_name}}</label>
                </div>
                @if($this->description)
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2"><b>Description:</b></label>
                        <label>{{$this->description}}</label>
                    </div>
                @endif
                @if($this->issuetype)
                    <div class="mb-4">
                        <label for="issuetype" class="block text-gray-700 font-bold mb-2"><b>Issue Type:</b></label>
                        <label>{{$this->issuetype}}</label>
                    </div>
                @endif
                @if($this->sector)
                    <div class="mb-4">
                        <label for="sector" class="block text-gray-700 font-bold mb-2"><b>Sector:</b></label>
                        <label>{{$this->sector}}</label>
                    </div>
                @endif
                @if($this->market_cap)
                    <div class="mb-4">
                        <label for="marketcap" class="block text-gray-700 font-bold mb-2"><b>Market cap:</b></label>
                        <label>{{$this->market_cap}}</label>
                    </div>
                @endif
                @if($this->alltags)
                    <div class="mb-4">
                        <label for="tage" class="block text-gray-700 font-bold mb-2"><b>Tags:</b></label>
                        @if(isset($this->alltags))
                            @foreach($this->alltags as $t)
                                <label>{{$t}}</label><br>
                            @endforeach
                        @endif
                    </div>
                @endif
                <div class="mb-4">
                    <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Current Share Price:</b></label>
                    <label>${{$this->current_share_price}}</label>
                </div>
                <div class="mb-4">
                    <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Average Purchase Price:</b></label>
                    <label>${{$this->average_cost}}</label>
                </div>
                <div class="mb-4">
                    <label for="stockticker" class="block text-gray-700 font-bold mb-2"><b>Number of Shares:</b></label>
                    <label>{{$this->share_number}}</label>
                </div>
                <x-jet-button wire:click="sell({{ $this->stock_id }})" class="py-2 px-4">{{__('Sell')}}</x-jet-button>
                <x-jet-button wire:click="buy({{ $this->stock_id }})" class="py-2 px-4">{{__('Buy')}}</x-jet-button>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeCompanyModal()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>
    {{-- End Company detail  --}}


    {{-- Stock Purchase Add  --}}
    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Purchase New Stock') }}
            <button wire:click="closeModal()" class="float-right"><i class="fa fa-close"></i></button>
        </x-slot>

        <x-slot name="content">
            <div>
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                            <p>Step 1</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                            <p>Step 2</p>
                        </div>
                    </div>
                </div>

                <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                    <div class="col-xs-12 pt-6">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Search By Company Name Or Ticker:</b></label>
                                <input type="text" id="tickerorcompany" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Ticker Or Company Name" wire:model="tickerorcompany">
                                <input type="text" id="company_name" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Company Name" wire:model="{{$this->company_name}}">
                                <input type="text" id="ticker" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Company Name" wire:model="{{$this->stock_ticker}}">
                                @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror
                                <div wire:loading.delay.shortest wire:target="tickerorcompany" wire:loading.class="mt-2">
                                    <div class="select-none text-sm text-indigo-500 flex flex-1 items-center justify-center text-center p-4 flex-1">
                                        <svg class="animate-spin h-6 w-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            @if($this->companyname)
                            <div class="mb-4" style="border-left:5px solid #00c806;padding: 10px">
                                <label class="text-2xl"><b>{{$this->stock_ticker}}</b></label><br>
                                <label>{{$this->company_name}}</label>
                            </div>
                            @endif
                            <div class="mb-4">
                                <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Share Price:</b></label>
                                <input type="text" id="current_share_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Current Share Price" wire:model="current_share_price">
                                @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Purchase Price (per Share):</b></label>
                                <input type="text" id="average_cost" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" @if($this->openmodalval==0) wire:click="$emit('AveModal')" @endif {{$this->avepricereadonly==0?'':'readonly'}}  wire:model="average_cost">
                                @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Number of Shares:</b></label>
                                <input type="text" id="share_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_number">
                                @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="account_type" class="block text-gray-700 text-sm font-bold mb-2"><b>Select Account:</b></label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="account_type">
                                    @foreach($account as $acc)
                                        <option value="{{$acc->id}}">{{$acc->account_type}}</option>
                                    @endforeach
                                </select>
                                @error('account_type') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date of Purchase:</b></label>
                                <input type="date" id="date_of_purchase" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                                @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Security Name:</b></label>
                                <input type="text" id="securityname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Security Name" wire:model="security_name">
                                @error('security_name') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2"><b>Description:</b></label>
                                <textarea id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Description" wire:model="description" rows="5"></textarea>
                                @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Sector:</b></label>
                                <input type="text" id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Sector" wire:model="sector">
                                @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Issue Type:</b></label>
                                <input type="text" id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Issue Type" wire:model="issuetype">
                                <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Issue Type" wire:model="tags">
                                @error('issuetype') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2"><b>Market Cap ($mm):</b></label>
                                <input type="text" id="market_cap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Market Cap" wire:model="market_cap">
                                @error('market_cap') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="share_sold" class="block text-gray-700 text-sm font-bold mb-2"><b>Notes (Optional):</b></label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Notes" wire:model="note">
                                @error('note') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            @if($currentStep == 1)
                <x-jet-secondary-button wire:click="firstStepSubmit()" wire:loading.attr="disabled">
                    {{ __('Next') }}
                </x-jet-secondary-button>

            @elseif($currentStep == 2)
                <x-jet-button class="mr-2 bg-red-600 hover:bg-red-500" wire:click="back(1)" wire:loading.attr="disabled">
                    {{ __('Back') }}
                </x-jet-button>

                <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>

                @if($this->stock_id)
                    <x-jet-button class="ml-2 bg-red-600 hover:bg-red-500" wire:click="deletestock({{$this->stock_id}})" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-jet-button>
                @endif
            @endif
        </x-slot>
    </x-jet-dialog-modal>
    {{--   End Stock Purchase Input  --}}


    {{-- Stock Sell Modal  --}}
    <x-jet-dialog-modal wire:model="issellOpen">
        <x-slot name="title">
            {{ __('Stock Sale') }}
            <button wire:click="closeSellModal()" class="float-right"><i class="fa fa-close"></i></button>
        </x-slot>

        <x-slot name="content">
            <!-- Role -->
            <div class="col-span-6 lg:col-span-4">
                <div class="mb-4">
                    <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2"><b>Stock Ticker:</b></label>
                    <label>{{$this->stock_ticker}}</label>
                    <input type="text" hidden readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                    @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Company Name:</b></label>
                    <label>{{$this->company_name}}</label>
                    <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                    @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Number of Shares:</b></label>
                    <label>{{$this->share_number}}</label>
                </div>
                <div class="mb-4">
                    <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Sale Price (Per Share):</b></label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Sale Price" wire:model="share_price">
                    @error('share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="share_sold" class="block text-gray-700 text-sm font-bold mb-2"><b>Shares Sold:</b></label>
                    <input type="text" id="share_sold" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_sold">
                    @error('share_sold') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date of Sale:</b></label>
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                    @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeSellModal()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="addsell()" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{--   End Stock Sell Modal  --}}


    {{-- Stock Sell Modal  --}}
    <x-jet-dialog-modal wire:model="isbuyOpen">
        <x-slot name="title">
            {{ __('Buy Existing Stock ') }}
            <button wire:click="closeBuyModal()" class="float-right"><i class="fa fa-close"></i></button>
        </x-slot>

        <x-slot name="content">
            <!-- Role -->
            <div class="col-span-6 lg:col-span-4">
                <div class="mb-4">
                    <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2"><b>Stock Ticker:</b></label>
                    <label>{{$this->stock_ticker}}</label>
                    <input type="text" hidden readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                    @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Company Name:</b></label>
                    <label>{{$this->company_name}}</label>
                    <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                    {{--                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                </div>
                <div class="mb-4">
                    <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Security Name:</b></label>
                    <label>{{$this->security_name}}</label>
                    <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="security_name">
                    {{--                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                </div>
                <div class="mb-4">
                    <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Share Price:</b></label>
                    <label>{{$this->current_share_price}}</label>
                    <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Current Share Price" wire:model="current_share_price">
                    @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Cost Per Share:</b></label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" wire:model="average_cost">
                    @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Total Number of Shares:</b></label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_number">
                    @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date of Purchase:</b></label>
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                    @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2"><b>Description:</b></label>
                    <label>{{$this->description}}</label>
                    <textarea hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Description" wire:model="description"></textarea>
                    {{--                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                </div>
                <div class="mb-4">
                    <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Sector:</b></label>
                    <label>{{$this->sector}}</label>
                    <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Sector" wire:model="sector">
                    {{--                            @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                </div>
                <div class="mb-4">
                    <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2"><b>Market Cap ($mm):</b></label>
                    <label>{{$this->market_cap}}</label>
                    <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Market Cap" wire:model="market_cap">
                    {{--                            @error('market_cap') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeBuyModal()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="addbuy()" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{--   End Stock Sell Modal  --}}

    {{-- Delete Stock --}}
    <x-jet-confirmation-modal wire:model="deletestock">
        <x-slot name="title">
            {{ __('Delete Stock') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete stock?') }}
            <br><br>
            <span class="text-red-700">Please note this will remove all transaction history associate with this stock. This cannot be undone.</span>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closedeletestock()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete({{$this->stock_id}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- End Delete Stock --}}

    <x-jet-confirmation-modal wire:model="isAveOpen">
        <x-slot name="title">
            {{ __('Average Purchase Price') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to Change Average Purchase Price?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class="ml-2" wire:click="closeAveModal(1)" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-jet-button>

            <x-jet-danger-button class="ml-2"  wire:click="closeAveNoModal(1)" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</main>
















