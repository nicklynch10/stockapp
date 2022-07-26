<x-home-layout>

    <x-slot name="bg_url">
        /home images/29.jpg
    </x-slot>


    <div class="theme-page">
        <x-slot name="section1">

            <div class="py-20 xl:py-32">
                <h1 class="homeHero__title typ-hero-header bhrtyp-italic text-gray-900"
                    style="font-size: 60px; line-height: 55px; text-align: center;">Learn More</h1>
{{--                <div class="typ-subhead1 bhrtyp-center text-gray-700">Intuitive, engaging, and collaborative rewards--}}
{{--                    process--}}
{{--                    with select incentives to show employees you value them beyond a paycheck.--}}
{{--                </div>--}}
            </div>

        </x-slot>




        <x-slot name="section2">

            <div class="homeFeatureTitle homeFeatureTitle--hiring">
                <h2 class="typ-stats bhrtyp-italic text-gray-900 pt-20">What is Tax Loss Harvesting?</h2>
            </div>

            <div class=" shadow-none flex flex-wrap">
{{--                <div class="md:w-1/2 w-full text-center p-0 m-0 mb-10 md:mb-16 lg:mb-0">--}}
{{--                    <img class="w-auto m-auto mt-12 shadow-xl rounded " alt="{{ appName(true) }} Overview" src="/other/screenshots/kudos-create.png"--}}
{{--                         data-src="/other/screenshots/kudos-create.png"--}}
{{--                         style="">--}}
{{--                </div>--}}

                <!-- "/other/pink_sweater_v1.png" -->
                <div class="Animation__toRight p-2 px-4 lg:ml-24">
                    <p class="text-gray-700">
                        Tax-Loss Harvesting provides a way to transform investment losses directly into valuable tax-related savings.
                        By proactively selling a stock for a loss, you gain the ability to write off this loss against employment or investment-based income on your next tax return.
                        Future tax bills are then lowered (or refunds are increased), providing additional savings and capital to invest back into the stock market.
                    <br>

                     <p class="text-gray-700 mb-20">
                        Using {{appName(true)}}, you can view which of your Equity Stocks, ETFs, and Mutual Funds are trading at a loss and are recommended sells based on {{appName(true)}}’s harvesting calculation methodology.
                        {{appName(true)}} then offers a proprietary {{appName(true)}} Similarity Score to suggest replacement positions that will allow you to closely maintain your pre-trade portfolio allocation.
                    </p>
                </div>
            </div>

        </x-slot>


        <x-slot name="header3">

            <div class="homeFeatureTitle homeFeatureTitle--hiring">
                <h2 class="typ-stats bhrtyp-italic text-gray-600 pt-20">How does it work?</h2>
            </div>
        </x-slot>


        <x-slot name="section3">



            <div class="homeFeatureContent flex pb-16">

                <div class="w-full ">
                    <p class="text-gray-800 homeFeatureContentRight__copy">
                        By using Plaid to securely integrate your real-time holdings from the world’s largest brokers and investment platforms (such as Robinhood, Fidelity, Schwab, Vanguard, and more), positions are tracked automatically within {{appName(true)}} and no manual intervention is needed from the user.
                        Realizing savings from {{appName(true)}} is as easy as creating a login, selecting your investment accounts, and following {{appName(true)}}’s automated guidance to determine which positions should be sold and replaced.
                    </p>
                    <p class="text-gray-800">
                        Based on IRS guidelines, you must not reinvest in the original security that was sold at a loss for 30 days if you wish to recognize the loss on your tax returns.
                        Once that 30 day period has passed, {{appName(true)}} will provide you with an overview of how your replacement selection performed, as well as alert you of the option to move back into your original position.
                    </p>
                    <p class="text-gray-800">
                        Tax-Loss Harvesting has historically been a premium investment strategy, as it required the manual tracking and reallocating of positions by Financial Advisors and Private Wealth Managers.
                        Using {{appName(true)}}, these valuable benefits can now be recognized by investors of any size and experience level.
                    </p>
                </div>
            </div>


        </x-slot>




        <x-slot name="header4">

            <div class="homeFeatureTitle homeFeatureTitle--hiring pt-32">
                <h2 class="typ-stats bhrtyp-italic text-gray-900 pt-20">How does {{appName(true)}} help with this process?</h2>
            </div>
        </x-slot>


        <x-slot name="section4">

            <div class="homeFeatureContent flex">

                <div class=" w-full">
                    <p class="text-gray-700 homeFeatureContentRight__copy">
                    {{appName(true)}} helps manage every step of the Tax-Loss Harvesting process. Once your holdings are integrated,{{appName(true)}} will analyze your portfolio, review unrecognized gains and losses, and determine which positions should be sold to allow for maximum potential tax savings.
                    {{appName(true)}} also relies on industry-leading financial data providers and investment professionals to help create a distinct profile for each Stock, ETF, and Mutual Fund.
                        Using this information, we have created a proprietary {{appName(true)}} Similarity Model that measures the resemblance of each unique set of companies and funds.
                        This will tell you the most suitable replacement for the positions we advise you sell, allowing you to maintain a consistent profile across your portfolio.
                    </p>


                    <p class="text-gray-700 homeFeatureContentRight__copy">
                        {{appName(true)}}’s integrated alerting features offer direct notifications, ensuring your portfolio is consistently monitored to best capitalize on market movements.
                        {{appName(true)}} will then recognize the tax-efficient adjustments made to your portfolio, and provide reporting metrics to help you determine the increase to your savings.

                    </p>

                </div>
            </div>


        </x-slot>

        <x-slot name="header5">

            <div class="homeFeatureTitle homeFeatureTitle--hiring">
                <h2 class="typ-stats bhrtyp-italic text-gray-600 pt-20">How much will it save me?</h2>
            </div>
        </x-slot>

        <x-slot name="section5">

            <div class="homeFeatureContent flex">
                <div class=" w-full">
                    <p class="text-gray-700 homeFeatureContentRight__copy">
                        Exact dollars savings from Tax-Loss Harvesting will vary depending on existing holdings, past transactions, and marginal tax brackets, but institutional investors and academics agree the strategy provides undeniable short- and long-term benefits to all individuals.
                    </p>
                    <p class="text-gray-700 ">
                        Let’s walk through an example of the short-term impact: In your portfolio, you hold 50 shares of ABC which were purchased at $100 per share.
                        ABC is now trading at $90 per share, resulting in an unrecognized loss of $500 (50 shares x $10).{{appName(true)}} has determined that XYZ has a 93% similarity score to ABC, and therefore is a suitable substitute to maintain the existing profile of your overall portfolio.
                        By selling ABC and replacing it with XYZ, you have now recognized the loss of $500 with minimum change in overall portfolio exposure, and can write this off against income on your tax return.
                        For the average individual, this single transaction will lower your next tax bill by approximately $175 (assuming 35% marginal tax rate).
                        This will automatically be reported on the year-end statement from your investment brokerage account.
                        No further action is needed, and after 30 days, you have the option to repurchase ABC or continue holding your newly acquired position of XYZ.
                    </p>
                    <p class="text-gray-700 ">
                        The IRS calls for a net investment loss write off maximum of $3,000 per year, with additional losses being allowed to carry into future years.
                        However, in addition to this $3,000 net loss (that can be used against employment income), all investment gains can also be offset.
                        This allows for an even greater impact of Tax-Loss Harvesting. By following an optimal harvesting strategy, all taxes due from investment gains in a given year can be eliminated.
                    </p>
                    <p style="color: #000000" class="font-bold">
                        Taking our example one step further, let’s now look at a situation where an investor offsets their existing gains by harvesting, and view the impact this will have on their returns over the entire holding period:
                    </p>
                    <p class="text-gray-700 ">
                        You have $80,000 in your portfolio and have realized $12,000 of investment gains during the year.
                        Because you can write off a net of $3,000, you now have the ability to harvest $15,000 in total losses.
                        This will provide an immediate tax savings of $4,800, which is calculated by taking the expected tax payment on the $12,000 gains (assuming a mix of short- and long-term positions equating to a 25% combined capital gains rate),
                        and adding the income tax savings that can be applied to the additional $3,000 in losses (assuming a 35% marginal tax rate).
                    </p>

                    <h4 style="color: #000000" class="font-bold">
                        (12,000 x  25%) + ($3,000 * 35%) = $4,800
                    </h4>
                    <p class="text-gray-700 ">
                        By reinvesting this $4,800 over a 30-year holding period with market average equity returns (8% annually),
                        the result is nearly $50,000 of additional income from this sole year of Tax-Loss Harvesting.
                    </p>
                    <p class="text-gray-700 ">
                        Following this 30 year holding period, these positions will be sold and the deferred tax on the gains is now due at the long-term capital gains rate (15%).
                        In the end, the result is $41,000 of post-tax capital after all positions are liquidated.
                        This amounts to 51% in excess returns over the 30 year holding period (1.7% annualized), all accomplished from just one year of Tax-Loss Harvesting.
                    </p>

                </div>

            </div>


        </x-slot>


        <x-slot name="header6">

            <div class="homeFeatureTitle homeFeatureTitle--hiring pt-32">
                <h2 class="typ-stats bhrtyp-italic  pt-20" style="color: #70a13c">Why should I trust {{appName(true)}}?</h2>
            </div>
        </x-slot>


        <x-slot name="section6">

            <div class="homeFeatureContent flex">

                <div class=" w-full lg:-mt-20">
                    <p class="text-gray-700 homeFeatureContentRight__copy">
                        The {{appName(true)}} executive team has 50+ years of industry experience across hedge funds, investment banking, private equity, tax accounting, financial data, and wealth management.
                        Tax management and optimizing investment returns are at the core of everything they do, and they are excited to present investors everywhere with the opportunity to improve their Tax-Loss Harvesting process.
                    </p>
                </div>
            </div>


        </x-slot>


    </div>

</x-home-layout>
