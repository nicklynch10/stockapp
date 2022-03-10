<div class="mb-4 shadow bg-white rounded self-start">

    <div class="grid grid-cols-12 flex items-center md:text-center border-gray-200 py-4 px-4 lg:px-6 border-b-2 space-x-2 w-full ">
        <div class="col-span-3 col-end-2 xs:col-end-3">
            <a class="">
                <img src="{{ $n->notifiable->profile_photo_url }}" class="rounded-full hover:bg-gray-100 h-10 w-auto">
            </a>
        </div>

        <div class="col-span-7 col-start-2 xs:col-start-3  col-end-12 text-left">
             <span class=" h-full text-left">
                {{$n->data['tagline']}}
            </span>
        </div>
    </div>

    <div class="p-3 flex flex-wrap justify-center bg-white">

        <div class="w-full lg:w-1/2 lg:border-b-0 border-gray-200 p-4 free_form tracking-wide ">
            {{$n->data['tagline']}}
        </div>

    </div>
    <div class="text-xs italic p-2 text-gray-800 border-t-2 border-gray-100 ">
        {{$n->created_at->diffForHumans()}}
    </div>
</div>

<style type="text/css">
    .free_form > a {
        text-decoration: underline;
        color: blue;
    }
    .free_form > .ql-font-serif {
        font: sans-serif;
    }
    .free_form > ul {
        list-style: inside;
    }
</style>
