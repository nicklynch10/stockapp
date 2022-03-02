<x-app-layout>
    <x-slot name="header"></x-slot>

    @if(count(Auth::user()->notifications))
        <div class="grid grid-cols-1 md:grid-cols-2 xs:space-x-4 gap-4 mx-10 sm:mx-10 my-5 p-5">
            @foreach(Auth::user()->notifications->sortByDesc("created_at") as $n)
                @include('components.notification-card',['n'=>$n])
            @endforeach
        </div>
    @else
        <div class="container mx-auto px-4 py-10 md:py-12">
            <div class="p-5 bg-white my-5 border border-gray-300 rounded rounded-t-lg text-center">
                No Notification.
            </div>
        </div>
    @endif
</x-app-layout>
