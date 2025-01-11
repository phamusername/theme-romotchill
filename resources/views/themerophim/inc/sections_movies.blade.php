<section class="py-2 mt-4">
    <div class="relative">
        <div>
            <h2
                class="text-md font-medium text-gray-200 uppercase block pl-2 border-l-[3px] border-solid border-[#da966e]">
                {{ $item['label'] }}</h2>
        </div>
        <div class="grid grid-cols-2 gap-x-4 sm:gap-x-4 gap-y-3 md:grid-cols-4 lg:grid-cols-4 pt-3 xl:grid-cols-4">
            @foreach ($item['data'] as $key => $movie)
                @include('themes::themerophim.inc.sections_movies_item')
            @endforeach
            <a class="absolute right-0 bg-[#A3765D] text-zinc-300 hover:text-blue-200 hover:opacity-90 text-xs py-1 top-0 px-2 rounded-md flex items-center"
                href="{{ $item['link'] }}" title="Xem thêm {{ $item['label'] }}">
                <span>Xem Thêm</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-3 h-3 pt-[2px]">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
