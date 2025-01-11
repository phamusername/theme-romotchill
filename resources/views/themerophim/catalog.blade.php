@extends('themes::themerophim.layout')

@php
    use Ophim\Core\Models\Movie;
    $years = Cache::remember(
        'all_years',
        \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60),
        function () {
            return \Ophim\Core\Models\Movie::select('publish_year')->distinct()->pluck('publish_year')->sortDesc();
        },
    );
    $phimngaunhien = Cache::remember('site.movies.phimdecuside', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::inRandomOrder()
        ->limit('1')
        ->orderBy('view_total', 'asc')
        ->get();
    });
@endphp



@section('content')
    <div class="pt-2">
        <nav class="flex px-3 py-2 text-gray-700 border rounded-md bg-[#181818] border-zinc-900 shadow-lg shadow-black/20 truncate"
            aria-label="Breadcrumb">
            <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a title="Rổ Phim" href="/"
                        class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-[#d98a5e] whitespace-nowrap">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg> Rổ Phim
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <span
                        class="inline-flex items-center text-sm font-medium text-gray-200 hover:text-white whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
                        </svg> {{ $section_name }}
                    </span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-normal text-gray-200 uppercase text-center py-2">{{ $section_name }}</h1>
        <div class="pt-2 grid border-t border-zinc-800 grid-cols-12 sm:gap-x-10">
            <div class="sm:col-span-9 col-span-12">
                @include('themes::themerophim.inc.catalog_filter')
                <div class="w-full h-px my-2 bg-zinc-800"></div>
                <section class="pt-4">
                    <div
                        class="grid grid-cols-2 gap-x-3 md:gap-x-4 gap-y-4 sm:md:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4">
                        @foreach ($data as $key => $movie)
                            @php
                                $xClass = 'item';
                                if ($key === 0 || $key % 4 === 0) {
                                    $xClass .= ' no-margin-left';
                                }
                            @endphp

                            @include('themes::themerophim.inc.catalog_sections_movies_item')
                        @endforeach
                    </div>
                    {{ $data->appends(request()->all())->links('themes::themerophim.inc.pagination') }}
                </section>
            </div>
            <div class="sm:col-span-3 sm:block hidden">
                <div>
                    <div>
                        <section class="text-gray-600 body-font">
                            <div>
                                <div class="flex flex-col w-full mb-2">
                                    <h2
                                        class="uppercase font-normal text-gray-200 text-xl border-dashed border-b border-zinc-800 w-full block pb-2 mb-2">
                                        Phim Ngẫu Nhiên</h2>
                                </div>
                                <div class="-m-2">
                                    @foreach ($phimngaunhien as $movie)
                                        <div class="relative"><a href="{{ $movie->getUrl() }}h"
                                                class="text-gray-300 text-[14px] truncate font-medium"
                                                title="{{ $movie->name }}"><img src="{{ $movie->getThumbUrl() }}"
                                                    onerror="this.setAttribute('data-error', 1)" alt="{{ $movie->name }}"
                                                    data-nuxt-img=""
                                                    class="w-full h-36 object-cover object-center rounded-md p-1"></a>
                                            <div
                                                class="absolute bottom-1 left-1 p-2 bg-gradient-to-b from-transparent to-black w-full">
                                                <a href="{{ $movie->getUrl() }}"
                                                    class="text-gray-300 text-[14px] truncate font-medium"
                                                    title="{{ $movie->name }}">
                                                    <h3 class="truncate">{{ $movie->name }}</h3><span
                                                        class="text-zinc-400 text-sm block font-medium">{{ $movie->publish_year }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    @include('themes::themerophim.sidebar')
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
