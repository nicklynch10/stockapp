<header class="bg-white Navbar js-nav" role="navigation">
    <style type="text/css">
        .ps_color1_background {
            background: #22c55e;
        }

        .Button {
            background-color: #22c55e;
        }

        .Button--stroke {
            background-color: #F472B6;
            color: white;
            border: 2px solid #F472B6;
        }

        .homeFeaturedLogos__img {
            width: 80%;
        }

        .NavbarMain__tabWrap:hover {
            color: #22c55e;
            border-color: #22c55e;
        }

        .NavbarMobile__topBar {
            background-color: white;
            border-bottom: 3px solid #3B82F6;
        }
    </style>
    <div class="Navbar__container js-nav-main">
        <div class="NavbarMain">
            <div class="NavbarMain__left NavbarMain__wrapper NavbarMain__wrapper--left js-nav-logo">


                <a class="NavbarMain__logoWrapper" href="{{url('/')}}">
                    <x-jet-application-mark :defaultLogo="true" />
                </a>


            </div>
            <div class="text-gray-600 NavbarMain__middle NavbarMain__wrapper NavbarMain__wrapper--middle"
            style="padding-right: 5px;
            margin-right: 5px;
            width: auto;">
                <div class="NavbarMain__tabContainer">
                    <div class="ps_nav_tab_wrap ps_nav_open_drop_push">
                        <div class="NavbarMain__tab">Our Platform</div>
                        <ul class="bg-gray-100 custom-nav-bg-gray NavbarDrop NavbarDrop--2 js-nav-drop-block">
                            <div
                                class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--2 NavbarDrop2--default ps-nav-drop2495-block-def-two">
                                <div
                                    class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--default ps-nav-4945-info-5iti-block-def-three">
                                    <h4 class="text-gray-900 NavbarDrop2__infoHeading">Our Platform</h4>
                                    <p class="text-gray-900 NavbarDrop2__info">Learn how {{ appName(true) }} helps build amazing
                                        teams.</p>
                                </div>
                            </div>
                            <li class="bg-white NavbarDrop__linkWrap NavbarDrop__linkWrap--2 js-nav-drop2-block-opener">
                                <a class="text-gray-500 NavbarDrop__link NavbarDrop__link--first NavbarDrop__link--noArrow"
                                   href="{{url('rewards-process')}}">Continuous Tax Loss Harvesting</a>
                                <div
                                    class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--small js-nav-drop2-block">
                                    <div class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--small js-nav-info-block">
                                        <h4 class="text-gray-900 NavbarDrop2__infoHeading">Tax-Loss Harvesting Across Multiple Brokerages</h4>
                                        <p class="text-gray-900 NavbarDrop2__info">Automatically monitors investment holdings to identify loss harvesting opportunities.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="bg-white NavbarDrop__linkWrap NavbarDrop__linkWrap--2 js-nav-drop2-block-opener">
                                <a class="text-gray-500 NavbarDrop__link NavbarDrop__link--noArrow"
                                   href="{{url('group-cards')}}">Identify Stock Swap Candidates</a>
                                <div
                                    class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--small js-nav-drop2-block">
                                    <div class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--small js-nav-info-block">
                                        <h4 class="text-gray-900 NavbarDrop2__infoHeading">Identify Stock Swap Candidates</h4>
                                        <p class="text-gray-900 NavbarDrop2__info"> {{ appName(true) }} will suggest similar stocks or ETFs based on correlation, sector, size, risk profile and geography in order to maintain a similar exposure to harvested stocks.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="bg-white NavbarDrop__linkWrap NavbarDrop__linkWrap--2 js-nav-drop2-block-opener">
                                <a class="text-gray-500 NavbarDrop__link NavbarDrop__link--noArrow"
                                   href="{{url('perksweet-connect')}}">Monitor Factor Exposure</a>
                                <div
                                    class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--small js-nav-drop2-block">
                                    <div class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--small js-nav-info-block">
                                        <h4 class="text-gray-900 NavbarDrop2__infoHeading">Monitor Risk Factor Exposure</h4>
                                        <p class="text-gray-900 NavbarDrop2__info">{{ appName(true) }} tracks exposure to various risk factors over time. Risk factors include growth/value, momentum, company size, volatility, and geography. </p>
                                    </div>
                                </div>
                            </li>
                            <!-- <li class="bg-white NavbarDrop__linkWrap NavbarDrop__linkWrap--2 js-nav-drop2-block-opener NavbarDrop__linkWrap--last">
                                <a class="text-gray-500 NavbarDrop__link NavbarDrop__link--noArrow"
                                   href="{{url('pricing')}}">Pricing</a>
                                <div
                                    class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--small js-nav-drop2-block">
                                    <div class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--small js-nav-info-block">
                                        <h4 class="text-gray-900 NavbarDrop2__infoHeading">Pricing</h4>
                                        <p class="text-gray-900 NavbarDrop2__info">Straight forward pricing structure
                                            with no surprise fees and zero commitment. Allows you to reward the
                                            wonderful people at your company who deserve it most.</p>
                                    </div>
                                </div>
                            </li> -->

                        </ul>
                    </div>


                    <div class="ps_nav_tab_wrap ps_nav_open_drop_push" >
                        <div class="NavbarMain__tab">Tax Optimization</div>
                        <ul class="bg-gray-100 custom-nav-bg-gray NavbarDrop NavbarDrop--2 js-nav-drop-block">
                            <div
                                class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--2 NavbarDrop2--default ps-nav-drop2495-block-def-two">
                                <div
                                    class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--default ps-nav-4945-info-5iti-block-def-three">
                                    <h4 class="text-gray-900 NavbarDrop2__infoHeading">Tax Optimization</h4>
                                    <p class="text-gray-900 NavbarDrop2__info">A few good reasons to choose {{ appName(true) }} for tax optimizing your portfolio.</p>
                                </div>
                            </div>
                            <li class="bg-white NavbarDrop__linkWrap NavbarDrop__linkWrap--2 js-nav-drop2-block-opener">
                                <a class="text-gray-500 NavbarDrop__link NavbarDrop__link--first NavbarDrop__link--noArrow"
                                   href="{{url('appreciation')}}">Tax-Loss Harvesting</a>
                                <div
                                    class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--small js-nav-drop2-block">
                                    <div class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--small js-nav-info-block">
                                        <h4 class="text-gray-900 NavbarDrop2__infoHeading">Show
                                            Appreciation</h4>
                                        <p class="text-gray-900 NavbarDrop2__info">Tax-loss harvesting is a proven way to increase after-tax returns by over 2% annually</p>
                                    </div>
                                </div>
                            </li>

                            <li class="bg-white NavbarDrop__linkWrap NavbarDrop__linkWrap--2 js-nav-drop2-block-opener">
                                <a class="text-gray-500 NavbarDrop__link NavbarDrop__link--noArrow"
                                   href="{{url('inclusion')}}">Efficient Rebalancing</a>
                                <div
                                    class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--small js-nav-drop2-block">
                                    <div class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--small js-nav-info-block">
                                        <h4 class="text-gray-900 NavbarDrop2__infoHeading">Tax Efficient Portfolio Rebalancing</h4>
                                        <p class="text-gray-900 NavbarDrop2__info">The {{ appName(true) }} platform enables you to understand the impacts of portfolio rebalancing on your taxes  </p>
                                    </div>
                                </div>
                            </li>
                           <li class="bg-white NavbarDrop__linkWrap NavbarDrop__linkWrap--2 js-nav-drop2-block-opener rounded-b-xl" style="padding-bottom:90px;">
                                <a class="text-gray-500 NavbarDrop__link NavbarDrop__link--noArrow"
                                   href="{{url('reduce-turnover')}}">Monitor Taxable Gains / (Losses)</a>
                                <div
                                    class="bg-gray-100 custom-nav-bg-gray NavbarDrop2 NavbarDrop2--small js-nav-drop2-block" style="padding-bottom:100px;">
                                    <div class="NavbarDrop2__infoWrap NavbarDrop2__infoWrap--small js-nav-info-block ">
                                        <h4 class="text-gray-900 NavbarDrop2__infoHeading">Monitor Taxable Gains / (Losses)</h4>
                                        <p class="text-gray-900 NavbarDrop2__info">Offset investment gains to limit your year-end tax bill.</p>
                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>


                    <div class="ps_nav_tab_wrap ps_nav_open_drop_push">
                        <a class="NavbarMain__tab" href="/check-for-comps">Find Similar Stocks</a>

                    </div>


                              <div class="ps_nav_tab_wrap ps_nav_open_drop_push">
                        <a class="NavbarMain__tab" href="/factors">Factor Analysis</a>

                    </div>


                </div>
            </div>

            <div class="NavbarMain__wrapper NavbarMain__wrapper--right">

                 <a class="text-center Button Button--small NavbarMain__link NavbarMain__link--button"
                   href="{{url('register')}}" style="margin-right: 10px;">Try It Free</a>
                @if(Auth::check())
                    <a class="text-center Button Button--stroke Button--small NavbarMain__link js-nav-login"
                    style="background-color: #9CA3AF;
            border: 2px solid #9CA3AF;"
                       href="{{url('kudos-feed')}}" aria-label="Click to Go">Go!</a>
                @else
                    <a class="text-center Button Button--stroke Button--small NavbarMain__link js-nav-login"
                    style="background-color: #9CA3AF;
            border: 2px solid #9CA3AF;"
                       href="{{url('login')}}" aria-label="Click to login">Log In</a>
                @endif

            </div>
        </div>
    </div>
    </div>
    <div class="NavbarMobileBar js-nav-mobile-bar dynamic-nav-padding-bottom">
        <div class="NavbarMobileBar__container">


            <a class="NavbarMobileBar__logoLink" href="{{url('/')}}">
                <x-jet-application-mark :defaultLogo="true" />
            </a>

            <!--
                            <div class="NavbarMobileBar__searchIcons">
                                <img class="NavbarMobileBar__searchIcon NavbarMobileBar__searchIcon--default js-nav-mobile-search-selector" src="./public_files/search-icon-gray-min.svg" alt="">
                                <img class="NavbarMobileBar__searchIcon NavbarMobileBar__searchIcon--active js-nav-mobile-search-selector-active" src="./public_files/search-icon-green-min.svg" alt="" style="display: none;">
                            </div>
             -->
            <svg class="NavbarMobileBar__hamburgerIcon js-nav-mobile-opener" width="30" height="30" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentcolor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="4" y1="6" x2="20" y2="6"/>
                <line x1="4" y1="12" x2="20" y2="12"/>
                <line x1="4" y1="18" x2="20" y2="18"/>
            </svg>
            {{--                <img class="NavbarMobileBar__hamburgerIcon js-nav-mobile-opener" src="./public_files/menu-icon.svg" alt="Open Menu" tabindex="0">--}}
        </div>
    </div>
</header>


<div class="NavbarMobile js-nav-mobile" aria-label="Mobile navigation" role="navigation">
    <div class="NavbarMobile__topBar">

        <a href="{{url('/')}}">
            <x-jet-application-mark :defaultLogo="true" />
        </a>
        <div class="js-nav-mobile-closer text-4xl cursor-pointer" alt="Close menu" tabindex="0">
            <svg class="" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentcolor" fill="none"
                 stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </div>


    </div>
    <div class="NavbarMobile__wrapper">
        <ul class="NavbarMobile__container">
            <li class="NavbarMobile__linkWrap js-nav-level-1">
                <a class="NavbarMobile__link NavbarMobile__link--expandArrow js-nav-level-2-opener">Our Platform</a>
            </li>
            <div class="NavbarMobile__extend js-nav-level-2">
                <ul class="NavbarMobile__links">
                    <li class="NavbarMobile__linkWrap js-nav-hide-on-level-3">
                        <a class="NavbarMobile__link NavbarMobile__link--backBtn js-nav-back-to-level-1">Back</a>
                    </li>
                    <li class="NavbarMobile__linkWrap js-nav-hide-on-level-3">
                        <a class="NavbarMobile__link NavbarMobile__link--extend NavbarMobile__link--expandArrow js-nav-level-3-opener"
                           href="{{url('rewards-process')}}">Seamless Rewards Process</a>
                    </li>
                    <li class="NavbarMobile__linkWrap js-nav-hide-on-level-3">
                        <a class="NavbarMobile__link NavbarMobile__link--extend NavbarMobile__link--expandArrow js-nav-level-3-opener"
                           href="{{url('group-cards')}}">Robust Group Card Solution</a>
                    </li>
                    <li class="NavbarMobile__linkWrap js-nav-hide-on-level-3">
                        <a class="NavbarMobile__link NavbarMobile__link--extend NavbarMobile__link--expandArrow js-nav-level-3-opener"
                           href="{{url('perksweet-connect')}}">Opt-in Automated Networking Capability</a>
                    </li>
                    <li class="NavbarMobile__linkWrap js-nav-hide-on-level-3">
                        <a class="NavbarMobile__link NavbarMobile__link--extend NavbarMobile__link--expandArrow js-nav-level-3-opener"
                           href="{{url('pricing')}}">Pricing</a>
                    </li>
                </ul>
            </div>
            <li class="NavbarMobile__linkWrap js-nav-level-1">
                <a class="NavbarMobile__link NavbarMobile__link--expandArrow js-nav-level-2-opener">Why {{ appName(true) }}</a>
            </li>
            <div class="NavbarMobile__extend js-nav-level-2">
                <ul class="NavbarMobile__links">
                    <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--backBtn js-nav-back-to-level-1">Back</a>
                    </li>
                    <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--extend" href="{{url('appreciation')}}">Show
                            Appreciation</a>
                    </li>
                    <!-- <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--extend" href="{{url('stay-connected')}}">Stay
                            Connected</a>
                    </li> -->
                    <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--extend" href="{{url('inclusion')}}">Create an
                            Inclusive Culture</a>
                    </li>

                     <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--extend" href="{{url('reduce-turnover')}}">Create an
                            Lower Voluntary Turnover</a>
                    </li>
                </ul>
            </div>
            <li class="NavbarMobile__linkWrap js-nav-level-1">
                <a class="NavbarMobile__link NavbarMobile__link--expandArrow js-nav-level-2-opener">About {{ appName(true) }}</a>
            </li>
            <div class="NavbarMobile__extend js-nav-level-2">
                <ul class="NavbarMobile__links">
                    <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--backBtn js-nav-back-to-level-1">Back</a>
                    </li>
                    <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--extend" href="{{url('about')}}">About
                            {{ appName(true) }}</a>
                    </li>
                    <li class="NavbarMobile__linkWrap">
                        <a class="NavbarMobile__link NavbarMobile__link--extend" href="{{url('contact')}}">Contact</a>
                    </li>
                </ul>
            </div>
            <li class="NavbarMobile__linkWrap js-nav-level-1">
                <a href="https://blog.perksweet.com" class="NavbarMobile__link">Blog</a>
            </li>
        </ul>
    </div>
    <div class="NavbarMobile__bottom  sm:-mt-80 xs:-mt-28" style="z-index: 100;margin-top: -130px">
        <div class="w-full m-auto text-center" style="z-index: 100;">
        <!--  <a class="Button Button--stroke Button--small NavbarMobile__signupBtn" href="https://meetings.salesmate.io/meetings/#/perksweet/scheduler/perksweet-with-craig" target="_blank">
            Book a Demo
        </a> -->

        <a class="Button Button--small NavbarMobile__signupBtn" href="{{url('register')}}">
            Try It Free
        </a>
            @if(Auth::check())
                <a class="Button Button--stroke Button--small NavbarMobile__signupBtn"
                   style="background-color: #9CA3AF;
            border: 2px solid #9CA3AF;"
                   href="{{url('kudos-feed')}}" aria-label="Click to Go">Go!</a>
            @else
                <a class="Button Button--stroke Button--small NavbarMobile__signupBtn" href="{{url('login')}}"
                   style="background-color: #9CA3AF;
            border: 2px solid #9CA3AF;">
                    Log In
                </a>
            @endif


        </div>
    </div>
</div>
