// Growth and Value//
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
        if (percentage < 0){

            $("#blindLeft").addClass("left-demo");
            $("#blindLeft").attr("title",parseFloat(percentage).toFixed(2));
        }else {
            $("#blindRight").addClass("right-demo");
            $("#blindRight").attr("title",parseFloat(percentage).toFixed(2));
        }
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


// 	Small Cap and 	Large Cap //

let currentPercentageStates = 0;
let easings = "cubic-bezier(0.5, 1, 0.89, 1)";
let durations = 1000;
let easeReversals = y => (1 - Math.sqrt((y-1)/-1))


function animates(percentages) {
    percentages = parseFloat(percentages);

    // determine if we've crossed the 0 threshold, which would force us to do something else here
    let thresholds = currentPercentageStates / percentages < 0;

    if (!thresholds && percentages != 0) {
        // determine which blind we're animating
        let blinds = percentages < 0 ? "left" : "right";

        if(percentages < 0)
        {
            $("#SmallLeft").addClass("left-demo");
            $("#SmallLeft").attr("title",parseFloat(percentages).toFixed(2));
        }else {
            $("#SmallRight").addClass("right-demo");
            $("#SmallRight").attr("title",parseFloat(percentages).toFixed(2));
        }

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
        // find the percentage of that travel that the first blind is responsible for
        let firstTravels  = currentPercentageStates / deltas;
        let secondTravels = 1 - firstTravels;


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
}


// the following are just binding set ups for the buttons

$(document).ready(function () {
    animates($('#Small').val());
});

// Low Volatility and 	High Volatility	//
let currentPercentageStatesLow = 0;
let easingsLow = "cubic-bezier(0.5, 1, 0.89, 1)";
let durationsLow = 1000;
let easeReversalsLow = y => (1 - Math.sqrt((y-1)/-1))


function animatesLow(percentagesLow) {
    percentagesLow = parseFloat(percentagesLow);

    // determine if we've crossed the 0 threshold, which would force us to do something else here
    let thresholdsLow = currentPercentageStatesLow / percentagesLow < 0;
    if (!thresholdsLow && percentagesLow != 0) {
        // determine which blind we're animating
        let blindsLow = percentagesLow < 0 ? "left" : "right";

        if(percentagesLow < 0)
        {
            $("#LowLeft").addClass("left-demo");
            $("#LowLeft").attr("title",parseFloat(percentagesLow).toFixed(2));
        }else {
            $("#LowRight").addClass("right-demo");
            $("#LowRight").attr("title",parseFloat(percentagesLow).toFixed(2));
        }

        $(`.blindsLow.${blindsLow}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesLow}%)`,
                    easing: easingsLow
                },
                {
                    transform: `translateX(${percentagesLow*100}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsLow
            }

        );
    } else {
        // this happens when we cross the 0 boundry
        // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
        let firstBlinds = percentagesLow < 0 ? "right" : "left";
        let secondBlinds = percentagesLow < 0 ? "left" : "right";

        // get total travel distance
        let deltasLow = currentPercentageStatesLow - percentagesLow;
        // find the percentage of that travel that the first blind is responsible for
        let firstTravelsLow  = currentPercentageStatesLow / deltasLow;
        let secondTravelsLow = 1 - firstTravelsLow;

        // animate the first blind.
        $(`.blindsLow.${firstBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesLow}%)`,
                    easing: easingsLow
                },
                {
                    // we go towards the target value instead of 0 since we'll cut the animation short
                    transform: `translateX(${percentagesLow}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsLow,
                // cut the animation short, this should run the animation to this x value of the easing function
                iterations: easeReversalsLow(firstTravelsLow)

            }
        );

        // animate the second blind
        $(`.blindsLow.${secondBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesLow}%)`,
                    easing: easingsLow
                },
                {
                    transform: `translateX(${percentagesLow}%)`
                }
            ],

            {
                fill: "forwards",
                duration: durationsLow,
                // start the iteration where the first should have left off. This should put up where the easing function left off
                iterationStart:  easeReversalsLow(firstTravelsLow),
                // we only need to carry this aniamtion the rest of the way
                iterations: 1- easeReversalsLow(firstTravelsLow),
                // delay this animation until the first "meets" it
                delay: durationsLow * easeReversalsLow(firstTravelsLow)
            }
        );
    }
    // save the new value so that the next iteration has a proper from keyframe
    currentPercentageStatesLow = percentagesLow;
}
// the following are just binding set ups for the buttons
$(document).ready(function () {
    animatesLow($('#Low').val());

});

// Fixed Income and Equities	//
let currentPercentageStatesFixed = 0;
let easingsFixed = "cubic-bezier(0.5, 1, 0.89, 1)";
let durationsFixed = 1000;
let easeReversalsFixed = y => (1 - Math.sqrt((y-1)/-1))


function animatesFixed(percentagesFixed) {
    percentagesFixed = parseFloat(percentagesFixed);

    // determine if we've crossed the 0 threshold, which would force us to do something else here
    let thresholdsFixed = currentPercentageStatesFixed / percentagesFixed < 0;
    if (!thresholdsFixed && percentagesFixed != 0) {
        // determine which blind we're animating
        let blindsFixed = percentagesFixed < 0 ? "left" : "right";
        if(percentagesFixed < 0)
        {
            $("#FixedLeft").addClass("left-demo");
            $("#FixedLeft").attr("title",parseFloat(percentagesFixed).toFixed(2));
        }else {
            $("#FixedRight").addClass("right-demo");
            $("#FixedRight").attr("title",parseFloat(percentagesFixed).toFixed(2));
        }
        $(`.blindsFixed.${blindsFixed}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesFixed}%)`,
                    easing: easingsFixed
                },
                {
                    transform: `translateX(${percentagesFixed*100}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsFixed
            }

        );
    } else {
        // this happens when we cross the 0 boundry
        // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
        let firstBlinds = percentagesFixed < 0 ? "right" : "left";
        let secondBlinds = percentagesFixed < 0 ? "left" : "right";

        // get total travel distance
        let deltasFixed = currentPercentageStatesFixed - percentagesFixed;
        // find the percentage of that travel that the first blind is responsible for
        let firstTravelsFixed  = currentPercentageStatesFixed / deltasFixed;
        let secondTravelsFixed = 1 - firstTravelsFixed;


        // animate the first blind.
        $(`.blindsFixed.${firstBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesFixed}%)`,
                    easing: easingsFixed
                },
                {
                    // we go towards the target value instead of 0 since we'll cut the animation short
                    transform: `translateX(${percentagesFixed}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsFixed,
                // cut the animation short, this should run the animation to this x value of the easing function
                iterations: easeReversalsFixed(firstTravelsFixed)

            }
        );

        // animate the second blind
        $(`.blindsFixed.${secondBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesFixed}%)`,
                    easing: easingsFixed
                },
                {
                    transform: `translateX(${percentagesFixed}%)`
                }
            ],

            {
                fill: "forwards",
                duration: durationsFixed,
                // start the iteration where the first should have left off. This should put up where the easing function left off
                iterationStart:  easeReversalsFixed(firstTravelsFixed),
                // we only need to carry this aniamtion the rest of the way
                iterations: 1- easeReversalsFixed(firstTravelsFixed),
                // delay this animation until the first "meets" it
                delay: durationFixed * easeReversalsFixed(firstTravelsFixed)
            }
        );
    }
    // save the new value so that the next iteration has a proper from keyframe
    currentPercentageStatesFixed = percentagesFixed;
}
// the following are just binding set ups for the buttons
$(document).ready(function () {
    animatesFixed($('#Fixed').val());

});


// Lagging and Momentum	//


let currentPercentageStatesLagging = 0;
let easingsLagging = "cubic-bezier(0.5, 1, 0.89, 1)";
let durationsLagging = 1000;
let easeReversalsLagging = y => (1 - Math.sqrt((y-1)/-1))


function animatesLagging(percentagesLagging) {
    percentagesLagging = parseFloat(percentagesLagging);

    // determine if we've crossed the 0 threshold, which would force us to do something else here
    let thresholdsLagging = currentPercentageStatesLagging / percentagesLagging < 0;
    if (!thresholdsLagging && percentagesLagging != 0) {
        // determine which blind we're animating
        let blindsLagging = percentagesLagging < 0 ? "left" : "right";
        if(percentagesLagging < 0)
        {
            $("#LaggingLeft").addClass("left-demo");
            $("#LaggingLeft").attr("title",parseFloat(percentagesLagging).toFixed(2));
        }else {
            $("#LaggingRight").addClass("right-demo");
            $("#LaggingRight").attr("title",parseFloat(percentagesLagging).toFixed(2));
        }
        $(`.blindsLagging.${blindsLagging}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesLagging}%)`,
                    easing: easingsLagging
                },
                {
                    transform: `translateX(${percentagesLagging*100}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsLagging
            }

        );
    } else {
        // this happens when we cross the 0 boundry
        // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
        let firstBlinds = percentagesLagging < 0 ? "right" : "left";
        let secondBlinds = percentagesLagging < 0 ? "left" : "right";

        // get total travel distance
        let deltasLagging = currentPercentageStatesLagging - percentagesLagging;
        // find the percentage of that travel that the first blind is responsible for
        let firstTravelsLagging  = currentPercentageStatesLagging / deltasLagging;
        let secondTravelsLagging = 1 - firstTravelsLagging;


        // animate the first blind.
        $(`.blindsLagging.${firstBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesLagging}%)`,
                    easing: easingsLagging
                },
                {
                    // we go towards the target value instead of 0 since we'll cut the animation short
                    transform: `translateX(${percentagesLagging}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsLagging,
                // cut the animation short, this should run the animation to this x value of the easing function
                iterations: easeReversalsLagging(firstTravelsLagging)

            }
        );

        // animate the second blind
        $(`.blindsLagging.${secondBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesLagging}%)`,
                    easing: easingsLagging
                },
                {
                    transform: `translateX(${percentagesLagging}%)`
                }
            ],

            {
                fill: "forwards",
                duration: durationsLagging,
                // start the iteration where the first should have left off. This should put up where the easing function left off
                iterationStart:  easeReversalsLagging(firstTravelsLagging),
                // we only need to carry this aniamtion the rest of the way
                iterations: 1- easeReversalsLagging(firstTravelsLagging),
                // delay this animation until the first "meets" it
                delay: durationLagging * easeReversalsLagging(firstTravelsLagging)
            }
        );
    }
    // save the new value so that the next iteration has a proper from keyframe
    currentPercentageStatesLagging = percentagesLagging;
}
// the following are just binding set ups for the buttons
$(document).ready(function () {
    animatesLagging($('#Lagging').val());

});

// Emerging  and Developed	//


let currentPercentageStatesEmerging = 0;
let easingsEmerging = "cubic-bezier(0.5, 1, 0.89, 1)";
let durationsEmerging = 1000;
let easeReversalsEmerging = y => (1 - Math.sqrt((y-1)/-1))


function animatesEmerging(percentagesEmerging) {
    percentagesEmerging = parseFloat(percentagesEmerging);

    // determine if we've crossed the 0 threshold, which would force us to do something else here
    let thresholdsEmerging = currentPercentageStatesEmerging / percentagesEmerging < 0;
    if (!thresholdsEmerging && percentagesEmerging != 0) {
        // determine which blind we're animating
        let blindsEmerging = percentagesEmerging < 0 ? "left" : "right";
        if(percentagesEmerging < 0)
        {
            $("#EmergingLeft").addClass("left-demo");
            $("#EmergingLeft").attr("title",parseFloat(percentagesEmerging).toFixed(2));
        }else {
            $("#EmergingRight").addClass("right-demo");
            $("#EmergingRight").attr("title",parseFloat(percentagesEmerging).toFixed(2));
        }
        $(`.blindsEmerging.${blindsEmerging}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesEmerging}%)`,
                    easing: easingsEmerging
                },
                {
                    transform: `translateX(${percentagesEmerging*100}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsEmerging
            },

        );
    } else {
        // this happens when we cross the 0 boundry
        // we'll have to create two animations - one for moving the currently offset blind back to 0, and then another to move the second blind
        let firstBlinds = percentagesEmerging < 0 ? "right" : "left";
        let secondBlinds = percentagesEmerging < 0 ? "left" : "right";

        // get total travel distance
        let deltasEmerging = currentPercentageStatesEmerging - percentagesEmerging;
        // find the percentage of that travel that the first blind is responsible for
        let firstTravelsEmerging  = currentPercentageStatesEmerging / deltasEmerging;
        let secondTravelsEmerging = 1 - firstTravelsEmerging;

        // animate the first blind.

        $(`.blindsEmerging.${firstBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesEmerging}%)`,
                    easing: easingsEmerging
                },
                {
                    // we go towards the target value instead of 0 since we'll cut the animation short
                    transform: `translateX(${percentagesEmerging}%)`
                }
            ],
            {
                fill: "forwards",
                duration: durationsEmerging,
                // cut the animation short, this should run the animation to this x value of the easing function
                iterations: easeReversalsEmerging(firstTravelsEmerging)

            }
        );

        // animate the second blind
        $(`.blindsEmerging.${secondBlinds}`)[0].animate(
            [
                {
                    transform: `translateX(${currentPercentageStatesEmerging}%)`,
                    easing: easingsEmerging
                },
                {
                    transform: `translateX(${percentagesEmerging}%)`
                }
            ],

            {
                fill: "forwards",
                duration: durationsEmerging,
                // start the iteration where the first should have left off. This should put up where the easing function left off
                iterationStart:  easeReversalsEmerging(firstTravelsEmerging),
                // we only need to carry this aniamtion the rest of the way
                iterations: 1- easeReversalsEmerging(firstTravelsEmerging),
                // delay this animation until the first "meets" it
                delay: duration * easeReversalsEmerging(firstTravelsEmerging)
            }
        );
    }
    // save the new value so that the next iteration has a proper from keyframe
    currentPercentageStatesEmerging = percentagesEmerging;
}
// the following are just binding set ups for the buttons
$(document).ready(function () {
    animatesEmerging($('#Emerging').val());
});

