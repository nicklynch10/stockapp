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
                        <h2 class="pt-2 text-2xl">{{ count($this->potentialSavings) }}</h2>
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
    <livewire:optimize.main-section />
    <livewire:optimize.completed-section />
    <livewire:optimize.ignore-section />
    @livewire('company-detail-modal')
</main>
