<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Accounts
    </h2>
</x-slot>

<main class="p-0 m-0 flex-grow ">
    <link rel="stylesheet" href="/css/flowbite.min.css" />

    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
    @if(isset($this->message))
        <input type="text" id="successmsg" value="{{ $this->message }}">
    @endif
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
                    <x-jet-button wire:click="create()" class="py-2 px-4 my-3" id="add">{{__('Add New Account') }}</x-jet-button>
{{--                    <button >Link Your Bank Account</button>--}}
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 py-2 px-4 my-3" id="linkButton">
                        Link accounts using Plaid
                    </button>
                    <div class="account shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        <table>
                            <thead class="bg-gray-300 xs:hidden">
                            <tr class="xs:bg-white xs:flex xs:flex-col xs:border-2-solid-black xs:mb-2 xs:border-r-11">
                                <th class="px-6 py-4">Set as Default</th>
                                <th class="px-6 py-4">Account Name</th>
                                <th class="px-6 py-4">Account Type</th>
                                <th class="px-6 py-4">Account Brokerage</th>
                                <th class="px-6 py-4">Commission Rate per Share</th>
                                <th class="px-6 py-4">Date Created</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($this->account as $acc)
                                <tr class="xs:bg-white xs:flex xs:flex-col xs:border-2-solid-black xs:mb-2 xs:border-r-11">
                                    <td data-label="Set as Default" class="px-6 py-4 whitespace-nowrap text-center text-gray-90 xs:text-right xs:block xs:text-xs"><input type="checkbox" class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" {{$acc->set_default==1?"checked disabled":""}} wire:click="set_default({{$acc->id}})"></td>
                                    <td data-label="Account Name" class="px-6 py-4 whitespace-nowrap text-center text-gray-900 accountnameorder xs:text-right xs:block xs:text-xs">{{$acc->account_name}}</td>
                                    <td data-label="Account Type" class="px-6 py-4 text-center text-gray-900 xs:text-right xs:block xs:text-xs">{{$acc->account_type}}</td>
                                    <td data-label="Account Brokerage" class="px-6 py-4 text-center text-gray-900 xs:text-right xs:block xs:text-xs">{{$acc->account_brokerage}}</td>
                                    <td data-label="Commission Rate per Share" class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs">${{number_format($acc->commission,2)}}</td>
                                    <td data-label="Date Created" class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs">{{ \Carbon\Carbon::createFromTimestamp(strtotime($acc->created_at))->format('F jS, Y') }}</td>
                                    <td data-label="Action" class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-right xs:block xs:text-xs">
                                        <a class="tooltip py-2 px-4" title="Edit Account" wire:click="edit({{ $acc->id }})"><i class="fa fa-edit cursor-pointer"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="xs:bg-white xs:flex xs:flex-col xs:border-2-solid-black">
                                    <th class="px-6 py-4 whitespace-nowrap text-center text-gray-900" colspan="8">No Account Found</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="account"></div>
                </div>
            </div>
        </div>
    </div>


    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            @if($this->account_id!=''){{ __('Edit Account') }} @else {{ __('New Account') }} @endif
            <button wire:click="closeModal()" class="float-right"><i class="fa fa-close"></i></button>

        </x-slot>

        <x-slot name="content">
            <!-- Role -->
            <div class="col-span-6 lg:col-span-4">
                <div class="mb-4">
                    <label for="account_type" class="block text-gray-700 text-sm font-bold mb-2"><b>Account Type :</b></label>
                    <select id ="account_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="account_type">
                        <option>Select Account</option>
                        <option value="Individual Brokerage Account" selected="selected">Individual Brokerage Account</option>
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
                    <label for="commission" class="block text-gray-700 text-sm font-bold mb-2"><b>Commission  :</b></label>
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

            @if($this->account_id!='')
                <x-jet-button class="ml-2 bg-red-600 hover:bg-red-500" wire:click="deleteaccount({{$this->account_id}})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Delete Account --}}
    <x-jet-confirmation-modal wire:model="deleteaccount">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete Account?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closedeleteaccount()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete({{$this->account_id}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            document.getElementById('linkButton').onclick = function() {
                Livewire.emit('getToken');
                linkHandler.open();
            };
        });
    </script>
    <script>
        var linkHandler = Plaid.create({
            env:"sandbox",
            token: '{{ $this->token }}',
            onSuccess: (public_token, metadata) => {
                Livewire.emit('getAccessToken',public_token);
            },
            onLoad: () => {},
            onExit: (err, metadata) => {
            },
            onEvent: (eventName, metadata) => {
            },
        });
    </script>
    <style>
        @media screen and (max-width: 1000px) and (min-width: 500px){
            .model{
                margin-top: 40%;
                height: 30%;
                width: 100%;
                overflow: hidden;
                border-radius: 5%;
            }
        }
        @media screen and (max-width: 500px){
            .model{
                margin-top: 80%;
                height: 30%;
                width: 100%;
                overflow: hidden;
                border-radius: 5%;
            }
            .text{
                margin-bottom: 0;
                font-size: x-large !important;
                margin-top: -106%;
            }

        }
    </style>
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm
    px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="btn" type="button" data-modal-toggle="defaultModal" style="display: none;">
        Toggle modal
    </button>

    <div id="defaultModal" aria-hidden="true" class="model hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center
    items-center h-modal md:h-full md:inset-0">
        <div class="relative px-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button data-modal-toggle="defaultModal" type="button"  id="cls"></button>
                <div class="p-6 pt-0 text-center" style="display: flex;justify-content: center;align-items: center;">
                    <h6 class="text mb-5 text-lg font-normal text-gray-500" style="position: absolute; font-size: xx-large; font-weight: bolder;color: #00c806;line-height: normal;">
                        Plaid Accounts And All The Holdings Synch with TaxGhost Successfully</h6>
                    <canvas  class="confetti" id="canvas" style="height: 40%; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/confetti.min.js"></script>
    <script>
        $('document').ready(function () {
            var success =$('#successmsg').val();
            console.log(success);
            if(typeof success !== 'undefined' && success !== null && success !== '' )
            {
                console.log(success);
                $('#btn').click();
                setTimeout(function () {
                    $('#cls').click();
                }, 5000);
            }
        });
    </script>
</main>
