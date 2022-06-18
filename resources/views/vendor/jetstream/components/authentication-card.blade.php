<div class="min-h-screen flex flex-col justify-center items-center py-6 sm:pt-0 bg-gray-100" {{$attributes}}>
    <div>
        {{ $logo }}
    </div>

    <div class="lg:w-2/4 xl:w-1/4 md:w-1/3 sm:w-10/12 xs:w-4/5 sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg mt-20">
        {{ $slot }}
    </div>
</div>
