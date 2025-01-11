@if ($recommendations)
    <section class="py-2 text-gray-100">
        <div class="relative">
            <div>
                <h2
                    class="text-md font-medium text-gray-200 uppercase pl-2 border-l-[3px] border-solid border-[#da966e]">
                    {{ $recommendations['label'] }}</h2>
                <div class="flex float-right gap-1">
                    <span class="cursor-pointer group border border-zinc-800 px-1.5 py-1" id="customPrevBtn">
                        <svg class="w-4 h-4 text-gray-200 group-hover:text-blue-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                            <path
                                d="M8.766.566A2 2 0 0 0 6.586 1L1 6.586a2 2 0 0 0 0 2.828L6.586 15A2 2 0 0 0 10 13.586V2.414A2 2 0 0 0 8.766.566Z">
                            </path>
                        </svg>
                    </span>
                    <span class="cursor-pointer group border border-zinc-800 px-1.5 py-1" id="customNextBtn">
                        <svg class="w-4 h-4 text-gray-200 group-hover:text-blue-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                            <path
                                d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z">
                            </path>
                        </svg>
                    </span>
                </div>
                <div id="film_hot" class="relative pt-4">
                    @if (count($recommendations))
                        @foreach ($recommendations['data'] as $movie)
                            <article class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2">
                                <a title="{{$movie->name}}" href="{{$movie->getUrl()}}"
                                    class="relative block">
                                    <img width="250" height="300"
                                        data-src="{{$movie->getThumbUrl()}}"
                                        alt="{{$movie->name}}" title="{{$movie->name}}"
                                        sizes="(max-width: 600px) 200px, (max-width: 1200px) 270px, 200px"
                                        class="object-cover lozad object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200">
                                </a>
                                <div
                                    class="mt-3 absolute bottom-0 left-0 p-2 bg-gradient-to-b from-transparent to-black w-full">
                                    <a title="Love Next Door" href="{{$movie->getUrl()}}">
                                        <h3 class="text-[15px] font-medium capitalize pt-1 block truncate">{{$movie->name}}</h3>
                                        <span class="text-sm text-gray-300 font-medium">{{$movie->publish_year}}</span>
                                    </a>
                                </div>
                                <span
                                    class="font-medium text-xs py-1 px-2 block rounded-br-md rounded-tr-md bg-[#A3765D] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{$movie->episode_current}}</span>
                                <span
                                    class="text-xs font-medium py-[4px] px-1 block bg-red-800 absolute top-0 right-0 shadow-lg">{{$movie->language}}</span>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif

<style>
    #film_hot {
        position: relative;
        padding-right: 5px;
        height: 265px;
        overflow: hidden;
    }

    #film_hot .item {
        margin: 0 10px;
        position: relative;
        width: 175px;
        float: left;
        height: 256px;
        margin-bottom: 10px;
    }

    #film_hot .owl-item .item {
        height: auto;
    }

    #film_hot .owl-item .relative {
        width: 96%;
        margin: 0 2%;
    }
</style>
