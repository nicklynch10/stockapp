<x-jet-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        @if($this->stock_id == '') {{ __('Purchase New Stock') }} @else {{ __('Edit Stock') }} @endif
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
                            <label for="companyname" class="block text-gray-700 text-sm font-bold mb-2"><b>Search By Company or Ticker:</b></label>
                            {{--                            <input type="text" id="tickerorcompany" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Ticker or Company" wire:model="tickerorcompany">--}}
                            <input type="text" id="tickerorcompany"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Ticker or Company" wire:model="tickerorcompany" {{ $this->stock_id ? 'readonly' : '' }}>
                            <input type="text" id="type" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Company Name" wire:model="{{$this->type}}">
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
                        @if($this->tickerorcompany)
                            <div class="mb-4" style="border-left:5px solid #00c806;padding: 10px">
                                <label class="text-2xl"><b>{{$this->stock_ticker}}</b></label><br>
                                <label>{{$this->company_name}}<br>
                                @if($this->type == 0)
                                    <label><div class="row-auto flex"><h3 style="background: green; border-radius: 50%;width: 20px;height: 20px;"></h3><p class="pl-3">Stock</p></div></label>
                                @elseif($this->type == 1)
                                    <label><div class="row-auto flex"><h3 style="background: red; border-radius: 50%;width: 20px;height: 20px;"></h3><p class="pl-3">Mutual Funds</p></div></label>
                                @elseif($this->type == 2)
                                    <label><div class="row-auto flex"><h3 style="background: gold; border-radius: 50%;width: 20px;height: 20px;"></h3><p class="pl-3">Crypto Currency</p></div></label>
                                @endif
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="current_share_price" class="block text-gray-700 text-sm font-bold mb-2"><b>Current Share Price:</b></label>
                            <input type="text" readonly id="current_share_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Current Share Price" wire:model="current_share_price">
                            <input type="hidden" id="tickerLogo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Current Share Price" wire:model="tickerLogo">
                            @error('current_share_price') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="average_cost" class="block text-gray-700 text-sm font-bold mb-2"><b>Average Purchase Price (per Share) :</b></label>
                            <input type="text" id="average_cost" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Average Cost Purchase Per Share" @if($this->openmodalval==0) wire:click="$emit('AveModal')" @endif wire:model="average_cost">
                            @error('average_cost') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="share_number" class="block text-gray-700 text-sm font-bold mb-2"><b>Number of Shares:</b></label>
                            <input type="text" id="share_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter shares..." wire:model="share_number">
                            @error('share_number') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="account_type" class="block text-gray-700 text-sm font-bold mb-2"><b>Select Account:</b></label>
                            @if(count($account)>0)
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="account_type">
                                    @foreach($account as $acc)
                                        <option hidden>Select Account</option>
                                        <option value="{{$acc->id}}">{{$acc->account_type}}</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-red-700">Please first <a class="cursor-pointer text-blue-600 underline" href="{{ route('account') }}">Add your Account</a></p>
                            @endif
                            @error('account_type') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="date_of_purchase" class="block text-gray-700 text-sm font-bold mb-2"><b>Date of Purchase:</b></label>
                            <input type="date" max="{{date('Y-m-d')}}" id="date_of_purchase" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="date_of_purchase">
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
                            <input type="text" readonly id="securityname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Security Name" wire:model="security_name">
                            @error('security_name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2"><b>Description:</b></label>
                            <textarea id="description" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Description" wire:model="description" rows="5"></textarea>
                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Sector:</b></label>
                            <input type="text" readonly id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Sector" wire:model="sector">
                            @error('sector') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="sector" class="block text-gray-700 text-sm font-bold mb-2"><b>Issue Type:</b></label>
                            <input type="text" readonly id="sector" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Issue Type" value="{{ convertType($this->issuetype) }}">
                            <input type="text" readonly hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Issue Type" wire:model="issuetype">
                            <input type="text" hidden class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Issue Type" wire:model="tags">
                            @error('issuetype') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="market_cap" class="block text-gray-700 text-sm font-bold mb-2"><b>Market Cap ($mm):</b></label>
                            <input type="text" readonly id="market_cap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Market Cap" wire:model="market_cap">
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
            <x-jet-button class="mr-2 bg-blue-600 hover:bg-blue-600" wire:click="back(1)" wire:loading.attr="disabled">
                {{ __('Back') }}
            </x-jet-button>

            <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
                {{ __('Buy') }}
            </x-jet-button>

            @if($this->stock_id)
                <x-jet-button class="ml-2 bg-red-600 hover:bg-red-500" wire:click="deletestock({{$this->stock_id}})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-button>
            @endif
        @endif
    </x-slot>
</x-jet-dialog-modal>
<script>
    // $( "#average_cost" ).blur(function() {
    //     this.value = parseFloat(this.value).toFixed(2);
    // });
    $("#average_cost").keyup(function(){
        var num = parseFloat($(this).val());
        if ( num >= 99999.99)
        {
            $(this).val("99999.99");
        }
        var number = ($(this).val().split('.'));
        if (number[1] && number[1].length > 2)
        {
            var salary = parseFloat($("#average_cost").val());
            $("#average_cost").val( salary.toFixed(2));
        }
    });

    $("#share_number").on("input", function() {
        if (/^0/.test(this.value)) {
            this.value = this.value.replace(/^0/, "")
        }
    });
</script>


