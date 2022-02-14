
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Stock Purchase
    </h2>
</x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{!! session('message') !!}</p>
                        </div>
                    </div>
                </div>
                <br>
            @endif
            <x-jet-button wire:click="create()" class="bg-blue-500 transition hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">{{__('Add New Stock')}}</x-jet-button>
            <br><br>
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No.</th>
                    <th class="px-4 py-2">Stock Ticker</th>
                    <th class="px-4 py-2">Average Cost</th>
                    <th class="px-4 py-2">Number of Shares</th>
                    <th class="px-4 py-2">Date of Purchase</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($stocks as $stock)
                    @if($stock->share_number!=0)
                    <tr>
                        <td class="border px-4 py-2">{{ $stock->id }}</td>
                        <td class="border px-4 py-2">{{ $stock->stock_ticker }}</td>
                        <td class="border px-4 py-2">${{ number_format($stock->ave_cost) }}</td>
                        <td class="border px-4 py-2">{{ $stock->share_number }}</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::createFromTimestamp(strtotime($stock->date_of_purchase))->format('F dS, Y')}}</td>
                        <td class="border px-4 py-2">
                            <x-jet-button wire:click="sell({{ $stock->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Stock Sale')}}</x-jet-button>
                            <x-jet-button wire:click="buy({{ $stock->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Stock Buy')}}</x-jet-button>
                            <x-jet-button wire:click="edit({{ $stock->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Edit')}}</x-jet-button>
                        </td>
                    </tr>
                    @endif
                @empty
                    <tr>
                        <td class="border px-4 py-2" colspan="7"><b>No Stock Found</b></td>
                    </tr>
                @endforelse
                </tbody>
            </table>

           {{-- Stock Purchase Add  --}}
            <x-jet-dialog-modal wire:model="isOpen">
                <x-slot name="title">
                    {{ __('Stock Purchase Input') }}
                    <button wire:click="closeModal()" class="float-right"><i class="fa fa-close"></i></button>
                </x-slot>

                <x-slot name="content">
                    <!-- Role -->
                        <div class="col-span-6 lg:col-span-4">
                            <div class="mb-4">
                                <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2"><b>Stock Ticker :</b></label>
                                <input type="text" id="stockticker" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                                @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div wire:loading.delay wire:target="stock_ticker" wire:loading.class="mt-2 w-40 h-40">
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
                            @if($this->company_name!='')
                            <div class="mb-4">
                                <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Company Name :</b></label>
                                <label>{{$this->company_name}}</label>
                                <input type="text" hidden id="companyname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2"><b>Description :</b></label>
                                <label>{{$this->description}}</label>
                                <textarea id="description" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Description" wire:model="description"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Sector :</b></label>
                                <label>{{$this->sector}}</label>
                                <input type="text" hidden id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Sector" wire:model="sector">
                            </div>
                            <div class="mb-4">
                                <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2"><b>Market Cap :</b></label>
                                <label>{{$this->market_cap}}</label>
                                <input type="text" hidden id="market_cap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Market Cap" wire:model="market_cap">
                            </div>
                            <div class="mb-4">
                                <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Share Price :</b></label>
                                <label>{{$this->current_share_price}}</label>
                                <input type="text" hidden id="current_share_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Current Share Price" wire:model="current_share_price">
                            </div>
                            @endif
                            <div class="mb-4">
                                <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Purchase Cost ( * Per Share ):</b></label>
                                <input type="text" id="average_cost" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" wire:model="average_cost">
                                @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Total Number of Shares:</b></label>
                                <input type="text" id="share_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_number">
                                @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date Of Purchase :</b></label>
                                <input type="date" id="date_of_purchase" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                                @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="closeModal()">
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
                            <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2"><b>Stock Ticker :</b></label>
                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                            @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Company Name :</b></label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Number of Shares :</b></label>
                            <label>{{$this->share_number}}</label>
                        </div>
                        <div class="mb-4">
                            <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Sale Price (Per Share) :</b></label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Sale Price" wire:model="share_price">
                            @error('share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="share_sold" class="block text-gray-700 text-sm font-bold mb-2"><b>Shares Sold :</b></label>
                            <input type="text" id="share_sold" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_sold">
                            @error('share_sold') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date of Sale :</b></label>
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
                    {{ __('Stock Buy Input ') }}
                    <button wire:click="closeBuyModal()" class="float-right"><i class="fa fa-close"></i></button>
                </x-slot>

                <x-slot name="content">
                    <!-- Role -->
                    <div class="col-span-6 lg:col-span-4">
                        <div class="mb-4">
                            <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2"><b>Stock Ticker :</b></label>
                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                            @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Company Name :</b></label>
                            <label>{{$this->company_name}}</label>
{{--                            <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">--}}
{{--                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2"><b>Description :</b></label>
                            <label>{{$this->description}}</label>
{{--                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Description" wire:model="description"></textarea>--}}
{{--                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                        </div>
                        <div class="mb-4">
                            <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Sector :</b></label>
                            <label>{{$this->sector}}</label>
{{--                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Sector" wire:model="sector">--}}
{{--                            @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                        </div>
                        <div class="mb-4">
                            <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2"><b>Market Cap :</b></label>
                            <label>{{$this->market_cap}}</label>
{{--                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Market Cap" wire:model="market_cap">--}}
{{--                            @error('market_cap') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                        </div>
                        <div class="mb-4">
                            <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Share Price :</b></label>
                            <label>{{$this->current_share_price}}</label>
{{--                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Current Share Price" wire:model="current_share_price">--}}
{{--                            @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror--}}
                        </div>
                        <div class="mb-4">
                            <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Buy Cost ( * Per Share ):</b></label>
                            <label>{{$this->average_cost}}</label>
                            <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" wire:model="average_cost">
                            @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Total Number of Shares:</b></label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_number">
                            @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date Of Purchase :</b></label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                            @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
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
                        {{ __('Are you sure you want to delete stock ?') }}
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
        </div>
    </div>
    <script>
        $('#click').click(function(){
            console.log('hhh');
        });
    </script>
</div>












