<div class="mb-4 shadow bg-white rounded self-start">
    <div class="grid grid-cols-12 flex items-center md:text-center border-gray-200 py-4 px-4 lg:px-6 border-b-2 space-x-2 w-full xs:flex xs:text-center xs:flex-wrap xs:justify-center">
        <div class="col-span-2 col-end-2 xs:col-end-3">
            <a class="">
                <img src="{{ $n->notifiable->profile_photo_url }}" class="rounded-full hover:bg-gray-100 h-10 w-auto">
            </a>
        </div>

        <div class="col-span-8 col-start-2 xs:col-start-3 col-end-8 text-left xs:text-center">
             <span class=" h-full text-left">
                {{$n->data['tagline']}}
            </span>
        </div>
        <div class="col-span-2 col-start-10 text-xs italic p-2">
            {{$n->created_at->diffForHumans()}}
        </div>
    </div>
</div>

