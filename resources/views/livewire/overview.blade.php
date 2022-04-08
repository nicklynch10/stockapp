<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Overview')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <style>
        @media screen and (max-width: 600px) {
            table tr td{
                display: block;
                font-size: 12px;
                padding-bottom: 10px !important;
                padding-top: 10px !important;
            }
            table thead{
                display: none;
            }
            table td{
                text-align: right !important;
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
            table td:first-child { background: #00c80696;border-radius: 7px 7px 0px 0px; }
        }
        table tr:nth-child(even){background-color: #ffffff;}
    </style>
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

    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Current Holdings') }}
                        </h2>
                    </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align">
                        @livewire('current-holdings')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($this->sto) && count($this->sto)>0)
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col bg-white shadow-xl sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Asset Allocation') }}
                        </h2>
                    </div>
                    <div class="overflow-hidden sm: rounded-lg table-align justify-center flex-row">
                        <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($this->box2) && count($this->box2)>0 && $totalTaxableGainLoss!=0)
    <div class="container mx-auto px-4 py-10 md:py-12">
        <div class="flex flex-col bg-white shadow-xl sm:rounded-lg px-4 py-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 example">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="w-full mb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Taxable Gain / (Loss) Over Time') }}
                        </h2>
                    </div>
                    <div class="overflow-hidden sm: rounded-lg table-align">
                        <canvas id="TaxableGain"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Stock Sell Modal  --}}
    @livewire('stock-sell-modal')
    {{--   End Stock Sell Modal  --}}

    {{-- Stock Purchase Add  --}}
    @livewire('stock-add-edit-modal')
    {{--   End Stock Purchase Input  --}}

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

            var barColors = ["#BFDBFE", "#FECACA", "#10B981",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#F87171", "#4338CA", "#EFF6FF", "#FDF2F8", "#ECFDF5", "#FEF3C7", "#F3F4F6", "#EDE9FE", "#F9A8D4", "#BFDBFE", "#FECACA", "#F87171",
                "#D97706", "#10B981", "#818CF8", "#DB2777", "#D1D5DB", "#DB2777", "#4338CA",
                "#BFDBFE", "#FECACA", "#F87171",
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
                    }
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
