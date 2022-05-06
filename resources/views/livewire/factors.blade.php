<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap");

    .wrapper {
        margin: 10px 138px 2px;
        height: 35px;
        width: 512px;
        background: linear-gradient(to right, #da1919 50%, #008000FF 50%);
        border: 1px solid black;
        box-sizing: border-box;
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        /*background-image: url("https://storage.googleapis.com/iex/api/logos/TSLA.png");*/
    }

    .blind {
        height: 100%;
        position: absolute;
        top: 0;
        background-color: #ffffff;
        min-width: 50%;
    }

    .blind.right {
        left: 50%;
        border-left: 1px solid white;
        transform-origin: left top;
        background-color: #008000FF;
        padding: 0 8px;

    }

    .blind.left {
        border-right: 1px solid white;
        transform-origin: left top;
        background-color: #da1919;

        /*background-image: url("https://storage.googleapis.com/iex/api/logos/TSLA.png");*/
    }

    .blinds {
        height: 100%;
        position: absolute;
        top: 0;
        background-color: #ffffff;
        min-width: 50%;
    }

    .blinds.right {
        left: 50%;
        transform-origin: left top;
        background-color: #008000FF;
        z-index: 1;

    }

    .blinds.left {
        transform-origin: left top;
        background-color: #da1919;

    }
    .blind.left:before {
        content: "";
        background-image: url(https://storage.googleapis.com/iex/api/logos/TSLA.png);
        background-size: 33px 33px;
        background-repeat: no-repeat;
        position: absolute;
        right: -33px;
        top: 0;
        display: block;
        min-width: 33px;
        min-height: 33px;
    }

    .blinds.right:before {
        content: "";
        background-image: url(https://storage.googleapis.com/iex/api/logos/TSLA.png);
        background-size: 33px 33px;
        background-repeat: no-repeat;
        position: absolute;
        left: -33px;
        top: 0;
        display: block;
        min-width: 33px;
        min-height: 33px;
        right: auto;
    }

    #buttons {
        text-align: center;
    }

    / Ruler crap /

    /*.ruler-container {*/
    /*    text-align: center;*/
    /*}*/
    .ruler, .ruler li {
        margin: 0;
        padding: 0;
        list-style: none;
        display: inline-block;
    }
    / IE6-7 Fix /
    .ruler, .ruler li {
        *display: inline;
    }
    .ruler {
        display:flex;
        margin: 0 auto;
        /*background: lightYellow;*/
        /*box-shadow: 0 -1px 1em hsl(60, 60%, 84%) inset;*/
        /*border-radius: 2px;*/
        /*border: 1px solid #ccc;*/
        color: #ccc;
        height: 4em;
        padding-right: 2cm;
        white-space: nowrap;
        margin-left: 1px;
    }
    .ruler li {
        padding-left: 1cm;
        width: 194px;
        margin: 0.64em 1.8em 0.36em;
        text-align: center;
        position: relative;
        text-shadow: 1px 1px hsl(60, 60%, 84%);
    }
    .ruler li:before {
        content: '';
        position: absolute;
        border-left: 1px solid #ccc;
        height: .69em;
        top: -.70em;
        right: 5em;
    }
    .growth-value{
        margin-top: -24px;
        margin-right: 227px;

    }

    /*.progress .progress-bar:after{*/
    /*     content:"";*/
    /*     position: absolute;*/
    /*     top: 0px;*/
    /*     right: 0px;*/
    /*     background-image: url("https://storage.googleapis.com/iex/api/logos/TSLA.png");*/
    /*    background-size: 35px;*/
    /*     height:35px;*/
    /*     width: 35px;*/
    /*     border-radius: 50%;*/
    /*     border:1px solid black;*/
    / }/

</style>


<div>

    <x-jet-form-section submit="doNothing">


        <x-slot name="title">
            {{ __('Find Similar Stocks & ETFs') }}
        </x-slot>

        <x-slot name="description">
            {{ __('TaxGhost can help identify similar stocks & ETFs so you can tax loss harvest effectively') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="ticker" value="{{ __('Enter Ticker to Compare') }}" />
                <input wire:model.debounce.500ms="ticker"
                       type="ticker"
                       id="tickerbar"
                       autocomplete="off"
                       placeholder="Enter Ticker..."
                       class="focus:outline-none border-gray-200 p-1 py-2 w-2/4 sm:w-3/4 sm:mr-0"
                       style="border-top:none; border-left: none; border-right: none; border-bottom: 2px solid #d1d5da; padding-bottom: 5px">
                <x-jet-input-error for="ticker" class="mt-2" />
            </div>
            <div class="col-span-12 sm:col-span-12">
                <div class="m-2">
                    <div class="w-full h-full rounded overflow-hidden bg-white px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                        <div class="mt-3 my-1">
                            <div class="flex flex-row items-center xs:flex-col xl:flex-col md:flex-col">
                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 1000px !important;">
                                    @php
                                        $string = $this->logo;
                                        if (strpos($string, "http") === 0) {
                                            $logoUrl = $this->logo;
                                        } else {
                                            $logoUrl = 'https://storage.googleapis.com/iex/api/logos/'.$this->ticker.'.png';
                                        }
                                    @endphp

                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><img src="{{ isset($this->logo) ? $logoUrl : 'https://ui-avatars.com/api/?name='.$this->ticker.'&color=7F9CF5&background=EBF4FF' }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16"></h5>
                                </div>
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <div class="flow-root">
                                        <label><b>Company Name :</b></label>
                                        <span>{{ $this->company }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Company Description :</b></label>
                                        <span>{{ $this->description }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Sector :</b></label>
                                        <span>{{ $this->sector }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Type :</b></label>
                                        <span>{{ $this->type }}</span>
                                    </div>
                                    <div class="flow-root">
                                        <label><b>Tags :</b></label>
                                        @foreach($this->tag as $t)
                                            <span>[ {{ $t }} ] </span>
                                        @endforeach
                                    </div>

                                    <div class="flow-root mt-5">
                                        <div>
                                            <label class="float-left lg:ml-10 mt-2"><b>Small Cap</b></label>
                                        </div>
                                        <div class="wrapper">
                                            <div class='blinds right'></div>
                                            <div class='blinds left'></div>
                                        </div>
                                        <div>
                                            <label class="float-right growth-value " style=" margin-right: 195px;"><b>Large Cap</b></label>
                                        </div>

                                    </div>

                                    <div class="flow-root mt-5">
                                        <div>
                                            <label class="float-left lg:ml-10 mt-2"><b>Growth </b></label>
                                        </div>
                                        <div class="wrapper">
                                            <div class='blind right'></div>
                                            <div class='blind left'></div>
                                        </div>
                                        <div>
                                            <label class="float-right growth-value"><b>Value</b></label>
                                        </div>

                                        <div class="ruler-container">
                                            <ul class="ruler" data-items="3"></ul>
                                        </div>
                                    </div>
                                    <div class="flow-root">
                                        <input type="hidden" value="0.74677007830689" id="Fixed_Income" >
                                        <input type="hidden" value="0.64390829382612" id="Low_Volatility" >
                                        <input type="hidden" value="0.50997028837883" id="Lagging" >
                                        <input type="hidden" value="0.99608425011064" id="Small_Cap" >
                                        <input type="hidden" value="-0.35999798177744" id="Emerging" >
                                        <input type="hidden" value="-0.74985451947159" id="Growth" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('searching...') }}
            </x-jet-action-message>
        <!--
        <x-jet-button>
            {{ __('Search!') }}
            </x-jet-button> -->
        </x-slot>

    </x-jet-form-section>



    <div class="shadow overflow-hidden border-b border-gray-200 sm: rounded-lg table-align mt-10">
        <table>
            <thead class="bg-gray-300">
            <tr>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Factor
                </th>
                <th
                    class="px-4 py-2 cursor-pointer px-6 py-3 max-w-[3.23rem]">Correlation @if($ticker != "")with {{$ticker}}@endif
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            @if($ticker != "" & count($correlations)>0)
                @foreach($correlations->sortByDesc("correlation")->slice(0, 20) as $result)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$result->factor->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900" data-label="Stock Ticker">{{$result->correlation}}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>

    </div>


    <div>



    </div>

</div>
<script>
    let currentPercentageState = 0;
    let easing = "cubic-bezier(0.5, 1, 0.89, 1)";
    let duration = 1000;
    let easeReversal = y => (1 - Math.sqrt((y-1)/-1))


    function animate(percentage) {
        percentage = parseFloat(percentage);

        // determine if we've crossed the 0 threshold, which would force us to do something else here
        let threshold = currentPercentageState / percentage < 0;

        if (!threshold && percentage != 0) {
            // determine which blind we're animating
            let blind = percentage < 0 ? "left" : "right";
            $(`.blind.${blind}`)[0].animate(
                [
                    {
                        transform: `translateX(${currentPercentageState}%)`,
                        easing: easing
                    },
                    {
                        transform: `translateX(${percentage*100}%)`
                    }
                ],
                {
                    fill: "forwards",
                    duration: duration
                }

            );
        } else {
            // this happens when we cross the 0 boundry
            // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
            let firstBlind = percentage < 0 ? "right" : "left";
            let secondBlind = percentage < 0 ? "left" : "right";

            // get total travel distance
            let delta = currentPercentageState - percentage;

            // find the percentage of that travel that the first blind is responsible for
            let firstTravel  = currentPercentageState / delta;
            let secondTravel = 1 - firstTravel;
            // animate the first blind.
            $(`.blind.${firstBlind}`)[0].animate(
                [
                    {
                        transform: `translateX(${currentPercentageState}%)`,
                        easing: easing
                    },
                    {
                        // we go towards the target value instead of 0 since we'll cut the animation short
                        transform: `translateX(${percentage}%)`
                    }
                ],
                {
                    fill: "forwards",
                    duration: duration,
                    // cut the animation short, this should run the animation to this x value of the easing function
                    iterations: easeReversal(firstTravel)

                }
            );

            // animate the second blind
            $(`.blind.${secondBlind}`)[0].animate(
                [
                    {
                        transform: `translateX(${currentPercentageState}%)`,
                        easing: easing
                    },
                    {
                        transform: `translateX(${percentage}%)`
                    }
                ],

                {
                    fill: "forwards",
                    duration: duration,
                    // start the iteration where the first should have left off. This should put up where the easing function left off
                    iterationStart:  easeReversal(firstTravel),
                    // we only need to carry this aniamtion the rest of the way
                    iterations: 1- easeReversal(firstTravel),
                    // delay this animation until the first "meets" it
                    delay: duration * easeReversal(firstTravel)
                }
            );
        }
        // save the new value so that the next iteration has a proper from keyframe
        currentPercentageState = percentage;
    }


    // the following are just binding set ups for the buttons

    $(document).ready(function () {
        animate($('#Growth').val());
        // $(".apply").click(function () {
        //     animate($("#amount").val());
        // });
    });

    // animate(20);
    //setTimeout(()=>animate(-100), 1050)

    $(function () {
        // Build "dynamic" rulers by adding items
        $(".ruler[data-items]").each(function () {
            var ruler = $(this).empty(),
                len = Number(ruler.attr("data-items")) || 0,
                item = $(document.createElement("li")),
                i;

            for (i = -2; i < len - 2; i++) {
                ruler.append(item.clone().text(i + 1));
            }
        });
        // Change the spacing programatically
        function changeRulerSpacing(spacing) {
            $(".ruler")
                .css("padding-right", spacing)
                .find("li")
                .css("padding-left", spacing);
        }
        changeRulerSpacing("30px");
    });

</script>

<script>
    let currentPercentageStates = 0;
    let easings = "cubic-bezier(0.5, 1, 0.89, 1)";
    let durations = 1000;
    let easeReversals = y => (1 - Math.sqrt((y-1)/-1))


    function animates(percentages) {
        percentages = parseFloat(percentages);

        // determine if we've crossed the 0 threshold, which would force us to do something else here
        let thresholds = currentPercentageStates / percentages < 0;
        console.log("Crosses 0: " + thresholds);
        if (!thresholds && percentages != 0) {
            // determine which blind we're animating
            let blinds = percentages < 0 ? "left" : "right";
            $(`.blinds.${blinds}`)[0].animate(
                [
                    {
                        transform: `translateX(${currentPercentageStates}%)`,
                        easing: easings
                    },
                    {
                        transform: `translateX(${percentages*100}%)`
                    }
                ],
                {
                    fill: "forwards",
                    duration: durations
                }

            );
        } else {
            // this happens when we cross the 0 boundry
            // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
            let firstBlinds = percentages < 0 ? "right" : "left";
            let secondBlinds = percentages < 0 ? "left" : "right";

            // get total travel distance
            let deltas = currentPercentageStates - percentages;
            console.log(deltas)
            // find the percentage of that travel that the first blind is responsible for
            let firstTravels  = currentPercentageStates / deltas;
            let secondTravels = 1 - firstTravels;

            console.log("delta; total values to travel: ", deltas);
            console.log(
                "firstTravel; percentage of the total travel that should be done by the first blind: ",
                firstTravels
            );
            console.log(
                "secondTravel; percentage of the total travel that should be done by the second blind: ",
                secondTravels
            );

            // animate the first blind.
            $(`.blinds.${firstBlinds}`)[0].animate(
                [
                    {
                        transform: `translateX(${currentPercentageStates}%)`,
                        easing: easings
                    },
                    {
                        // we go towards the target value instead of 0 since we'll cut the animation short
                        transform: `translateX(${percentages}%)`
                    }
                ],
                {
                    fill: "forwards",
                    duration: durations,
                    // cut the animation short, this should run the animation to this x value of the easing function
                    iterations: easeReversals(firstTravels)

                }
            );

            // animate the second blind
            $(`.blinds.${secondBlinds}`)[0].animate(
                [
                    {
                        transform: `translateX(${currentPercentageStates}%)`,
                        easing: easings
                    },
                    {
                        transform: `translateX(${percentages}%)`
                    }
                ],

                {
                    fill: "forwards",
                    duration: durations,
                    // start the iteration where the first should have left off. This should put up where the easing function left off
                    iterationStart:  easeReversals(firstTravels),
                    // we only need to carry this aniamtion the rest of the way
                    iterations: 1- easeReversals(firstTravels),
                    // delay this animation until the first "meets" it
                    delay: duration * easeReversals(firstTravels)
                }
            );
        }
        // save the new value so that the next iteration has a proper from keyframe
        currentPercentageStates = percentages;
        console.log(percentages)
    }


    // the following are just binding set ups for the buttons

    $(document).ready(function () {
        animates($('#Small_Cap').val());
        console.log($('#Small_Cap').val())
        // $(".apply").click(function () {
        //     animate($("#amount").val());
        // });
    });

    // animate(20);
    //setTimeout(()=>animate(-100), 1050)

    $(function () {
        // Build "dynamic" rulers by adding items
        $(".ruler[data-items]").each(function () {
            var ruler = $(this).empty(),
                len = Number(ruler.attr("data-items")) || 0,
                item = $(document.createElement("li")),
                i;

            for (i = -2; i < len - 2; i++) {
                ruler.append(item.clone().text(i + 1));
            }
        });
        // Change the spacing programatically
        function changeRulerSpacing(spacing) {
            $(".ruler")
                .css("padding-right", spacing)
                .find("li")
                .css("padding-left", spacing);
        }
        changeRulerSpacing("30px");
    });

</script>
