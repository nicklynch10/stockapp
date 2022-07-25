<x-home-layout>

    <x-slot name="bg_url">
        /home images/29.jpg
    </x-slot>


    <div class="theme-page">
        <x-slot name="section1">

            <div class="py-20 xl:py-32">
                <h1 class="homeHero__title typ-hero-header bhrtyp-italic text-gray-900"
                    style="font-size: 60px; line-height: 55px; text-align: center;">How It Works</h1>
            </div>

        </x-slot>




        <x-slot name="section2">

            <div class="homeFeatureTitle homeFeatureTitle--hiring">
                <h2 class="typ-stats bhrtyp-italic text-gray-900 pt-20">Realizing savings from TaxGhost is easy!  Follow the below steps and start saving on your next tax return.</h2>
            </div>

            <div class="homeOverviewContent  shadow-none flex flex-wrap">
                <div class="md:w-1/2 w-full text-center p-0 m-0 mb-10 md:mb-16 lg:mb-0">
                    <img class="w-auto m-auto shadow-xl rounded " alt="{{ appName(true) }} Overview" src="/other/how-it-works.png"
                         data-src="/other/how-it-works.png"
                         style="">
                </div>

            <!-- "/other/pink_sweater_v1.png" -->
                <div class="md:w-1/2  Animation__toRight p-2 px-4 lg:ml-24">
                    <p class="text-gray-700">
                        1.	Create a profile using only a name and email address.
                        <br>
                    </p>
                    <p class="text-gray-700">
                        2.	Securely link your investment accounts through Plaid and see your most recent holdings within seconds.
                        Plaid offers automated and direct integration with Robinhood, Schwab, Vanguard, Fidelity, and many more personal investment brokers.
                        <br>
                    </p>
                    <p class="text-gray-700">
                        3.	Follow TaxGhost’s automated guidance to determine which positions should be sold and replaced using our proprietary TaxGhost methodology.
                        All trades can then be made through your existing accounts.
                        <br>
                    </p>
                    <p class="text-gray-700">
                        4.	All transactions will automatically be reported on the year-end tax statement directly from your broker.
                        No other steps are required! Additionally, TaxGhost will recognize the position changes and identify any new ways to save.
                        <br>
                    </p>
                </div>
            </div>

        </x-slot>
    </div>

</x-home-layout>
