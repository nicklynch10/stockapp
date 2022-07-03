@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
                {{ __('Find the Best Comparable Stocks/ETFs') }}
                <div class="text-center float-right">
                    <a type="button" href="{{route('analyze-compare')}}" class="inline-block px-2 text-sm py-1 bg-green-500 text-white font-medium leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        <i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Back</a>
                </div>
            </h2>
        </x-slot>

        <div>
            @livewire('factor-plot',['tickerData' => $ticker])
            <x-jet-section-border />
        </div>
    </x-app-layout>
@else
    <x-guest-layout>
        <x-slot name="header">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
                    {{ __('Find the Best Comparable Stocks/ETFs') }}
                    <div class="text-center float-right">
                        <a type="button" href="{{route('analyze-compare')}}" class="inline-block px-2 text-sm py-1 bg-green-500 text-white font-medium leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> <i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Back</a>

                    </div>
                </h2>
            </div>
        </x-slot>
        <div>
            @livewire('factor-plot',['tickerData' => $ticker])
            <x-jet-section-border />
        </div>
    </x-guest-layout>
@endauth
