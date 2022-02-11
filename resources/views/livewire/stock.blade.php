
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
                    <th class="px-4 py-2">Comapny Name</th>
                    <th class="px-4 py-2">Average Cost</th>
                    <th class="px-4 py-2">Share Number</th>
                    <th class="px-4 py-2">Date of Purchase</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($stocks as $stock)
                    <tr>
                        <td class="border px-4 py-2">{{ $stock->id }}</td>
                        <td class="border px-4 py-2">{{ $stock->stock_ticker }}</td>
                        <td class="border px-4 py-2">{{ $stock->company_name }}</td>
                        <td class="border px-4 py-2">{{ $stock->ave_cost }}</td>
                        <td class="border px-4 py-2">{{ $stock->share_number }}</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::createFromTimestamp(strtotime($stock->date_of_purchase))->format('F dS, Y')}}</td>
                        <td class="border px-4 py-2">
                            <x-jet-button wire:click="sell({{ $stock->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Sell')}}</x-jet-button>
                            <x-jet-button wire:click="buy({{ $stock->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Buy')}}</x-jet-button>
                            <x-jet-button wire:click="edit({{ $stock->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Edit')}}</x-jet-button>
{{--                            <x-jet-button wire:click="delete({{ $stock->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{__('Delete')}}</x-jet-button>--}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="border px-4 py-2" colspan="7"><b>No Stock Found</b></td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{--   Add Stock Purchase Modal    --}}
            @if($isOpen)
                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                            <div class="model-center inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight pt-6">Stock Purchase Input </h3>
                                <form wire:submit.prevent="stock">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="">

                                            <div class="mb-4">
                                                <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2">Stock Ticker :</label>
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
                                            <div class="mb-4">
                                                <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2">Company Name :</label>
                                                <input type="text" id="companyname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                                                @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                                                <textarea id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Description" wire:model="description"></textarea>
                                                @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="sector" class="block text-gray-700 text-sm font-bold mb-2">Sector :</label>
                                                <input type="text" id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Sector" wire:model="sector">
                                                @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2">Market Cap :</label>
                                                <input type="text" id="market_cap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Market Cap" wire:model="market_cap">
                                                @error('market_cap') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2">Current Share Price :</label>
                                                <input type="text" id="current_share_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Current Share Price" wire:model="current_share_price">
                                                @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2">Average Purchase Cost ( * Per Share ):</label>
                                                <input type="text" id="average_cost" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" wire:model="average_cost">
                                                @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2">Total Number Of Share:</label>
                                                <input type="text" id="share_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Share" wire:model="share_number">
                                                @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2">Date Of Purchase :</label>
                                                <input type="date" id="date_of_purchase" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                                                @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        {{--@if($stock_id)
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                              <x-jet-button wire:click="deletestock({{ $this->stock_id }})" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                    {{__('Delete')}}
                                              </x-jet-button>
                                            </span>
                                        @endif--}}

                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                          <x-jet-button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                              {{__('Save')}}

                                          </x-jet-button>

                                        </span>
                                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                              <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                Cancel
                                              </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{--@include('livewire.stock-create')--}}
            @endif
            {{-- End Stock Purchase Modal  --}}


           {{--  Stock Sell Modal   --}}
            @if($issellOpen)
                <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <!-- This element is to trick the browser into centering the modal contents. -->

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="model-center inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight pt-6">Stock Sell Input </h3>
                            <form wire:submit.prevent="stock">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="">
                                        <div class="mb-4">
                                            <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2">Stock Ticker :</label>
                                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                                            @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2">Company Name :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Description" wire:model="description"></textarea>
                                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="sector" class="block text-gray-700 text-sm font-bold mb-2">Sector :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Sector" wire:model="sector">
                                            @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2">Market Cap :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Market Cap" wire:model="market_cap">
                                            @error('market_cap') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2">Current Share Price :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Current Share Price" wire:model="current_share_price">
                                            @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2">Average Purchase Cost ( * Per Share ):</label>
                                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" wire:model="average_cost">
                                            @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2">Average Sale Cost ( * Per Share ):</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Sale Per Share" wire:model="share_price">
                                            @error('share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2">Total Number Of Share:</label>
                                            <input type="text" id="share_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Share" wire:model="share_number">
                                            @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2">Date Of Purchase :</label>
                                            <input type="date" id="date_of_purchase" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                                            @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                      <x-jet-button wire:click.prevent="addsell()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                          {{__('Save')}}

                                      </x-jet-button>

                                    </span>
                                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                          <button wire:click="closeSellModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Cancel
                                          </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--@include('livewire.stock-create')--}}
            @endif
            {{-- End Stock Sell Modal   --}}


            {{--   Add Stock Buy Modal    --}}
            @if($isbuyOpen)
                <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="model-center inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight pt-6">Stock Buy Input </h3>
                            <form wire:submit.prevent="stock">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="">

                                        <div class="mb-4">
                                            <label for="stockticker" class="block text-gray-700 text-sm font-bold mb-2">Stock Ticker :</label>
                                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ticker"  placeholder="Enter Stock Ticker" wire:model="stock_ticker">
                                            @error('stock_ticker') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2">Company Name :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Company Name" wire:model="company_name">
                                            @error('company_name') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Description" wire:model="description"></textarea>
                                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="sector" class="block text-gray-700 text-sm font-bold mb-2">Sector :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Sector" wire:model="sector">
                                            @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2">Market Cap :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Enter Market Cap" wire:model="market_cap">
                                            @error('market_cap') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2">Current Share Price :</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly placeholder="Current Share Price" wire:model="current_share_price">
                                            @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2">Average Buy Cost ( * Per Share ):</label>
                                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" wire:model="average_cost">
                                            @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2">Total Number Of Share:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Share" wire:model="share_number">
                                            @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2">Date Of Purchase :</label>
                                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
                                            @error('date_of_purchase') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                      <x-jet-button wire:click.prevent="addbuy()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                          {{__('Save')}}

                                      </x-jet-button>

                                    </span>
                                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                          <button wire:click="closeBuyModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Cancel
                                          </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--@include('livewire.stock-create')--}}
            @endif
            {{-- End Stock Buy Modal  --}}


            <x-jet-confirmation-modal wire:model="deletestock">
                <x-slot name="title">
                    {{ __('Send Reminder') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you would like to Send a reminder email and notification to everyone invited to the group card') }}
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click=""
                                            wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-jet-secondary-button>

                    <x-jet-danger-button class="ml-2" wire:click="delete()" wire:loading.attr="disabled">
                        {{ __('Send Reminder') }}
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-confirmation-modal>

        </div>
    </div>
</div>












