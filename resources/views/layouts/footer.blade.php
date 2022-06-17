<footer class="footer relative pt-6 border-blue-700 bg-white border-t-2" style="border-top-color: #E5E7EB;">

    <div class="container mx-auto px-6 lg:px-48">

        <div class=" sm:flex sm:mt-8">
            <div class="grid grid-cols-12 xs:grid-cols-1 mt-8 mb-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col sm:flex-row justify-around">
                <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 flex flex-col text-center">
                    <span class="xs:col-span-1 font-bold text-gray-700 mb-2">Learn More</span>

                    <span class="my-2"><a href="/pricing" class="text-blue-700  text-md hover:text-blue-500">Pricing</a></span>
                    <span class="my-2"><a href="/contact" class="text-blue-700  text-md hover:text-blue-500">Contact</a></span>
                    <span class="my-2"><a href="/faq"
                                          class="text-blue-700  text-md hover:text-blue-500">FAQ</a></span>
                </div>
                <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 flex flex-col text-center">
                    <span class="font-bold text-gray-700 sm:mt-0 mb-2">View Features</span>
                    <span class="my-2"><a href="/rewards-process" class="text-blue-700 text-md hover:text-blue-500">Tax Loss Harvesting</a></span>
                    <span class="my-2"><a href="/group-cards" class="text-blue-700  text-md hover:text-blue-500">Identify Stock Swap Candidates</a></span>
                    <span class="my-2"><a href="/perksweet-connect" class="text-blue-700  text-md hover:text-blue-500">Monitor Factor Exposure</a></span>
                </div>
                <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 sm:col-start-10 flex flex-col text-center">
                    <span class="font-bold text-gray-700 sm:mt-0 mb-2">Contact {{ appName() }} </span>
                    <span class="my-2"><a href="mailto:sales@taxghost.com"
                                          class="text-blue-700  text-md hover:text-blue-500">Sales</a></span>
                    <span class="my-2"><a href="mailto:support@taxghost.com"
                                          class="text-blue-700  text-md hover:text-blue-500">Support</a></span>
                    <span class="my-2">
                        <a href="/terms" target="_blank" class="text-blue-700 text-md hover:text-blue-500">Terms & Conditions</a>
                        |
                        <a href="/privacy" target="_blank" class="text-blue-700 text-md hover:text-blue-500">Privacy Policy</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6">
        <div class="mt-4 md:mt-16 border-t-2 border-gray-300 flex flex-col items-center">
            <div class="sm:w-2/3 text-center py-6">
                <div class="flex justify-center">
                    © 2022 {{ appName() }} <img class="h-5 mx-2" src="{{ appFavicon() }}">
                </div>
            </div>
        </div>
    </div>
</footer>
