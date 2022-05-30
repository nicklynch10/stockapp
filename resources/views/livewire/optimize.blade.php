<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Optimize')}}
    </h2>
</x-slot>
<main class="p-0 m-0 flex-grow ">
    <div class="mx-auto px-4 py-2 md:py-12">
        <div class="grid grid-cols-12 gap-2">
            <div class="flex flex-col p-8 bg-white sm:rounded-lg px-4 py-4 col-start-1 col-span-12 sm:col-span-12 xs:col-span-12 xs:col-start-2 rounded-lg">
                <div class="-my-2 sm:-mx-6 lg:-mx-8 example">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="w-full mb-5 overflow-hidden" style="height: 100%">
                            <div class="grid grid-cols-4 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-3 xl:grid-cols-3 lg:grid-cols-4 p-2 overflow-y-auto overflow-x-hidden  w-2/4w-full " style="max-height: 65vh;">
                                <div class="m-2">
                                    <div class="w-full shadow-sm h-full rounded shadow overflow-hidden bg-white bg-gray-50 px-1 py-2 self-start flex flex-col justify-between" style="min-width: 100px; ">
                                        <div class="mt-3 my-1">
                                            <div class="flex flex-col items-center xs:flex-col xl:flex-col md:flex-col">
                                                <div class="flex flex-col justify-between p-4 leading-normal align items-center" style="width: 255px">
                                                    <?php
                                                        $logoUrl = 'https://ui-avatars.com/api/?name=AMZN&color=7F9CF5&background=EBF4FF';
                                                    ?>
                                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><img src="{{ $logoUrl }}" class="h-16 w-16 rounded-full object-contain hover:bg-gray-100 h-16"></h5>
                                                    <h5 class="mx-2 mb-2 text-center text-2xl break-all font-bold tracking-tight text-gray-900 dark:text-white">
                                                        <a class=" cursor-pointer whitespace-normal" >AMZN</a>
                                                    </h5>
                                                    <p class="mb-1 break-words break-all text-sm text-center font-sans font-light text-grey-dark italic sm:text-xs">Amazon.com Inc.</p>
                                                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">May 12th, 2022</p>
                                                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">Short / 33 Days held</p>
                                                    <p class="mb-1 break-words break-all text-center text-sm font-sans font-light text-grey-dark">Account : Taxable Account	</p>
                                                </div>
                                                <div class="flex flex-col justify-between p-4 leading-normal">
                                                    <div class="flow-root">
                                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                            $ Loss
                                                                        </p>
                                                                    </div>
                                                                    <div class="inline-flex items-center break-all text-sm">
                                                                        <p class="break-all">$138.03</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                            % Loss
                                                                        </p>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm">
                                                                        5.89%
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="py-1 sm:py-4">
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="flex-1 min-w-0">
                                                                        <p class="text-sm font-medium text-black-900 truncate dark:text-white">
                                                                            Potential Savings
                                                                        </p>
                                                                    </div>
                                                                    <div class="inline-flex items-center text-sm">
                                                                        5.89%
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>