
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Accounts
    </h2>
</x-slot>

<main class="p-0 m-0 flex-grow ">
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col bg-white shadow-xl sm:rounded-lg px-4 py-4">
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
                    <x-jet-button wire:click="create()" class="py-2 px-4 my-3" id="add">{{__('Add New Account') }}</x-jet-button>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        <table>
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 w-20">No.</th>
                                <th class="px-6 py-4">Account Type</th>
                                <th class="px-6 py-4">Account Name</th>
                                <th class="px-6 py-4">Account Brokerage</th>
                                <th class="px-6 py-4">Commission</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $i=1;
                                @endphp
                                @forelse($this->account as $acc)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$i++}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$acc->account_type}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$acc->account_name}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{$acc->account_brokerage}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">${{$acc->commission}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ \Carbon\Carbon::createFromTimestamp(strtotime($acc->created_at))->format('F dS, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">
                                            <x-jet-button wire:click="edit({{ $acc->id }})" class="py-2 px-4">{{__('Edit')}}</x-jet-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th class="px-6 py-4 whitespace-nowrap text-center text-gray-900" colspan="6">No Account Found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('New Account') }}
            <button wire:click="closeModal()" class="float-right"><i class="fa fa-close"></i></button>
        </x-slot>

        <x-slot name="content">
            <!-- Role -->
            <div class="col-span-6 lg:col-span-4">
                <div class="mb-4">
                    <label for="account_type" class="block text-gray-700 text-sm font-bold mb-2"><b>Account Type :</b></label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="account_type">
                        <option>Select Account</option>
                        <option value="Individual Brokerage Account" selected>Individual Brokerage Account</option>
                        <option value="Joint Brokerage Account">Joint Brokerage Account</option>
                        <option value="Roth IRA">Roth IRA</option>
                        <option value="Traditional IRA">Traditional IRA</option>
                        <option value="401K">401K</option>
                        <option value="Sep IRA">Sep IRA</option>
                        <option value="Health Savings Account">Health Savings Account</option>
                        <option value="529 Account">529 Account</option>
                        <option value="Trust">Trust</option>
                        <option value="Other Taxable Account">Other Taxable Account</option>
                        <option value="Other Non-Taxable Account">Other Non-Taxable Account</option>
                    </select>
                    @error('account_type') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="account_name" class="block text-gray-700 text-sm font-bold mb-2"><b>Account Name :</b></label>
                    <input type="text" id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account Name" wire:model="account_name">
                    @error('account_name') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="account_brokerage" class="block text-gray-700 text-sm font-bold mb-2"><b>Account Brokerage :</b></label>
                    <input type="text" id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account Brokerage" wire:model="account_brokerage">
                    @error('account_brokerage') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="commission" class="block text-gray-700 text-sm font-bold mb-2"><b>Commission :</b></label>
                    <input type="text" id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Commission" wire:model="commission">
                    @error('commission') <span class="text-red-500">{{ $message }}</span>@enderror
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

        </x-slot>
    </x-jet-dialog-modal>


</main>
















