<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex justify-between w-full mb-5">
                <x-jet-input class="w-1/4 text-sm" type="text" wire:model="search" placeholder="Search User ..."
                             autofocus/>

                <div class="inline-flex items-center space-x-2">
                    <x-link-button href="{{ route('user.manage.users') }}">
                        Invite User
                    </x-link-button>
                </div>
            </div>

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-bold">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-bold">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-bold">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="">
                                <td class="py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4" wire:loading.class.delay="opacity-40">
                                            <div class="text-sm font-medium font-bold text-gray-900">
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4" wire:loading.class.delay="opacity-40">
                                            <div class="text-sm text-gray-500">
                                                {{ $user->title ? $user->title : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="">
                                        <a href="javascript:void(0);" class="text-red-400 hover:text-red-900 mr-2 lg:mr-5 md:sm:mr-3"
                                           wire:click="confirmDeletingInvitation('{{$user->id}}')">
                                            <span>
                                                <i class="fa fa-trash" title="delete"></i>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" colspan="100%">
                                    <div class="flex items-center justify-center text-gray-600 h-16 opacity-50 text-md">
                                        <span class="mr-3"><i class="fa fa-envelope"></i></span>
                                        <span class="text-lg">No Invitations Found ...</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="confirmDeleteInvitation" wire:click.away="cancelDeletingInvitation">
        <x-slot name="title">
            {{ __('Delete Invitation') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete invitation?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDeletingInvitation()" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteInvitation()" wire:loading.attr="disabled">
                {{ __('Delete Invitation') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
