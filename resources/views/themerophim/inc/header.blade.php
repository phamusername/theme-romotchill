@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<div>
    <header id="header" class="border-b border-zinc-800">
        <div
            class="py-3 border-b border-zinc-800 sm:px-4 px-3 items-center flex justify-between sm:gap-10 z-[60] relative">
            <div class="md:hidden block text-2xl cursor-pointer btn-menu-mobile"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25">
                    </path>
                </svg></div>
            <script>
                document.querySelector('.btn-menu-mobile').addEventListener('click', function() {
                    document.querySelector('.menu-mobile').classList.toggle('hidden');
                });
            </script>
            <a href="/" class="bg-[#202020] p-3" title="Phim hay mới cập nhật 2022">
                @if ($logo)
                    {!! $logo !!}
                @else
                    {!! $brand !!}
                @endif
            </a>
            <div class="flex items-center hidden md:block">
                <div>
                    <div class="hidden md:block z-50 sm:w-72 w-48 right-0 top-7 transform origin-top-right">
                        <div class="flex">
                            <form class="relative w-full" id="form_search" method="GET" action="/">
                                <input value="" id="keyword" name="search" autocomplete="off" type="text"
                                    class="block p-2 w-full z-20 text-sm text-gray-200 bg-zinc-900 rounded-lg border border-zinc-600 focus:border-zinc-800 focus:outline-none"
                                    placeholder="Tìm Kiếm">
                                <button type="submit" aria-label="Search"
                                    class="absolute top-0 right-0 p-2 text-sm font-medium text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </form>
                        </div>
                        <div style="display:none;"
                            class="search-suggest absolute z-50 w-full text-center p-2 bg-black/90">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row gap-x-2 items-center">
                <div class="md:hidden basis-1/2 z-[50px] w-full">
                    <button aria-label="Toggle search mobile" type="button" class="tg-search-mobile">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 pt-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                        </svg>
                    </button>
                </div>
                <script>
                    document.querySelector('.tg-search-mobile').addEventListener('click', function() {
                        document.querySelector('.search-mobile').classList.toggle('hidden');
                    });
                </script>
                <div class="basis-1/2 md:basis-full">

                </div>
            </div>
        </div>
        <style>
            .megaMenu {
                opacity: 0;
                pointer-events: none;
                top: 85px;
                transition: all .2s linear
            }

            .megaMenu:after {
                content: "";
                height: 20px;
                left: 0;
                position: absolute;
                top: -20px;
                width: 100%
            }

            .navItem:hover .megaMenu {
                opacity: 1;
                pointer-events: inherit;
                top: 65px
            }
        </style>
        <div class="z-50 md:hidden w-full search-mobile hidden">
            <div class="flex">
                <form class="relative w-full" method="GET" action="/">
                    <input value="" name="search" type="text"
                        class="block p-2 w-full z-20 text-sm text-zinc-200 bg-zinc-900 border border-zinc-600 border-zinc-800 focus:outline-none"
                        placeholder="Tìm Kiếm">
                    <button aria-label="Search Button" type="submit"
                        class="absolute top-0 right-0 p-2 text-sm font-medium text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>
            </div>
            <div class="search-suggest absolute z-50 w-full text-center p-2 bg-black/90" style="display:none"></div>
        </div>
        <nav class="z-50 bg-[#151414] relative">
            <div>
                <ul class="md:flex hidden py-2 px-2 items-center gap-1">
                    @foreach ($menu as $item)
                        <li class="navItem">
                            @if (count($item['children']))
                                <button
                                    class="flex cursor-pointer items-center text-md text-gray-100 hover:text-zinc-400 xl:px-3 px-2 py-2 whitespace-nowrap font-medium">
                                    {{ $item->name }}
                                    <svg class="w-5 h-5 mt-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" data-v-adc0ac87="">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" data-v-adc0ac87=""></path>
                                    </svg>
                                </button>
                                <ul class="megaMenu absolute bg-zinc-900 grid grid-cols-4 gap-4 bg-zinc-950 py-5 px-10 shadow-lg"
                                    aria-labelledby="dropdownLargeButton">
                                    @foreach ($item['children'] as $children)
                                        <li class="inline-block p-1 truncate text-center">
                                            <a href="{{ $children['link'] }}"
                                                class="flex items-center text-base text-zinc-300 hover:text-[#d98a5e] font-medium px-3 py-1 transition-all ease-linear duration-100">{{ $children['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <a href="{{ $item['link'] }}"
                                    class="flex items-center text-md text-zinc-300 hover:text-[#d98a5e] xl:px-3 px-2 py-2 font-medium whitespace-nowrap">
                                    {{ $item['name'] }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="slide-fade mx-4 bg-black md:hidden">
                    <div
                        class="absolute pt-2 bg-zinc-900 w-[95%] ml-2 right-3 z-20 h-auto overflow-y-auto menu-mobile hidden">
                        <div class="h-px"></div>
                        <div class="px-2 pt-2 pb-3 lg:px-3">
                            @foreach ($menu as $item)
                                <div>
                                    @if (count($item['children']))
                                        <div>
                                            <span
                                                class="flex px-3 btn-open-submenu-mobile py-2 rounded-md text-base font-medium text-gray-400 hover:text-white align-middle items-center cursor-pointer">
                                                <span class="w-20">{{ $item->name }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="transition ease-in-out duration-300 h-4 w-4 transform"
                                                    viewBox="0 0 20 20" fill="currentColor" data-v-adc0ac87="">
                                                    <path fill-rule="evenodd"
                                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd" data-v-adc0ac87=""></path>
                                                </svg>
                                            </span>
                                            <div
                                                class="ml-4 grid grid-cols-2 gap-2 transition ease-linear duration-300 transform sub-menu-mobie hidden">
                                                @foreach ($item['children'] as $children)
                                                    <a href="{{ $children['link'] }}"
                                                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 bg-zinc-700 hover:text-white hover:bg-zinc-700">{{ $children['name'] }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ $item['link'] }}"
                                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-zinc-700">
                                            {{ $item['name'] }}
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                            <script>
                                document.querySelectorAll('.btn-open-submenu-mobile').forEach(item => {
                                    item.addEventListener('click', () => {
                                        item.querySelector('svg').classList.toggle('rotate-90');
                                        item.nextElementSibling.classList.toggle('hidden');
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>
