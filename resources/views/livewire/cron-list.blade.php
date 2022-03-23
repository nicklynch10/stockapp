<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Developer')}}
    </h2>
</x-slot>

<main class="p-0 m-0 flex-grow ">
<style>
    @media screen and (max-width: 600px) {
        table tr td{
            display: grid;
            font-size: 12px;
            padding: 6px 12px !important;
        }
        table thead{
            display: none;
        }
        table td{
            text-align: left !important;
        }
        table tr{
            display: flex !important;
            flex-direction: column !important;
            border: 2px solid #00000073 !important;
            border-radius: 11px !important;
            margin-bottom: 3px !important;
            background-color: #ffffff !important;
        }
        table td:last-child{
            border-bottom: 0;
        }
        table, thead, tbody, th, td, tr {
            display: block;
            font-size: 12px;
            text-align: left !important;
        }
        table td::before{
            content: attr(data-label);
            float: left;
            font-weight: bold;
            width: 15px;
            color: #000000;
        }
        table td::before{
            content: attr(data-label);
            float: left;
            font-weight: bold;
            width: 15px;
        }
        table tr .lastcoloumn:last-child{
            display: block !important;
        }
        table td:first-child { background: #00c80696;border-radius: 7px 7px 0px 0px; }
    }
</style>
<div class="container mx-auto px-4 py-10 md:py-12">
    <div class="flex flex-col mt-8">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
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
                            <tr>
                                <td data-label="Command" class="px-6 py-4 whitespace-nowrap text-left text-gray-900"><p class="whitespace-normal">{{ $cron['command'] }}</p></td>
                                <td data-label="Frequency" class="px-6 py-4 whitespace-nowrap text-left text-gray-900">{{ $cron['frequency'] }}</td>
                                <td data-label="Description" class="px-6 py-4 whitespace-nowrap text-center text-gray-900">{{ data_get($cron, 'description') ?? '-' }}</td>
                                <td data-label="Next Run At" class="px-6 py-4 whitespace-nowrap text-left text-gray-900">{{ data_get($cron, 'next_execute_at') }}</td>
                                <td data-label="" class="px-6 py-4 whitespace-nowrap text-center text-gray-900 w-1/3">
                                    <x-jet-button wire:click="executeCron('{{ json_encode($cron['command'])}}')" class="py-2 px-4">Execute</x-jet-button>
{{--                                    <x-jet-button wire:click="executeCron('{{ addslashes($cron['command']) }}', 'example')" class="py-2 px-4">Execute</x-jet-button>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
