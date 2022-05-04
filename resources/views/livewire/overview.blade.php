<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Overview')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <div class="container mx-auto px-4 py-10 md:py-12 grid grid-cols-12 gap-2">

        {{-- Box1  --}}
        <div class="flex flex-col p-8 bg-blue-200 sm:rounded-lg px-4 py-4 col-start-2 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Total Tax Savings Realized') }}
                        </h3>
                        <h2 class="pt-2 text-2xl">{{$this->totalSavingsRealized<0?"($".(number_format(abs($this->totalSavingsRealized),2)).")":"$".number_format($this->totalSavingsRealized,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Box2  --}}
        <div class="flex flex-col bg-gray-200 sm:rounded-lg px-4 py-4 col-start-4 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Total Taxable Gain / (Loss)') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">{{$this->totalTaxableGainLoss<0?"($".(number_format(abs($this->totalTaxableGainLoss),2)).")":"$".number_format($this->totalTaxableGainLoss,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Box3  --}}
        <div class="flex flex-col bg-yellow-200 sm:rounded-lg px-4 py-4 col-start-6 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Total Unrealized Gain / (Loss)') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">{{$this->totalUnrealizedGainLoss<0?"($".(number_format(abs($this->totalUnrealizedGainLoss),2)).")":"$".number_format($this->totalUnrealizedGainLoss,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Box4  --}}
        <div class="flex flex-col bg-green-100 sm:rounded-lg px-4 py-4 col-start-8 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
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

        {{-- Box5  --}}
        <div class="flex flex-col bg-pink-100 sm:rounded-lg px-4 py-4 col-start-10 col-span-2 sm:col-span-4 xs:col-span-12 xs:col-start-2 rounded-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Unrealized Gain') }}
                        </h2>
                        <h2 class="pt-2 text-2xl">{{$this->unrealizedGain<0?"($".(number_format(abs($this->unrealizedGain),2)).")":"$".number_format($this->unrealizedGain,2)}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto px-4 py-10 md:py-5">
        <div class="grid grid-cols-12 gap-2">
            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5 overflow-hidden" style="height: 100%">
                            @livewire('current-holdings')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-10 md:py-12 grid grid-cols-12 gap-2">
        @if(isset($this->sto) && count($this->sto)>0)
            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 {{(count($this->box2)>0 && $totalTaxableGainLoss!=0)?'col-span-6 sm:col-span-6':'col-span-12 sm:col-span-12'}}  xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ __('Asset Allocation') }}
                            </h3>
                            <div class="overflow-hidden sm: rounded-lg table-align justify-center flex-row pt-10">
                                <canvas id="myChart" height="500" style="width:100%;max-width:2000px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($this->box2) && count($this->box2)>0 && $totalTaxableGainLoss!=0)
            <div class="flex flex-col bg-white sm:rounded-lg px-4 py-4 col-start-7 col-span-6 sm:col-span-6 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ __('Taxable Gain / (Loss) Over Time') }}
                            </h2>
                            <div class="overflow-hidden sm: rounded-lg table-align pt-10">
                                <canvas id="TaxableGain" height="500"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    {{-- Stock Purchase Add  --}}
    @livewire('stock-add-edit-modal')
    {{--   End Stock Purchase Input  --}}

    {{-- Stock Sell Modal  --}}
    @livewire('stock-sell-modal')
    {{--   End Stock Sell Modal  --}}

    {{-- Delete Stock --}}
    @livewire('stock-delete-modal')
    {{-- End Delete Stock --}}

    {{--  Ave price update confirmation  --}}
    @livewire('ave-cost-update')
    {{--  End Ave price update confirmation  --}}

    @livewire('stock-share-sell');

    {{-- Stock Buy Modal  --}}
    @livewire('stock-buy-modal')
    {{--   End Stock Buy Modal  --}}

    <script>
        var xValues = [@foreach($this->sto as $st)
            @if($st->total_stock!=0)
            "{{$st->stock_ticker}}",
            @endif
            @endforeach];
        var yValues = [
            @foreach($this->sto as $st)
                @if($st->total_stock!=0)
                {{round($st->total_stock*$st->current_share_price)}},
            @endif
            @endforeach];

            var barColors = ["#bfdbfe", "#FF6347", "#fde68a", "#FF7F50", "#CD5C5C", "#d1fae5",
                "#F08080", "#E9967A", "#fce7f3", "#FA8072", "#FFA07A", "#FF8C00", "#6B8E23", "#228B22", "#98FB98", "#20B2AA", "#DDA0DD", "#EE82EE", "#C71585", "#FF69B4", "#FFB6C1", "#FAEBD7", "#FFE4C4", "#F5F5DC", "#FFEBCD",
                "#A0522D", "#CD853F", "#DEB887", "#696969", "#808080", "#FDF5E6", "#D2B48C",
                "#F5DEB3", "#8B4513", "#D2691E",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA", "#EFF6FF", "#FDF2F8", "#ECFDF5", "#FEF3C7", "#F3F4F6", "#EDE9FE", "#F9A8D4", "#BFDBFE", "#FECACA", "#F87171",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA" , "#bfdbfe", "#FF6347", "#fde68a", "#FF7F50", "#CD5C5C", "#d1fae5",
                "#F08080", "#E9967A", "#fce7f3", "#FA8072", "#FFA07A", "#FF8C00", "#6B8E23", "#228B22", "#98FB98", "#20B2AA", "#DDA0DD", "#EE82EE", "#C71585", "#FF69B4", "#FFB6C1", "#FAEBD7", "#FFE4C4", "#F5F5DC", "#FFEBCD",
                "#A0522D", "#CD853F", "#DEB887", "#696969", "#808080", "#FDF5E6", "#D2B48C",
                "#F5DEB3", "#8B4513", "#D2691E",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA", "#EFF6FF", "#FDF2F8", "#ECFDF5", "#FEF3C7", "#F3F4F6", "#EDE9FE", "#F9A8D4", "#BFDBFE", "#FECACA", "#F87171",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA" , "#bfdbfe", "#FF6347", "#fde68a", "#FF7F50", "#CD5C5C", "#d1fae5",
                "#F08080", "#E9967A", "#fce7f3", "#FA8072", "#FFA07A", "#FF8C00", "#6B8E23", "#228B22", "#98FB98", "#20B2AA", "#DDA0DD", "#EE82EE", "#C71585", "#FF69B4", "#FFB6C1", "#FAEBD7", "#FFE4C4", "#F5F5DC", "#FFEBCD",
                "#A0522D", "#CD853F", "#DEB887", "#696969", "#808080", "#FDF5E6", "#D2B48C",
                "#F5DEB3", "#8B4513", "#D2691E",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA", "#EFF6FF", "#FDF2F8", "#ECFDF5", "#FEF3C7", "#F3F4F6", "#EDE9FE", "#F9A8D4", "#BFDBFE", "#FECACA", "#F87171",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA"];

            new Chart("myChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data:yValues
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataLabel = data.labels[tooltipItem.index];
                                var value = ' : $' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

                                if (Chart.helpers.isArray(dataLabel)) {
                                    dataLabel = dataLabel.slice();
                                    dataLabel[0] += value;
                                } else {
                                    dataLabel += value;
                                }

                                return dataLabel;
                            }
                        }
                    }
                }
            });
    </script>

    <script>
        var data = {
            labels:
                [
                    @php
                        foreach($this->date as $key=>$d)
                        {

                            $total=0; $taxable=0;
                            foreach($this->tran as $t)
                            {
                                if($d->date_of_transaction>=$t->date_of_transaction)
                                {
                                    $taxable+=($t->share_price-$t->ave_cost)*($t->stock);
                                }
                            }
                            if($taxable!=0)
                            {
                                echo "'".\Carbon\Carbon::parse($d->date_of_transaction)->format('n/j/Y')."',";
                            }
                        }
                    @endphp
                ],
            datasets: [
                {
                    label: "Cumulative Taxable Gain / (Loss) Over Time : ",
                    lineTension: 0,
                    backgroundColor: "rgba(255,255,255,0)",
                    borderColor: "rgba(108,108,108,1)",
                    borderWidth: 2,
                    pointBackgroundColor: "#000",
                    data: [
                        @php
                            foreach($this->date as $key=>$d)
                            {
                                $total=0; $taxable=0;
                                foreach($this->tran as $t)
                                {
                                    if($d->date_of_transaction>=$t->date_of_transaction)
                                    {
                                        $taxable+=($t->share_price-$t->ave_cost)*($t->stock);
                                        $value=round($taxable,2);
                                    }
                                }
                                if($taxable!=0)
                                {
                                    echo "$value,";
                                }
                            }
                        @endphp
                    ],
                }
            ],
        };

        //var myChart =
        new Chart(document.getElementById('TaxableGain'), {
            type: 'line',
            data: data,
            options: {
                animation: false,
                legend: {display: false},
                maintainAspectRatio: false,
                responsive: true,
                responsiveAnimationDuration: 0,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let label = data.datasets[tooltipItem.datasetIndex].label || '';
                            var datavalue = Math.round(tooltipItem.yLabel * 100) / 100;
                            if(datavalue<0)
                            {
                                label += '($'+Math.abs(datavalue)+')';
                            }
                            else
                            {
                                label += '$'+datavalue;
                            }
                            return label;
                        }
                    },
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "#000",
                            fontSize: 15,
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if(parseInt(value) >= 1000){
                                    if(value<0){
                                        return '($' + Math.abs(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ')';
                                    }
                                    else{
                                        return '$' + Math.abs(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                }
                                else {
                                    if(value<0){
                                        return '($' + Math.abs(value) + ')';
                                    }
                                    else{
                                        return '$' + Math.abs(value);
                                    }
                                }
                            }
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontColor: "#000",
                            fontSize: 15,
                            beginAtZero: true,
                        }
                    }]
                }
            }
        });
    </script>
</main>
