@extends('themes::themerophim.layout')

@section('content')
    <div>
        <div class="pt-2 grid grid-cols-12 xl:space-x-8 lg:space-x-4">
            <section id="content-section" class="lg:col-span-9 col-span-12">
                <nav class="flex px-3 py-2 text-gray-700 border rounded-md bg-[#181818] border-zinc-900 shadow-lg shadow-black/20 truncate"
                    aria-label="Breadcrumb">
                    <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a title="Rophim" href="/"
                                class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-[#d98a5e] whitespace-nowrap">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg> Rophim
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
                            <a title="Phim {{ $currentMovie->name }}" href="{{ $currentMovie->getUrl() }}"
                                class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-[#d98a5e] whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                    </path>
                                </svg> {{ $currentMovie->name }}
                            </a>
                        </li>
                        <li class="inline-flex items-center">
                            <span
                                class="inline-flex items-center text-sm font-medium text-gray-200 hover:text-white whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                    </path>
                                </svg> Tập {{ $episode->name }}
                            </span>
                        </li>
                    </ol>
                </nav>
                <div>
                    <div class="bg-[#171717] border-b border-zinc-800 pb-2">
                        <div class="m-auto w-full my-2">
                            <div class="text-sm p-1.5 mt-3 border border-zinc-800 my-2">
                                @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
                                    <h3 class="inline-block">Lịch Chiếu: </h3>
                                    <span class="pt-2 text-gray-300">{!! strip_tags($currentMovie->showtimes) !!}</span>
                                @endif
                            </div>
                            <div class="transform relative player-wrapper">
                                <div class="h-content">
                                    <div class="flex iframe w-full" style="aspect-ratio: 16 / 9;" id="player-wrapper"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row pt-2">
                            <div class="basis-1/4">
                                <div class="flex justify-start mr-1">
                                    <button onclick="toggleZoom()" type="button" title="Phóng to" id="zoom-button"
                                        class="items-center bg-zinc-800 hover:opacity-80 px-2 py-1 text-xs font-medium leading-6 text-center text-gray-200 transition rounded shadow ripple hover:shadow-lg focus:outline-none waves-effect lg:flex hidden">
                                        <svg class="h-6 w-6" version="1.1" viewBox="0 0 36 36" width="100%">
                                            <use class="ytp-svg-shadow" xlink:href="#ytp-id-124"></use>
                                            <path d="m 28,11 0,14 -20,0 0,-14 z m -18,2 16,0 0,10 -16,0 0,-10 z"
                                                fill="#fff" fill-rule="evenodd" id="ytp-id-124"></path>
                                        </svg>
                                        <span id="zoom-text" class="pl-1 hidden lg:block">Phóng to</span>
                                    </button>
                                    {{-- <button data-modal-toggle="report-modal" type="button" title="Báo lỗi"
                                        class="flex items-center bg-zinc-800 hover:opacity-80 px-2 py-1 ml-1 text-xs font-medium leading-6 text-center text-gray-200 transition rounded shadow ripple hover:shadow-lg focus:outline-none waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5">
                                            </path>
                                        </svg>
                                        <span>Báo Lỗi</span>
                                    </button> --}}
                                </div>
                            </div>
                            <div class="basis-2/4 text-center">
                                <span class="text-sm font-medium pb-2 block uppercase">Đổi Server (Nếu Lag)</span>
                                <div class="flex flex-row flex-wrap gap-2 items-center justify-center min-h-[50px]">
                                    @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                        <a onclick="chooseStreamingServer(this)" data-type="{{ $server->type }}"
                                            data-id="{{ $server->id }}" data-link="{{ $server->link }}"
                                            class="streaming-server hover:cursor-pointer text-gray-300 border border-zinc-700 px-2 py-2 text-xs font-medium rounded">
                                            Server #{{ $loop->iteration }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="basis-1/4">
                                <div class="flex justify-end mr-1">
                                    <button id="btn_lightbulb" type="button" title="Tắt đèn"
                                        class="text-gray-200 z-30 mr-1 flex items-center bg-zinc-800 hover:opacity-80 px-2 py-1 text-xs font-medium leading-6 text-center  transition  rounded shadow ripple hover:shadow-lg  focus:outline-none waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokelinecap="round" strokelinejoin="round" strokewidth="2"
                                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                            </path>
                                        </svg>
                                        <span class="hidden lg:block" id="lightbulb-text">Tắt đèn</span>
                                    </button>
                                    <button id="next" type="button" title="Tập tiếp"
                                        class="flex items-center bg-zinc-800 hover:opacity-80 px-2 py-1 text-xs font-medium leading-6 text-center text-gray-200 transition rounded shadow ripple hover:shadow-lg focus:outline-none waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokelinecap="round" strokelinejoin="round" strokewidth="2"
                                                d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                        </svg>
                                        <span class="pl-1 hidden lg:block">Tập Tiếp</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="report-modal" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 z-[100] justify-center items-center w-full md:inset-0 h-full max-h-full bg-black/90">
                            <div
                                class="absolute left-1/2 transform -translate-x-1/2 top-12 p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative rounded-lg shadow bg-zinc-800">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-3 border-b rounded-t dark:border-gray-600">
                                        <span class="text-md font-bold text-zinc-200"> Báo Lỗi </span>
                                        <button type="button"
                                            class="text-zinc-400 bg-transparent hover:bg-zinc-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-zinc-600 hover:text-white"
                                            data-modal-toggle="report-modal" data>
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Đóng</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="description"
                                                    class="block mb-2 text-sm font-medium text-white">Nội dung lỗi:</label>
                                                <textarea id="report_message" rows="4"
                                                    class="block p-2.5 w-full text-sm rounded-lg border bg-zinc-600 border-zinc-900 focus:outline-none"
                                                    placeholder="Mô tả lỗi xảy ra"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button data-modal-toggle="report-modal" type="button"
                                                id="report_episode_btn"
                                                class="text-white inline-flex items-center bg-[#A3765D] hover:opacity-90 font-medium rounded-md text-sm px-4 py-1.5 text-center">Gửi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-[#222222] p-2 mt-2">
                        <span class="text-zinc-200 text-md font-medium uppercase pb-3 block">Danh Sách Tập</span>
                        <div class="flex flex-row flex-wrap" id="episodes">
                            @foreach ($currentMovie->episodes->groupBy('server') as $server => $data)
                                <span class="w-full flex flex-row flex-wrap max-h-52 overflow-x-auto">
                                    <div class="w-full p-3">
                                        <h3>{{ $server }}</h3>
                                    </div>
                                    @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                        <a class="text-gray-300 bg-neutral-600 hover:bg-neutral-700 text-center font-medium min-w-[64px] text-[13px] px-2 py-1.5 mb-2 mr-1.5 rounded-sm @if ($item->contains($episode)) bg-orange-900 active @endif"
                                            title="{{ $name }}" href="{{ $item->first()->getUrl() }}">
                                            Tập {{ $name }}
                                        </a>
                                    @endforeach
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="border-t border-zinc-800 border-opacity-75 pt-3 mt-2">
                        <h1 class="text-gray-200 font-bold text-xl uppercase inline-block">{{ $currentMovie->name }} Tập
                            {{ $episode->name }}</h1>
                        <h2 class="pt-1 text-xl">{{ $currentMovie->name }} - {{ $currentMovie->origin_name }}
                            ({{ $currentMovie->quality }} - {{ $currentMovie->language }}) </h2>
                        <h3 class="text-md text-zinc-400 font-bold my-2">Tập {{ $episode->name }}</h3>
                        <div class="py-2">
                            @include('themes::themerophim.inc.rating2')
                        </div>
                        <div class="mt-2 bg-[#222222] p-1 text-gray-400 text-justify">
                            <div class="pt-2 leading-relaxed inline">
                                <b>{{ $currentMovie->name }}</b>
                                <p class="inline">
                                    {!! mb_substr(strip_tags($currentMovie->content), 0, 500, 'utf-8') !!}...
                                </p>
                                <span>
                                    <a href="{{ $currentMovie->getUrl() }}"
                                        class="text-[#d98a5e] hover:text-[#e57131] text-sm font-medium whitespace-nowrap"
                                        title="{{ $currentMovie->name }}">Xem Thêm</a></span>
                            </div>
                        </div>
                        <div class="sharing-buttons flex flex-wrap items-center py-2 mt-2">
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
                        <div class="mt-2 border-gray-800 border-opacity-75">
                            <span
                                class="flex text-gray-300 text-md mt-2 items-center text-medium font-bold text-2md uppercase">
                                Để Lại Bình Luận</span>
                            <div class="bg-white mt-4">
                                <div data-order-by="reverse_time" id="commit-99011102" class="fb-comments"
                                    data-href="{{ $currentMovie->getUrl() }}" data-width="" data-numposts="10">
                                </div>
                                <script>
                                    document.getElementById("commit-99011102").dataset.width = $("#commit-99011102").parent().width();
                                </script>
                            </div>
                        </div>
                    </div>
                    <div id="background_lamp" class="bg-black transform hidden  fixed top-0 left-0 w-full h-full z-20"></div>
                </div>
            </section>
            <section id="sidebar-section" class="lg:col-span-3 col-span-12">
                <div class="bg-[#171717] p-2 rounded-lg">
                    @include('themes::themerophim.sidebar')
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/themes/rophim/static/js/custom.js"></script>
    <script src="/themes/rophim/static/player/skin/juicycodes.js"></script>
    <link href="/themes/rophim/static/player/skin/juicycodes.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/themes/rophim/static/css/netflix.css" />
    <script src="/themes/rophim/static/player/jwplayer.js"></script>

    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('player-wrapper');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;

            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('bg-red-600');
            })
            el.classList.add('bg-red-600')

            renderPlayer(type, link, id);
        }

        function encryptUrl(url) {
            return btoa(
                url
                .split("")
                .map((char) => String.fromCharCode(char.charCodeAt(0) + 1))
                .join("")
            ).replace(/={2}$/, "")
        }

        async function renderPlayer(type, link, id) {
            const url = new URL(link);
            const {
                hostname,
                pathname
            } = url;

            let urlNoAds = link;

            if (link.includes("opstream")) {
                if (pathname.endsWith(".m3u8")) {
                    urlNoAds =
                        `https://nguonc.apith.xyz/ostream/${encryptUrl(hostname)}/${pathname.slice(1).split('/').filter(Boolean).slice(0, -1).join("/")}`
                } else {
                    urlNoAds =
                        `https://nguonc.apith.xyz/ostream/${encryptUrl(hostname)}/${pathname.slice(1).split('/').filter(Boolean).at(-1)}`
                }
            } else if (link.includes("phim1280")) {
                if (pathname.endsWith(".m3u8")) {
                    urlNoAds =
                        `https://kkphim.apith.xyz/stream?url=${link}`
                }
            }
            const data = await fetch(urlNoAds).then(res => res.ok ? res.text() : res.json());
            if (typeof data === "string") type = "m3u8";
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "/themes/rophim/static/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    file: urlNoAds,
                    type: "hls",
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    autostart: true,
                    controls: true,
                    type: "hls",
                    description: "{{ $currentMovie->name }} - Tập {{ $episode->name }}",
                    primary: "html5",
                    skin: {
                        name: "netflix"
                    },
                    abouttext: 'Tham gia cộng đồng Rổ Phim',
                    aboutlink: 'https://t.me/+z49SfoKsTZ00OGRl',
                    playbackRateControls: true,
                    playbackRates: [0.5, 0.75, 1, 1.5, 2],
                    volume: 100,
                    mute: false,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua",
                        admessage: "Quảng cáo còn xx giây."
                    },
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    // if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                    //     var engine = new p2pml.hlsjs.Engine(engine_config);
                    //     player.setup(objSetup);
                    //     jwplayer_hls_provider.attach();
                    //     p2pml.hlsjs.initJwPlayer(player, {
                    //         liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                    //         maxBufferLength: 300,
                    //         loader: engine.createLoaderClass(),
                    //     });
                    // } else {
                    player.setup(objSetup);
                    // }
                } else {
                    player.setup(objSetup);
                }

                player.addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rewind2" viewBox="0 0 240 240" focusable="false"><path d="m 25.993957,57.778 v 125.3 c 0.03604,2.63589 2.164107,4.76396 4.8,4.8 h 62.7 v -19.3 h -48.2 v -96.4 H 160.99396 v 19.3 c 0,5.3 3.6,7.2 8,4.3 l 41.8,-27.9 c 2.93574,-1.480087 4.13843,-5.04363 2.7,-8 -0.57502,-1.174985 -1.52502,-2.124979 -2.7,-2.7 l -41.8,-27.9 c -4.4,-2.9 -8,-1 -8,4.3 v 19.3 H 30.893957 c -2.689569,0.03972 -4.860275,2.210431 -4.9,4.9 z m 163.422413,73.04577 c -3.72072,-6.30626 -10.38421,-10.29683 -17.7,-10.6 -7.31579,0.30317 -13.97928,4.29374 -17.7,10.6 -8.60009,14.23525 -8.60009,32.06475 0,46.3 3.72072,6.30626 10.38421,10.29683 17.7,10.6 7.31579,-0.30317 13.97928,-4.29374 17.7,-10.6 8.60009,-14.23525 8.60009,-32.06475 0,-46.3 z m -17.7,47.2 c -7.8,0 -14.4,-11 -14.4,-24.1 0,-13.1 6.6,-24.1 14.4,-24.1 7.8,0 14.4,11 14.4,24.1 0,13.1 -6.5,24.1 -14.4,24.1 z m -47.77056,9.72863 v -51 l -4.8,4.8 -6.8,-6.8 13,-12.99999 c 3.02543,-3.03598 8.21053,-0.88605 8.2,3.4 v 62.69999 z"></path></svg>',
                    "Forward 10 Seconds", () => player.seek(player.getPosition() + 10), "Forward 10 Seconds");
                player.addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rewind" viewBox="0 0 240 240" focusable="false"><path d="M113.2,131.078a21.589,21.589,0,0,0-17.7-10.6,21.589,21.589,0,0,0-17.7,10.6,44.769,44.769,0,0,0,0,46.3,21.589,21.589,0,0,0,17.7,10.6,21.589,21.589,0,0,0,17.7-10.6,44.769,44.769,0,0,0,0-46.3Zm-17.7,47.2c-7.8,0-14.4-11-14.4-24.1s6.6-24.1,14.4-24.1,14.4,11,14.4,24.1S103.4,178.278,95.5,178.278Zm-43.4,9.7v-51l-4.8,4.8-6.8-6.8,13-13a4.8,4.8,0,0,1,8.2,3.4v62.7l-9.6-.1Zm162-130.2v125.3a4.867,4.867,0,0,1-4.8,4.8H146.6v-19.3h48.2v-96.4H79.1v19.3c0,5.3-3.6,7.2-8,4.3l-41.8-27.9a6.013,6.013,0,0,1-2.7-8,5.887,5.887,0,0,1,2.7-2.7l41.8-27.9c4.4-2.9,8-1,8,4.3v19.3H209.2A4.974,4.974,0,0,1,214.1,57.778Z"></path></svg>',
                    "Rewind 10 Seconds", () => player.seek(player.getPosition() - 10), "Rewind 10 Seconds");

                const resumeData = 'OPCMS-PlayerPosition-' + id;

                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() -
                                    currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>
    <script type="module">
        function next() {
            $("#episodes .active").toggleClass('active').next().toggleClass('active')[0].click()
        }

        function prev() {
            $("#episodes .active").toggleClass('active').prev().toggleClass('active')[0].click()
        }

        $("#prev").click(prev)
        $("#next").click(next)
    </script>
    <script>
        $("#btn_lightbulb").click(function() {
            var $this = $(this);
            var $overlay = $('#background_lamp');
            var $text = $('#lightbulb-text');
    
            if ($this.hasClass('off')) {
                $this.removeClass('off');
                $this.attr('title', 'Tắt đèn');
                $text.text('Tắt đèn');
                $overlay.toggleClass('hidden');
            } else {
                $this.addClass('off');
                $this.attr('title', 'Bật đèn');
                $text.text('Bật đèn');
                $overlay.toggleClass('hidden');
            }
        });
    </script>
@endpush
