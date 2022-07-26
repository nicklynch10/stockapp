<x-guest-layout>

<meta property="og:title" content="PerkSweet | Tax Harvesting Platform">
<title>{{ appName(true) }} | Tax Harvesting Platform</title>
<meta property="og:description" content="Tax Harvesting Platform ">
<meta name="description" content="Tax Harvesting Platform">

{{--    @include('home.home-top')--}}

    <div class="home">
        <section class="ps-home-1405" aria-label="{{ appName(true) }} lets you easily say thank you, congrats, farewell, great job, and much more to your team.">
            <div class="ps-home-1405__bgContainer js-parallax"
                 style="height: 641.91px; transform: translate3d(0px, 0px, 0px);">
{{--                <div class="ps-home-1405__bg ps-home-1405__bg--mobile ps_color1_background"></div>--}}
                <div class="ps-home-1405__bg home_setup_desktop_4040 "
                     style="background-image: url('/home images/30.jpg'); opacity: 0.5;"></div>

                <div class="ps-home-1405__content">
                    <div class="bhrsection-padding pt-5 md:pt-20">
                        <div class="bhrsection-container-large bhrcolor-white">
                            <div class="ps-home-1405__container">
                                <h1 class="ps-home-1405__title typ-hero-header bhrtyp-italic text-gray-800"
                                    style="font-size: 40px; line-height: 50px; font-family: Montserrat, Lato, Arial, Helvetica, sans-serif;">
                                    Comprehensive Tax Harvesting Platform
                                </h1>

                                <div class="ps-home-1405__description typ-hero-subhead text-gray-800"
                                style=" font-weight: 700;
                                ">
                                    Easily harvest tax losses and realize excess returns across all your portfolios.
                                    What has historically been known as a premium investment strategy is now available to investors of any kind.

                                </div>

                               <div class="w-full text-center lg:text-left my-2 mb-3">
                                            <a class="Button" href="/register" >Get Started!</a>
                                </div>


                                <div class="ps-home-1405__form">
                                    @livewire('try-it-for-free')
                                </div>




                                <div class="ps-home-1405MobileCTA">

                                    <div class="ps-home-1405MobileCTA__btnContainer mt-6">
                                        <a class="ps-home-1405MobileCTA__btn Button Button--form js-open-modal"
                                           href="{{ url('/register') }}">
                                            Try it Free!
                                        </a>
                                    </div>

                                    <div class="ps-home-1405MobileCTA__btnContainer">
                                        @if(Auth::check())
                                            <a class="ps-home-1405MobileCTA__btn Button Button--form js-open-modal"
                                               href="/overview"
                                               style="background: #9CA3AF;">
                                               Go!
                                            </a>
                                        @else
                                            <a class="ps-home-1405MobileCTA__btn Button Button--form js-open-modal"
                                               href="/login"
                                               style="background: #9CA3AF;">
                                                Log In
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-home-1405__extra">
                <img class="js-banner-blank" src="./public_files/blank-hero.png">
            </div>
        </section>
        <section class="homeFeaturedLogos" arial-label="featured {{ appName(true) }} family logos">
            <div class="homeFeaturedLogos__curveContainer">
                <img class="homeFeaturedLogos__curve" src="/curves/curve1-gray-100.png" alt="featured logos">
            </div>
        </section>

        <div class="home-section-two homeRelative bhrcolor-white-background">
            <section class="homeOverview bg-gray-100" aria-label="How can {{ appName(true) }} help?" style="background: #F3F4F6;">
                <div class="homeOverview__curveContainer">
                    <img class="homeOverview__curve" data-src="/curves/curve2-gray-100.png"
                         alt="overview curve shape" src="/curves/curve2-gray-100.png">
                </div>
                <div class="bhrsection-padding homeOverview__overflow">
                    <div class="bhrsection-container-large pt-20 md:pt-10">
                        <div class="homeOverview__container js-in-viewport Animation--active">
                            <h3 class="typ bhrtyp-italic bhrtyp-center bhrcolor-gray12">
                                Following a consistent Tax-Loss Harvesting strategy translates to greater than 1.5% in annual excess returns over a long-term investment horizon. This increased return can be as high as 7% in the first year of a loss harvesting program.
                            </h3>
                            <div class="homeOverviewContent shadow-none">
                                <div class="lg:w-1/2 xl:w-4/5 w-full text-center mr-10 p-0 m-0 mb-10 md:mb-16 lg:mb-0">
                                <img class="m-auto w-full md:w-10/12 lg:w-full rounded-3xl" alt="{{ appName(true) }} Overview" src="/home images/29.jpg"
                                     data-src="/home images/3.png" style="border-radius: 20px;">
                                </div>
                                <!-- "/other/pink_sweater_v1.png" -->
                                <div class="homeOverviewContent__left Animation__toRight text-center lg:text-left">
                                    <p class="bhrcolor-gray9" style="font-size: 20px;">Tax-Loss Harvesting provides a way to transform investment losses directly into valuable tax-related savings.
                                        By proactively selling a stock for a loss, you gain the ability to write off this loss against employment or investment based income on your next tax return.
                                        Future tax bills are then lowered (or refunds are increased), providing additional savings and capital to invest back into the stock market.
                                    </p>
{{--                                        <div class="w-full text-center lg:text-left my-2 mb-3">--}}
{{--                                            <a class="Button" href="/register" >Sign Up!</a>--}}
{{--                                        </div>--}}


{{--                                        <div class="text-lg font-semibold w-full text-center lg:text-left my-2">30 days free with no credit card required!--}}
{{--                                        </div>--}}


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                        <section class="homeFeature bg-white" aria-label="Intuitive Rewards">
                <div class="bhrsection-container-large bhrsection-padding homeFeature__container relative top-20 z-50">

                    <div class="homeFeatureTitle homeFeatureTitle--hiring">
                        <h2 class="typ bhrtyp-italic bhrcolor-gray12 text-lg">{{ appName(true) }} helps manage every step of the Tax-Loss Harvesting process. </h2>
                    </div>

                    <div class="homeFeatureContent flex">
                        <div class="w-full lg:w-1/2 xl:w-4/5 text-center lg:mr-10 p-0 m-0 mb-10 md:mb-16 lg:mb-0 mt-6 lg:mt-0">
                        <img class="w-full md:w-10/12 lg:w-full m-auto -mt-12 rounded" alt="{{ appName(true) }} Overview" src="/home images/30.jpg"
                             data-src="/home images/3.png">
                        </div>
                        <div class="homeFeatureContentRight w-full md:w-10/12 lg:w-1/2  text-center lg:text-left" >
                            <p class="bhrcolor-gray12 homeFeatureContentRight__copy " style="font-size: 20px;">
                                Using {{ appName(true) }}, you can view which of your Equity Stocks, ETFs, and Mutual Funds are trading at a loss and are recommended sells based on {{ appName(true) }}’s harvesting calculation methodology.
                                <br><br>
                                By leveraging Plaid’s investment brokerage integration, all of your real-time positions will be directly linked into the {{ appName(true) }} platform. {{ appName(true) }} then offers a proprietary {{ appName(true) }} Similarity Score to suggest replacement positions that will allow you to closely maintain your pre-trade portfolio allocation.

                            </p>
{{--                            <div class="homeFeatureContentRightLinks my-2">--}}

{{--                                            <a class="Button bg-pink-400 m-auto lg:m-0"--}}
{{--                                            style="background: #1E3A8A;"--}}
{{--                                            href="/rewards-process">Learn More</a>--}}
{{--                            </div>--}}
                        </div>
                    </div>




                </div>
                <div class="h-96"></div>
            </section>



            <div class="WaveTop WaveTop--onboarding">
                <img class="WaveTop__image" data-src="/curves/curve5-blue-50.png" alt="leaf"
                     src="/curves/curve5-blue-50.png">
            </div>




            <section class="homeFeature homeFeature--onboarding"
                     style="    background: linear-gradient(180deg, #EFF6FF, #BFDBFE);

             padding-bottom: 30px;">
                <div class="bhrsection-container-large bhrsection-padding homeFeature__container relative top-14 md:top-20 xl:top-0">
                    <div class="homeFeatureTitle homeFeatureTitle--onboarding">
                        <h2 class="typ italic bhrcolor-gray12">“Harvesting losses is a well-established mechanism for reducing tax liability. Doing so is a technically onerous task as it requires frequent monitoring, execution, and care to avoid washsale trades.”</h2>
                    </div>
                    <div class="homeFeatureContent">
                        <div class="w-full lg:w-1/2 xl:w-4/5 text-center lg:mr-10 p-0 m-3 mb-10 md:mb-16 lg:mb-0 mt-6 lg:mt-0">
                            <img class="w-full md:w-10/12 lg:w-full m-auto -mt-12" src="/home images/28.jpg" data-src="/home images/28.jpg"
                             style="">


                        </div>

                        <div class="homeFeatureContentRight w-full md:w-10/12 lg:w-1/2  text-center lg:text-left">
                            <p class="bhrcolor-gray12 homeFeatureContentRight__copy" style="font-size: 20px;">
                                This is no longer the case with {{ appName(true) }}. Tax-Loss Harvesting has historically been a premium investment strategy, but these valuable benefits can now be recognized by investors of any size and experience level with minimal effort.
                                <br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="homeFeature__image homeFeature__image--center bhrsection-padding">
                    <!--                <img class="lazyloaded -mt-24" src="/scenes/rest-1.png" data-src="/scenes/rest-1.png"

                style="height: 450px;"> -->
                    <div class="h-24"></div>
                </div>
            </section>



             <div class="Wave WaveBottom WaveBottom--onboarding">
                <img class="WaveBottom__image ls-is-cached" data-src="/curves/curve6-white.png"
                     alt="bottom leaf" src="/curves/curve6-white.png">
            </div>



            <section class="homeQuote" aria-label="{{ appName(true) }} customer quote">
                <div class="homeQuote__container bhrsection-padding">
                    <p class="italic text-gray-900 font-semibold text-2xl mb-2">“We have simulated returns for 500 assets over 25 years to examine the benefits of loss harvesting for taxable portfolios, and found a huge advantage over the passive case. By rigorously realizing losses, the median portfolio would add about 27% compared to a pure buy and hold strategy in typical market conditions… It’s a reliable, predictable source of after-tax alpha.”</p>
                </div>
            </section>

            @include('home.trial-bottom')
        </div>
    </div>
    </div>

    <!-- ///////////////////////// Nick Css -->
    <style type="text/css">
        /*.ps_color1_background {*/
        /*    background: #22c55e;*/
        /*}*/

        /*.Button {*/
        /*    background-color: #22c55e;*/
        /*}*/

        /* .Button--stroke {*/
        /*    background-color: #F472B6;*/
        /*    color: white;*/
        /*    border: 2px solid #F472B6;*/
        /*}*/

        /*.homeFeaturedLogos__img {*/
        /*    width: 80%;*/
        /*}*/

        /*.NavbarMain__tabWrap:hover {*/
        /*    color: #22c55e;*/
        /*    border-color: #22c55e;*/
        /*}*/

        /*.NavbarMobile__topBar {*/
        /*    background-color: white;*/
        /*    border-bottom: 3px solid #3B82F6;*/
        /*}*/


        /*.ps-home-1405__bgContainer {
        position: relative;
        top: 70px;
        right: 0;
        left: 0;
        min-height: 710px;
    }*/

        @media screen and (max-width: 1022px) {
            .ps-home-1405__bgContainer {
                top: 0;
            }
        }

        .NavbarDrop__link {
            padding: 20px 0 20px 45px;

        }

        .NavbarDrop__link--first {
            padding-top: 50px;
        }

        /*@media screen and (min-width: 1024px){}
    .ps-home-1405__extra {
        position: relative;
        min-height: 50px;
        height: 50px;

    }
    }*/


        @media screen and (min-width: 600px) {
            .ps-home-1405__bg--mobile {
                background-image: url('/other/mountain-crop4.png');
                background-position: center;
            }
        }

        .ps-home-1405__bg--mobile {
            background-image: url('/other/mountain-crop4.png');
            background-position: 50% 20%;
        }


        .NavbarDrop__linkWrap:hover .NavbarDrop__link {
            color: #22c55e;
        }

        .home-end-person {
            height: 175px;
        }

        @media screen and (min-width: 1100px) {
            .home-end-person {
                height: 225px;
            }

            @media screen and (min-width: 1300px) {
                .home-end-person {
                    height: 275px;
                }
            }


            .homeFeaturedLogos__bottom {
                background-color: #F3F4F6;
            }

            .homeOverview {
                background-color: #F3F4F6;
            }
            }

        @media only screen
        and (device-width: 375px)
        and (device-height: 812px)
        and (-webkit-device-pixel-ratio: 3) {
            .homeOverview__container{
                padding-bottom:0px !important;
            }
            .top-space{
                height: 0rem !important;
            }
            .WaveBottom__image{
                margin-top: 0px !important;
            }
            .top-space-create{
                height: 6rem ;
            }
            .homeFeature--culture{
                padding-bottom: 70px;
            }
        }

    </style>
</x-guest-layout>
