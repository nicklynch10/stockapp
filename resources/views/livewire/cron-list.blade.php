<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Developer')}}
    </h2>
</x-slot>

<main class="p-0 m-0 flex-grow ">
<div class="container mx-auto px-4 py-10 md:py-12">
    <div class="flex flex-col mt-8 overflow-x-auto overflow-y-hidden">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="xs:hidden shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-300 xs:hidden">
                        <tr class="xs:flex xs:flex-col xs:border-2-solid-black xs:border-r-11 xs:mb-2">
                            <th class="px-6 py-4 text-left">
                                Command
                            </th>
                            <th class="px-6 py-4 text-left">
                                Frequency
                            </th>
                            <th class="px-6 py-4 text-left">
                                Description
                            </th>
                            <th class="px-6 py-4 text-left">
                                Next Run At
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" x-data="{}">
                        @foreach($crons as $cron)
                            <tr class="xs:flex xs:flex-col xs:border-2-solid-black xs:border-r-11 xs:mb-2">
                                <td  class="px-6 py-4 whitespace-nowrap text-left text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3"><p class="whitespace-normal">{{ $cron['command'] }}</p></td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">{{ $cron['frequency'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">{{ data_get($cron, 'description') ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-gray-900 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">{{ data_get($cron, 'next_execute_at') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 w-1/3 xs:grid xs:text-xs xs:text-left xs:py-1 xs:px-3">
                                    <x-jet-button wire:click="executeCron('{{ $cron['command'] }}')" class="py-2 px-4">Execute</x-jet-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12 block xl:hidden lg:hidden md:hidden sm:hidden overflow-auto">
                    @foreach($crons as $cron)
                        <table class="mb-4" style="border: 2px solid #00000073 ;">
                            <tbody class="flex-1">
                            <tr style="background: #00c80696">
                                <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Command</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-gray-900 xs:text-xs xs:text-right xs:py-1 xs:px-3 break-words">
                                    <p class="whitespace-normal ">{{ $cron['command'] }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Frequency</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-gray-900 xs:text-xs xs:text-right xs:py-1 xs:px-3">
                                    {{ $cron['frequency'] }}
                                </td>
                            </tr>

                            <tr>
                                <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Description</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 xs:text-xs xs:text-right xs:py-1 xs:px-3">
                                    {{ data_get($cron, 'description') ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="w-1/3 p-2.5 text-left text-sm font-semibold">Next Run At</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-gray-900 xs:text-xs xs:text-right xs:py-1 xs:px-3">
                                    {{ data_get($cron, 'next_execute_at') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 w-1/3 xs:text-xs xs:text-right xs:py-1 xs:px-3">
                                    <x-jet-button wire:click="executeCron('{{ $cron['command'] }}')" class="py-2 px-4">Execute</x-jet-button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
</main>
