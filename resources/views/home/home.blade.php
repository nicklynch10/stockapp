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
                     style="background-image: url('/home images/30.jpg')"></div>

                <div class="ps-home-1405__content">
                    <div class="bhrsection-padding pt-5 md:pt-20">
                        <div class="bhrsection-container-large bhrcolor-white">
                            <div class="ps-home-1405__container">
                                <h1 class="ps-home-1405__title typ-hero-header bhrtyp-italic text-gray-800"
                                    style="font-size: 40px; line-height: 50px; font-family: Montserrat, Lato, Arial, Helvetica, sans-serif;">
                                   Tax Harvesting Platform
                                </h1>

                                <div class="ps-home-1405__description typ-hero-subhead text-gray-800"
                                style=" font-weight: 700;
                                ">
                                {{ appName(true) }} enables users to easily tax loss harvest within all accounts

                                </div>

                               <div class="w-full text-center lg:text-left my-2 mb-3">
                                            <a class="Button" href="/register" >Get Started!</a>
                                </div>



                                <div class="bhrForm bhrForm--inline2 js-bhrForm mt-8" id="js-homepage-signup"
                              aria-label="Try {{ appName() }} free form" __bizdiag="96619420"
                              __biza="WJ__">
                            <div class="bhrForm__left">
                                <div class="bhrForm__inputWrapper">
                                    <input type="email" wire:model="email" wire:keydown.enter="sendMail"
                                           class="bhrForm__input js-bhrForm-input js-bhrForm-email bg-white"
                                           id="bhrform-email"
                                           aria-label="Enter your email here to try {{ appName() }} free">
                                    <label for="bhrform-email" class="bhrForm__label js-bhrForm-label">Email Address</label>
                                </div>
                            </div>

                            <div class="bhrForm__right">
                                <button class="ps_color1_background bhrcolor-white bhrForm__submit" aria-label="Click here to submit the form">
                                    Submit!
                                </button>
                            </div>
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
                            <h3 class="typ-section-header bhrtyp-italic bhrtyp-center bhrcolor-gray12">Boost After Tax Returns by over 2%</h3>
                            <div class="typ-subhead1 bhrtyp-center bhrcolor-gray9">How can {{ appName(true) }} help?</div>
                            <div class="homeOverviewContent shadow-none">
                                <div class="lg:w-1/2 xl:w-4/5 w-full text-center mr-10 p-0 m-0 mb-10 md:mb-16 lg:mb-0">
                                <img class="m-auto w-full md:w-10/12 lg:w-full rounded-3xl" alt="{{ appName(true) }} Overview" src="/home images/3.png"
                                     data-src="/home images/3.png" style="border-radius: 20px;">
                                </div>
                                <!-- "/other/pink_sweater_v1.png" -->
                                <div class="homeOverviewContent__left Animation__toRight text-center lg:text-left">
                                    <h2 class="typ-title1 bhrcolor-gray12">Continuous Tax Loss Harvesting</h2>
                                    <p class="bhrcolor-gray9">{{ appName(true) }} tracks your brokerage accounts to identify opportunities to harvest losses and stay invested.
                                        <br><br>
                                        Tax-loss harvesting is a rules-based approach used by financial advisors and robo-advisors use to delay taxes on investment returns as long as possible – therefore creating a higher after-tax return.

                                    </p>
                                        <div class="w-full text-center lg:text-left my-2 mb-3">
                                            <a class="Button" href="/register" >Sign Up!</a>
                                        </div>


                                        <div class="text-lg font-semibold w-full text-center lg:text-left my-2">30 days free with no credit card required!
                                        </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                        <section class="homeFeature bg-white" aria-label="Intuitive Rewards">
                <div class="bhrsection-container-large bhrsection-padding homeFeature__container relative top-20 z-50">

                    <div class="homeFeatureTitle homeFeatureTitle--hiring">
                        <h2 class="typ-stats bhrtyp-italic text-blue-900">Suggest Comparable Stocks / ETFs for Swapping</h2>
                    </div>

                    <div class="homeFeatureContent flex">
                        <div class="w-full lg:w-1/2 xl:w-4/5 text-center lg:mr-10 p-0 m-0 mb-10 md:mb-16 lg:mb-0 mt-6 lg:mt-0">
                        <img class="w-full md:w-10/12 lg:w-full m-auto -mt-12 shadow-xl rounded" alt="{{ appName(true) }} Overview" src="/home images/3.png"
                             data-src="/home images/3.png">
                        </div>
                        <div class="homeFeatureContentRight w-full md:w-10/12 lg:w-1/2  text-center lg:text-left">
                            <p class="text-blue-800 homeFeatureContentRight__copy">
                                {{ appName(true) }} will suggest similar stocks or ETFs based on correlation, sector, size, risk profile and geography in order to maintain a similar exposure to harvested stocks.
                             <br><br>Avoid wash sales when tax-loss harvesting on multiple brokerage accounts
.
                            </p>
                            <div class="homeFeatureContentRightLinks my-2">

                                            <a class="Button bg-pink-400 m-auto lg:m-0"
                                            style="background: #1E3A8A;"
                                            href="/rewards-process">Learn More</a>
                            </div>
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
                        <h2 class="typ-stats italic text-blue-500">Tax Efficient Rebalancing</h2>
                    </div>
                    <div class="homeFeatureContent">
                        <div class="w-full lg:w-1/2 xl:w-4/5 text-center lg:mr-10 p-0 m-3 mb-10 md:mb-16 lg:mb-0 mt-6 lg:mt-0">
                            <img class="w-full md:w-10/12 lg:w-full m-auto -mt-12" src="/home images/3.png" data-src="/home images/3.png"
                             style="">


                        </div>

                        <div class="homeFeatureContentRight w-full md:w-10/12 lg:w-1/2  text-center lg:text-left">
                            <p class="text-blue-700 homeFeatureContentRight__copy">
                               Tax efficiently rebalance portfolios with as much customization as desired.
<br><br>
Take advantage of tax optimization suggestions not typically provided by robo-advisors (preferred dividends, optimal allocations, foreign withholdings, ect.).
                                <br>

                                            <a class="Button bg-pink-400 m-auto lg:mx-0 mb-4 mt-2" target="__blank" href="/group-card-example">View Full Example</a> <br>
                                <span class="font-semibold">{{ appName(true) }} will remind you of co-workers birthdays and work anniversaries in advance!</span>
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
                    <p class="italic text-gray-900 font-semibold text-xl mb-2">[Proven >2% increase to after tax returns]</p>
                    <p class="text-gray-900 italic text-sm mt-0"><a href="https://www.gallup.com/workplace/236441/employee-recognition-low-cost-high-impact.aspx" target="_blank">According to [Authors on academic journal]</a></p>
                </div>
            </section>




  <div class="WaveTop">
                <img class="WaveTop__image" data-src="/curves/curve3-pink.png" src="/curves/curve3-pink.png">
            </div>





    <section class="homeFeature homeFeature--hiring" aria-label="Collaborative Teams"
                     style="background: linear-gradient(#e5ffe6,#e5ffe6, #f1fff8, #f1fff8);">
                <div class="bhrsection-container-large bhrsection-padding homeFeature__container relative top-20 z-50">

                    <div class="homeFeatureTitle homeFeatureTitle--hiring">
                        <h2 class="typ-stats bhrtyp-italic text-green-600">Monitor Factor Exposure</h2>
                    </div>

                    <div class="homeFeatureContent flex">
                        <div class="w-full lg:w-1/2 xl:w-4/5 text-center lg:mr-10 p-0 m-0 mb-10 md:mb-16 lg:mb-0 mt-6 lg:mt-0">
                        <img class="w-full md:w-10/12 lg:w-full m-auto -mt-12" alt="{{ appName(true) }} Overview" src="/screenshots/factors1.png"
                             data-src="/screenshots/factors1.png">
                        </div>
                        <div class="homeFeatureContentRight w-full md:w-10/12 lg:w-1/2  text-center lg:text-left">
                            <p class="text-green-600 homeFeatureContentRight__copy">
                                Finding the time to engage with coworkers can be challenging. {{ appName(true) }} can help!<br><br> With our opt-in seamless one-on-one scheduling system, employees will have the opportunity to grow existing connections and facilitate new ones.
                            </p>
                             <div class="homeFeatureContentRightLinks my-2">

                                            <a class="Button bg-green-400 m-auto lg:m-0"
                                            style="background:#22c55e;"

                                            href="/">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-32"></div>
            </section>







             <div class="Wave WaveBottom WaveBottom--hiring">
                <img class="WaveBottom__image" data-src="/curves/curve4-pink-100.png" alt="leaf"
                     src="/curves/curve4-pink-100.png"
                     style="margin-top:30px;">
            </div>

               <section class="homeQuote" style="padding: 5% 0 5%;">
                <div class="homeQuote__container bhrsection-padding">
                    <p class="italic text-gray-900 text-xl mb-2">[ quote about maintaining factor exposure improves returns</p>
                    <p class="text-gray-900 italic text-sm mt-0">According to [TBD]</p>
                </div>
            </section>



            <div class="WaveTop WaveTop--onboarding"
            style="margin-top:2%;">
          <!--       <img class="WaveTop__image" data-src="/curves/curve5-blue-50.png" alt="leaf"
                     src="/curves/curve5-blue-100.png">
            </div> -->




            <section class="homeFeature homeFeature--compensation" aria-label="Collaborative Teams"
            style="
            background: #DBEAFE;
             padding-top: 50px;
             padding-bottom: 30px;">

            <!--  background: linear-gradient(180deg, white, #DBEAFE); -->
<!--                 <div class="bhrsection-container-large bhrsection-padding homeFeature__container">
                    <div class="homeFeatureTitle homeFeatureTitle--compensation">

                        <h2 class="typ-stats bhrtyp-italic text-blue-600 md:pt-10 lg:pt-20">Collaborative Teams</h2>
                    </div>
                    <div class="homeFeatureContent md:pb-10 lg:pb-20">
                        <div class="w-full lg:w-1/2 xl:w-4/5 text-center lg:mr-10 p-0 m-0 mb-10 md:mb-16 lg:mb-0 mt-6 lg:mt-0">
                            <img class="lazyloaded -mt-12" src="/home images/3.png" data-src="/home images/3.png"
                             style="">
                        </div>
                        <div class="homeFeatureContentRight w-full md:w-10/12 lg:w-1/2">
                            <p class="text-blue-700 homeFeatureContentRight__copy  text-center lg:text-left">
                                {{ appName(true) }} knows collaboration is a key driver of success and it takes a full team to make miracles happen. {{ appName(true) }} teams are a central part of the platform and building a team is simple. Anyone can do it. <br><br>Whether you are a leader, observer, idea generator, or just looking to follow along for the ride, {{ appName(true) }} teams are built to help you.

                            </p>
                            <div class="homeFeatureContentRightLinks">

                            </div>
                        </div>
                    </div>


                </div>
                <div class="h-52 top-space-create"></div> -->
            </section>
            <div class="WaveTop bg-white">
                <img class="WaveTop__image lazyloaded"
                      src="/curves/product-top-gray.png">
            </div>
            <section class="homeFeature py-20 md:py-10" aria-label="Create an Inclusive Culture"
            style="    background: linear-gradient(180deg, #F3F4F6, #F3F4F6);">
                <div class="bhrsection-container-large bhrsection-padding homeFeature__container">
                    <div class="homeFeatureTitle homeFeatureTitle--culture">

                        <h2 class="typ-stats bhrtyp-italic text-gray-600">Create an Inclusive Culture</h2>
                    </div>
                    <div class="homeFeatureContent">

                        <div class="">
                            <p class="text-gray-600 m-auto sm:w-10/12 lg:w-1/2 text-center lg:-mt-12">
                                Your company is an everchanging and growing organism built by your amazing people. Our
                                employee rewards platform is built to allow your employees the opportunity to foster
                                connections and show genuine appreciation. In order to create an inclusive company
                                culture, you need to understand each and every employee.<br><br> Whether remote or in person,
                                {{ appName(true) }} can provide them with a voice and allow you to get to know the people that
                                matter most in your company.
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-16">
                        <img class="m-auto home-end-person" alt="{{ appName(true) }} Overview" src="/home images/3.png"
                             data-src="/home images/3.png" defer>
                    </div>

                </div>
            </section>

            <div class="Wave WaveBottom" style="margin: auto;">
                <img class="WaveBottom__image ls-is-cached lazyloaded" data-src="/curves/curve6-gray.png" src="/curves/curve6-gray.png">
            </div>


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
