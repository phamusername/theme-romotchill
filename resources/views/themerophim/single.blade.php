@extends('themes::themerophim.layout')

@php
    $watchUrl = '#';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watchUrl = $currentMovie->episodes
            ->sortBy([['server', 'desc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
    if ($currentMovie->status == 'trailer') {
        $watchUrl = 'javascript:alert("Phim đang được cập nhật!")';
    }
@endphp

<?php
$avatar_empty = '<div class="flex-shrink-0"><img src="/themes/rophim/cast-image.webp" width="70" height="70" class="object-cover w-16 h-16 rounded"></div>';
?>

@section('content')
    <div class="pt-2 grid grid-cols-12 gap-x-6">
        <section class="sm:col-span-9 col-span-12">
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
                    @foreach ($currentMovie->regions as $region)
                        <li class="inline-flex items-center">
                            <a class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-[#d98a5e] whitespace-nowrap"
                                itemprop="item" href="{{ $region->getUrl() }}" title="{{ $region->name }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                    </path>
                                </svg>
                                {{ $region->name }}
                            </a>
                        </li>
                    @endforeach
                    <li class="inline-flex items-center">
                        <span
                            class="inline-flex items-center text-sm font-medium text-gray-200 hover:text-white whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
                            </svg> {{ $currentMovie->name }}
                        </span>
                    </li>
                </ol>
            </nav>
            <div class="body-font overflow-hidden bg-[#181818] mt-2">
                <div class="py-2">
                    <div class="mx-auto bg-zinc-900 flex md:gap-x-8 gap-x-4 border-b border-zinc-800 pb-3">
                        <div class="md:w-4/12 w-5/12 relative">
                            <div>
                                <img src="{{ $currentMovie->getThumbUrl() }}" onerror="this.setAttribute('data-error', 1)"
                                    alt="{{ $currentMovie->name }}" data-nuxt-img="" title="{{ $currentMovie->name }}"
                                    class="object-cover md:h-80 w-full mx-auto object-center md:block rounded-md">
                            </div>
                        </div>
                        <div class="md:w-8/12 w-7/12">
                            <h1 class="text-gray-300 md:text-xl text-lg font-bold mb-1 uppercase md:pt-0">
                                {{ $currentMovie->name }}</h1>
                            <h2 class="text-md font-medium text-gray-400">{{ $currentMovie->origin_name }}
                                ({{ $currentMovie->publish_year }})</h2>
                            <time class="block pt-2 text-zinc-500 text-sm font-medium"
                                datetime="{{ $currentMovie->updated_at }}">{{ \Carbon\Carbon::parse($currentMovie->updated_at)->format('M d, Y') }}</time>
                            <div class="shadow md:rounded-lg pt-2">
                                <span
                                    class="font-medium px-2 py-1 bg-[#A3765D] text-[14px]">{{ $currentMovie->episode_current }}
                                    {{ $currentMovie->language }}</span>
                                <div class="mt-2 text-sm pt-4">
                                    <div>
                                        <span class="text-zinc-400">{{ $currentMovie->publish_year }}</span> ·
                                        <span>
                                            {!! $currentMovie->regions->map(function ($region) {
                                                    return '<a class="hover:text-[#d98a5e]" href="' .
                                                        $region->getUrl() .
                                                        '" title="' .
                                                        $region->name .
                                                        '">' .
                                                        $region->name .
                                                        '</a>';
                                                })->implode(', ') !!}
                                        </span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-zinc-400">Thể Loại: </span>
                                        {!! $currentMovie->categories->map(function ($category) {
                                                return '<span><a class="hover:text-[#d98a5e]" href="' .
                                                    $category->getUrl() .
                                                    '" title="' .
                                                    $category->name .
                                                    '">' .
                                                    $category->name .
                                                    '</a></span>';
                                            })->implode(', ') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="flex mb-4 pt-4">
                                @include('themes::themerophim.inc.rating2')
                            </div>
                            <div class="flex gap-x-2 items-center">
                                <div class="text-center mt-1 max-w-[180px]">
                                    @if ($currentMovie->status != 'trailer' && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '')
                                        <a title="Xem Phim {{ $currentMovie->name }}"
                                            href="{{ $currentMovie->episodes->sortBy([['server', 'desc']])->groupBy('server')->first()->sortByDesc('name', SORT_NATURAL)->groupBy('name')->last()->sortByDesc('type')->first()->getUrl() }}"
                                            class="flex mx-auto justify-center py-[8px] px-3 font-medium rounded bg-[#d9534f] hover:opacity-90 text-white">
                                            <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z">
                                                    </path>
                                                </svg>
                                            </i>
                                            <span class="">Xem Ngay</span>
                                        </a>
                                    @else
                                        <div class="text-white">Đang cập nhật...</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm p-1.5 mt-4 border border-zinc-800">
                        @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
                            <h3 class="inline-block">Lịch Chiếu: </h3>
                            <span class="pt-2 text-gray-300">{!! strip_tags($currentMovie->showtimes) !!}</span>
                        @endif
                    </div>
                    <div class="flex flex-wrap">
                        <style>
                            .tabpanel .nav-tabs li.active a {
                                background-color: #A3765D !important;
                                color: #fff !important;
                            }

                            .tabpanel .tab-pane {
                                display: none;
                            }

                            .tabpanel .tab-pane.active {
                                display: block;
                            }
                        </style>
                        <div class="w-full tabpanel">
                            <ul class="w-auto flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row gap-y-2 nav-tabs nav"
                                role="tablist">
                                <li class="-mb-px mr-2 last:mr-0 text-center active">
                                    <a role="tab" data-toggle="tab" aria-controls="episodes" href="#episodes"
                                        class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400 bg-zinc-800">
                                        Danh sách tập </a>
                                </li>
                                <li class="-mb-px mr-2 last:mr-0 text-center">
                                    <a role="tab" data-toggle="tab" aria-controls="information" href="#information"
                                        class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400 bg-zinc-800">
                                        Thông tin phim </a>
                                </li>
                                <li class="-mb-px mr-2 last:mr-0 text-center">
                                    <a role="tab" data-toggle="tab" aria-controls="casts" href="#casts"
                                        class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400 bg-zinc-800">
                                        Diễn Viên </a>
                                </li>
                                @if ($currentMovie->trailer_url)
                                    <li class="-mb-px mr-2 last:mr-0 text-center">
                                        <a role="tab" data-toggle="tab" aria-controls="trailer" href="#trailer"
                                            class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400 bg-zinc-800">
                                            Trailer </a>
                                    </li>
                                @endif
                            </ul>
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-[#222222] w-full mb-6 shadow-lg rounded">
                                <div class="px-4 py-4 flex-auto">
                                    <div class="tab-content">
                                        <div id="episodes" class="tab-pane active">
                                            <div class="pb-3">
                                                @foreach ($currentMovie->episodes->groupBy('server') as $server => $data)
                                                    <h3 class="text-gray-300 text-sm uppercase font-medium inline-block">
                                                        Danh
                                                        Sách Tập {{ $server }}</h3>
                                                    <div class="pt-3 flex flex-row flex-wrap gap-x-2">
                                                        <span class="flex flex-row flex-wrap max-h-52 overflow-x-auto">
                                                            <div class="w-full p-3">
                                                                <h3>{{ $server }}</h3>
                                                            </div>
                                                            @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                                                <a class="text-gray-300 bg-neutral-600 hover:bg-neutral-700 text-center font-medium min-w-[64px] text-[13px] px-2 py-1.5 mb-2 mr-1.5 rounded-sm"
                                                                    title="{{ $name }}"
                                                                    href="{{ $item->first()->getUrl() }}">
                                                                    Tập {{ $name }}
                                                                </a>
                                                            @endforeach
                                                        </span>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div id="information" class="divide-y divide-zinc-700 tab-pane">
                                            <div class="pb-3">
                                                <h3
                                                    class="text-sm font-medium tracking-wider uppercase text-zinc-300 block">
                                                    Nội Dung Phim</h3>
                                                <div class="pt-3 text-gray-400 leading-relaxed block text-justify">
                                                    <p class="inline">
                                                        <strong>{!! $currentMovie->name !!} - {!! $currentMovie->origin_name !!}
                                                            ({!! $currentMovie->publish_year !!})</strong>
                                                        {!! $currentMovie->content !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="casts" class="tab-pane">
                                            <div class="border-b border-zinc-800 pb-4">
                                                <span
                                                    class="text-gray-300 inline-block font-medium tracking-wider pb-2 text-sm uppercase">Đạo
                                                    Diễn</span>
                                                <div class="grid grid-cols-12 mt-2 gap-y-6 gap-x-2">
                                                    @forelse ($currentMovie->directors as $director)
                                                        <div class="col-span-6">
                                                            <a class="flex gap-x-2 hover:opacity-80 text-center">
                                                                <img src="/themes/rophim/cast-image.webp" width="70"
                                                                    height="70" loading="lazy"
                                                                    class="inline object-cover w-16 h-16 rounded-sm">
                                                                <div class="text-left">
                                                                    <p class="text-sm font-medium text-gray-300 pt-2">
                                                                        {{ $director->name }}
                                                                    </p>
                                                                    <p class="text-sm text-gray-500"></p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @empty
                                                        <div class="col-span-6">
                                                            <a class="flex gap-x-2 hover:opacity-80 text-center">
                                                                <img src="/themes/rophim/cast-image.webp" width="70"
                                                                    height="70" loading="lazy"
                                                                    class="inline object-cover w-16 h-16 rounded-sm">
                                                                <div class="text-left">
                                                                    <p class="text-sm font-medium text-gray-300 pt-2">N/A
                                                                    </p>
                                                                    <p class="text-sm text-gray-500"></p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="pt-3">
                                                <span
                                                    class="text-gray-300 inline-block font-medium tracking-wider pb-2 text-sm uppercase">Diễn
                                                    Viên</span>
                                                <div class="grid grid-cols-12 mt-2 gap-y-6 gap-x-2">
                                                    @forelse ($currentMovie->actors as $actor)
                                                        <div class="col-span-6" title="{{ $actor->name }}">
                                                            <a class="flex gap-x-2 hover:opacity-80 text-center"
                                                                href="{{ $actor->getUrl() }}">
                                                                <img src="/themes/rophim/cast-image.webp" width="70"
                                                                    height="70" alt="{{ $actor->name }}"
                                                                    loading="lazy"
                                                                    class="inline object-cover w-16 h-16 rounded-sm"
                                                                    title="{{ $actor->name }}">
                                                                <div class="text-left">
                                                                    <p class="text-sm font-medium text-gray-300 pt-2">
                                                                        {{ $actor->name }}
                                                                    </p>
                                                                    <p class="text-sm text-gray-500"></p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @empty
                                                        <div class="col-span-6">
                                                            <a class="flex gap-x-2 hover:opacity-80 text-center">
                                                                <img src="/themes/rophim/cast-image.webp" width="70"
                                                                    height="70" loading="lazy"
                                                                    class="inline object-cover w-16 h-16 rounded-sm">
                                                                <div class="text-left">
                                                                    <p class="text-sm font-medium text-gray-300 pt-2">N/A
                                                                    </p>
                                                                    <p class="text-sm text-gray-500"></p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        @if ($currentMovie->trailer_url)
                                            <div id="trailer" class="tab-pane">
                                                <h3 class="text-zinc-300 pb-2 text-sm font-medium block uppercase">Trailer
                                                </h3>
                                                @php
                                                    parse_str(
                                                        parse_url($currentMovie->trailer_url, PHP_URL_QUERY),
                                                        $parse_url,
                                                    );
                                                    $trailer_id = $parse_url['v'];
                                                @endphp
                                                <iframe width="100%" height="400px"
                                                    src="https://www.youtube.com/embed/{{ $trailer_id }}"></iframe>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="tab-contents"
                                class="relative flex flex-col min-w-0 break-words bg-[#222222] w-full mb-6 shadow-lg rounded">
                                <div class="px-4 py-4 flex-auto">
                                    <div id="episodes" class="tab-content hidden">
                                        <h3 class="text-gray-300 text-sm uppercase font-medium inline-block"> Tập Phim
                                        </h3>
                                        <div class="pt-3 flex flex-row flex-wrap gap-x-2">
                                            @foreach ($currentMovie->episodes->groupBy('server') as $server => $data)
                                                <span class="flex flex-row flex-wrap max-h-52 overflow-x-auto">
                                                    <div class="w-full p-3">
                                                        <h3>{{ $server }}</h3>
                                                    </div>
                                                    @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                                        <a class="text-gray-300 bg-neutral-600 hover:bg-neutral-700 text-center font-medium min-w-[64px] text-[13px] px-2 py-1.5 mb-2 mr-1.5 rounded-sm"
                                                            title="{{ $name }}"
                                                            href="{{ $item->first()->getUrl() }}">
                                                            Tập {{ $name }}
                                                        </a>
                                                    @endforeach
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="information" class="tab-content">
                                        <h3 class="text-sm font-medium text-center uppercase text-zinc-300 block">Nội
                                            Dung Phim</h3>
                                        <div class="pt-3 text-gray-400 leading-relaxed block text-justify">
                                            <p class="inline">
                                                <strong>{!! $currentMovie->name !!} - {!! $currentMovie->origin_name !!}
                                                    ({!! $currentMovie->publish_year !!})</strong>
                                                {!! $currentMovie->content !!}
                                            </p>
                                        </div>
                                        <div class="mt-2 space-y-2"><!--[-->
                                            @foreach ($currentMovie->tags as $tag)
                                                <a class="inline-block text-xs font-medium mr-2 px-2.5 py-1 rounded bg-black text-zinc-400"
                                                    href="{{ $tag->getUrl() }}" title="{{ $tag->name }}"
                                                    rel='tag'>
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                            <!--]-->
                                        </div>
                                        <p>&nbsp;</p>
                                        <p>Hãy cùng đón xem bộ phim "{{ $currentMovie->name }}" trên
                                            <strong>Rophim</strong>
                                            nhé!
                                        </p>
                                    </div>
                                    <div id="casts" class="tab-content hidden">
                                        <span class="text-sm font-medium uppercase text-zinc-300 block">CREATOR</span>
                                        <div class="grid grid-cols-2 gap-y-6 gap-x-4 mt-4">
                                            @foreach ($currentMovie->directors as $director)
                                                <a class="hover:opacity-80 flex items-center space-x-4 py-2"
                                                    href="{{ $director->getUrl() }}"
                                                    title="Đạo diễn {{ $director->name }}" class="mx-2">
                                                    @if ($director->thumb_url)
                                                        <div class="flex-shrink-0">
                                                            <img srcset="{{ $director->thumb_url }}"
                                                                src="{{ $director->thumb_url }}" width="70"
                                                                height="70" alt="Bertrand Blier"
                                                                class="object-cover w-16 h-16 rounded">
                                                        </div>
                                                    @else
                                                        {!! $avatar_empty !!}
                                                    @endif
                                                    <div class="ml-4 flex-1 min-w-0">
                                                        <span
                                                            class="text-sm font-medium text-gray-300 truncate block">{{ $director->name }}</span>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                        <span class="text-sm font-medium uppercase text-zinc-300 block pt-8 mt-4">Diễn
                                            Viên</span>
                                        <div class="grid grid-cols-2 gap-y-6 gap-x-4 mt-4">
                                            @foreach ($currentMovie->actors as $actor)
                                                <a class="hover:opacity-80 flex items-center space-x-4 py-2"
                                                    title="Diễn viên {{ $actor->name }}" href="{{ $actor->getUrl() }}">
                                                    <div class="flex-shrink-0">
                                                        @if ($actor->thumb_url)
                                                            <img srcset="{{ $actor->thumb_url }}" width="70"
                                                                height="70" alt="{{ $actor->name }}"
                                                                class="object-cover w-16 h-16 rounded">
                                                        @else
                                                            {!! $avatar_empty !!}
                                                        @endif
                                                    </div>
                                                    <div class="ml-4 flex-1 min-w-0">
                                                        <span
                                                            class="text-sm font-medium text-gray-300 truncate block">{{ $actor->name }}</span>
                                                        <span
                                                            class="text-xs text-gray-400 truncate block">{{ $actor->name }}</span>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if ($currentMovie->trailer_url)
                                        <div id="trailer" class="tab-content hidden pt-1">
                                            <h3 class="text-zinc-300 pb-2 text-sm font-medium block uppercase">Trailer</h3>
                                            @php
                                                parse_str(
                                                    parse_url($currentMovie->trailer_url, PHP_URL_QUERY),
                                                    $parse_url,
                                                );
                                                $trailer_id = $parse_url['v'];
                                            @endphp
                                            <iframe width="100%" height="400px"
                                                src="https://www.youtube.com/embed/{{ $trailer_id }}"></iframe>
                                        </div>
                                    @endif
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="sharing-buttons flex flex-wrap items-center bg-black py-2 px-2">
                        <span class="text-sm text-zinc-400 mr-3">Chia Sẻ</span>
                        <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#1877F2] bg-[#1877F2] hover:opacity-90"
                            target="_blank" rel="noopener"
                            href="https://facebook.com/sharer/sharer.php?u={{ $currentMovie->getUrl() }}"
                            aria-label="Share on Facebook">
                            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" class="w-4 h-4">
                                <title>Facebook</title>
                                <path
                                    d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
                                </path>
                            </svg>
                        </a>
                        <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#1DA1F2] bg-[#1DA1F2] hover:opacity-90"
                            target="_blank" rel="noopener"
                            href="https://twitter.com/intent/tweet?url={{ $currentMovie->getUrl() }}"
                            aria-label="Share on Twitter">
                            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" class="w-4 h-4">
                                <title>Twitter</title>
                                <path
                                    d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
                                </path>
                            </svg>
                        </a>
                        <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#0A66C2] bg-[#0A66C2] hover:opacity-90"
                            target="_blank" rel="noopener"
                            href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ $currentMovie->getUrl() }}&amp;title=&amp;summary=&amp;source={{ $currentMovie->getUrl() }}"
                            aria-label="Share on Linkedin">
                            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" class="w-4 h-4">
                                <title>Linkedin</title>
                                <path
                                    d="M136 183v283H42V183h94zm6-88c1 27-20 49-53 49-32 0-52-22-52-49 0-28 21-49 53-49s52 21 52 49zm333 208v163h-94V314c0-38-13-64-47-64-26 0-42 18-49 35-2 6-3 14-3 23v158h-94V183h94v41c12-20 34-48 85-48 62 0 108 41 108 127z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <section class="bg-zinc-900 py-3 antialiased border border-zinc-800 mt-2">
                        <style>
                            @media only screen and (max-width: 767px) {
                                .fb-comments {
                                    width: 100% !important
                                }

                                .fb-comments iframe[style] {
                                    width: 100% !important
                                }

                                .fb-like-box {
                                    width: 100% !important
                                }

                                .fb-like-box iframe[style] {
                                    width: 100% !important
                                }

                                .fb-comments span {
                                    width: 100% !important
                                }

                                .fb-comments iframe span[style] {
                                    width: 100% !important
                                }

                                .fb-like-box span {
                                    width: 100% !important
                                }

                                .fb-like-box iframe span[style] {
                                    width: 100% !important
                                }
                            }

                            .fb-comments,
                            .fb-comments span {
                                background-color: #eee
                            }

                            .fb-comments {
                                margin-bottom: 20px
                            }
                        </style>
                        <div class="mx-auto px-4">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-md font-medium text-white">Bình Luận
                                </h2>
                            </div>
                            <div data-order-by="reverse_time" id="commit-99011102" class="fb-comments"
                                data-href="{{ $currentMovie->getUrl() }}" data-width="" data-numposts="10"></div>
                            <script>
                                document.getElementById("commit-99011102").dataset.width = $("#commit-99011102").parent().width();
                            </script>
                        </div>
                    </section>
                </div>
            </div>
            <div class="w-full h-px my-2"></div>
            <section class="pt-2 py-4">
                <span class="text-gray-200 font-semibold uppercase py-3 block text-md">
                    <span class="inline-block">
                        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="star"
                            class="w-4 text-yellow-500 mr-1" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z">
                            </path>
                        </svg>
                    </span>Phim Đề Cử
                </span>
                <div class="grid grid-cols-2 gap-x-2 gap-y-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4">
                    @foreach ($movie_related as $movie)
                        <div>
                            <article
                                class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2 bg-[#181818]">
                                <a title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                    href="{{ $movie->getUrl() }}" class="relative">
                                    <img src="{{ $movie->getThumbUrl() }}" onerror="this.setAttribute('data-error', 1)"
                                        alt="{{ $movie->name }} {{ $movie->publish_year }}" loading="lazy"
                                        data-nuxt-img="" title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                        class="object-cover object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200">
                                </a>
                                <div class="mt-3 px-2">
                                    <a title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                        href="{{ $movie->getUrl() }}">
                                        <span
                                            class="text-[15px] font-medium capitalize pt-1 block truncate">{{ $movie->name }}</span>
                                        <span
                                            class="text-[14px] text-zinc-400 font-medium capitalize pt-1 block truncate">{{ $movie->origin_name }}</span>
                                    </a>
                                </div>
                                <span
                                    class="text-xs py-[3px] px-1 block rounded-br-md rounded-tr-md bg-[#A3765D] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{ $movie->episode_current }}
                                    {{ $movie->language }}</span>
                            </article>
                        </div>
                    @endforeach
                </div>
            </section>
        </section>
        <section class="hidden sm:block sm:col-span-3 col-span-12">
            <div class="bg-[#171717] p-2 rounded-lg">
                @include('themes::themerophim.sidebar')
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
