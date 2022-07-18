<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Optimize')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <style>
        .circleBase {
            border-radius: 50%;
        }
        .circle1 {
            width: 20px;
            height: 20px;
            background: #FDE14DFF;
            border: 1px solid #FDE14DFF;
        }
        .circle2 {
            width: 20px;
            height: 20px;
            background: red;
            border: 1px solid red;
        }
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            top: -5px;
            left: 105%;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>
    <div class="container mx-auto px-4 py-10 md:py-12 grid grid-cols-12 gap-2">
                <div class="flex flex-col bg-yellow-200 sm:rounded-lg px-4 py-4 col-start-1 col-span-4 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="w-full mb-5">
                                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                                    {{ __('Potential Trades') }}
                                </h2>
                                <h2 class="pt-2 text-2xl">{{ $stockData->where('ignore_stock',0)->count()}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
        {{-- Box1  --}}

        <div class="flex flex-col bg-green-300 sm:rounded-lg px-4 py-4 col-start-5 col-span-4 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Harvestable Losses') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">{{$this->harvestableLosses<0?"($".(number_format(abs($this->harvestableLosses),2)).")":"$".number_format($this->harvestableLosses,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>
        {{-- Box2  --}}

    </div>
    <div class="mx-auto px-4 py-2 md:py-12">
        <div class="grid grid-cols-12 gap-2">
            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 border-b-2 border-gray-300 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="inline-flex items-center space-x-2 float-right">
                            <select  wire:model="sortBy" class="shadow appearance-none border w-60 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Filter By Account</option>
                                @foreach($this->account as $account)
                                    <option value="{{$account->id}}">{{$account->account_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5 overflow-hidden" style="height: 100%">
                            @if(isset($stockData) && count($stockData)>0)
                                <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">
                                    @foreach($stockData->where('ignore_stock',0) as $tl)
                                        <livewire:optimize.stock :toploss="$tl"/>
                                    @endforeach
                                </div>
                            @else
                                <div class="grid grid-cols-1 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-1 lg:grid-cols-1 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">
                                    <div class="flex items-center justify-center text-gray-600 h-16 opacity-50 text-md">
                                        <span class="mr-3"><i class="fa fa-chart-line"></i></span>
                                        <span class="text-lg">No Stock Found ...</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if(isset($stockData) && count($stockData)>0)
            <div class="mx-auto px-4 py-2 md:py-12">
                <div class="grid grid-cols-12 gap-2">
                    <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                        <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                            <div class="py-2 border-b-2 border-gray-300 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="inline-flex items-center space-x-2 float-left">
                                    <p class="text-xl font-bold">Completed</p>
                                </div>
                            </div>
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="w-full mb-5 overflow-hidden" style="height: 100%">
                                    <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">
                                        @foreach($stockData->where('ignore_stock',1) as $key => $tl)
                                            <livewire:optimize.complete-ignore-stock :completeIgnore="$tl"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @if(isset($stockData) && count($stockData)>0)
            <div class="mx-auto px-4 py-2 md:py-12">
                <div class="grid grid-cols-12 gap-2">
                    <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                        <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                            <div class="py-2 border-b-2 border-gray-300 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="inline-flex items-center space-x-2 float-left">
                                    <p class="text-xl font-bold">Ignored</p>
                                </div>
                            </div>
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="w-full mb-5 overflow-hidden" style="height: 100%">
                                    <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full ">
                                        @foreach($stockData->where('ignore_stock',2) as $key => $tl)
                                            <livewire:optimize.complete-ignore-stock :completeIgnore="$tl"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
{{--      Company Detail--}}
        @livewire('company-detail-modal')
    {{--    <x-jet-dialog-modal wire:model="confirmIgnoreSection" wire:click.away="cancelIgnoreSection">--}}
    {{--        <x-slot name="title">--}}
    {{--            {{ __('Mark as ignored') }}--}}
    {{--        </x-slot>--}}

    {{--        <x-slot name="content">--}}
    {{--            {{ __('Mark as ignored') }}--}}
    {{--        </x-slot>--}}

    {{--        <x-slot name="footer">--}}
    {{--            <x-jet-secondary-button wire:click="cancelIgnoreSection()" wire:loading.attr="disabled">--}}
    {{--                {{ __('No') }}--}}
    {{--            </x-jet-secondary-button>--}}

    {{--            <x-jet-danger-button class="ml-2" wire:click="ignoreSection()" wire:loading.attr="disabled">--}}
    {{--                {{ __('yes') }}--}}
    {{--            </x-jet-danger-button>--}}
    {{--        </x-slot>--}}
    {{--    </x-jet-dialog-modal>--}}
    {{--    <x-jet-dialog-modal wire:model="confirmCompleteSection" wire:click.away="cancelCompleteSection">--}}
    {{--        <x-slot name="title">--}}
    {{--            {{ __('Mark As Complete') }}--}}
    {{--        </x-slot>--}}

    {{--        <x-slot name="content">--}}
    {{--            {{ __('Mark As Complete') }}--}}
    {{--        </x-slot>--}}

    {{--        <x-slot name="footer">--}}
    {{--            <x-jet-secondary-button wire:click="cancelCompleteSection()" wire:loading.attr="disabled">--}}
    {{--                {{ __('No') }}--}}
    {{--            </x-jet-secondary-button>--}}

    {{--            <x-jet-button class="ml-2" wire:click="completeSection()" wire:loading.attr="disabled">--}}
    {{--                {{ __('yes') }}--}}
    {{--            </x-jet-button>--}}
    {{--        </x-slot>--}}
    {{--    </x-jet-dialog-modal>--}}
    {{--    <x-jet-dialog-modal wire:model="confirmSection" wire:click.away="cancelSection">--}}
    {{--        <x-slot name="title">--}}
    {{--            {{ __('Add  Section') }}--}}
    {{--        </x-slot>--}}

    {{--        <x-slot name="content">--}}
    {{--            {{ __('') }}--}}
    {{--        </x-slot>--}}

    {{--        <x-slot name="footer">--}}
    {{--            <x-jet-secondary-button wire:click="cancelSection()" wire:loading.attr="disabled">--}}
    {{--                {{ __('No') }}--}}
    {{--            </x-jet-secondary-button>--}}

    {{--            <x-jet-button class="ml-2" wire:click="section()" wire:loading.attr="disabled">--}}
    {{--                {{ __('yes') }}--}}
    {{--            </x-jet-button>--}}
    {{--        </x-slot>--}}
    {{--    </x-jet-dialog-modal>--}}
</main>
