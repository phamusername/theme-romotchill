@extends('themes::themerophim.layout_core')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $logo = setting('site_logo', '');
    preg_match('@src="([^"]+)"@', $logo, $match);

    // will return /images/image.jpg
    $logo = array_pop($match);
@endphp

@push('header')
    {{-- <link rel="stylesheet" href="/themes/rophim/static/css/app.css"> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="/themes/rophim/static/css/owl.carousel.css" />
    <link defer href="https://fonts.googleapis.com/css?family=Roboto:400,300,500" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/themes/rophim/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/themes/rophim/static/js/jquery.slimscroll.min.js" defer></script>
    <script type="text/javascript" src="/themes/rophim/static/js/bootstrap2.min.js" defer></script>
    <style>
        html {
            background: #1b1b1b
        }
    </style>
@endpush

@section('body')
    <div>
        <div class="bg-[#424040] text-gray-200">
            <div class="bg-[#151414] max-w-[1150px] mx-auto md:px-4 px-1">
                @include('themes::themerophim.inc.header')
                <main class="px-3 sm:px-4">
                    {{-- <div>
                        <p class="text-sm p-1.5 border text-zinc-300 border-zinc-800 my-2 bg-black">
                            <span class="telegram-invite">
                                🎥 Tham gia ngay nhóm <a href="https://t.me/+z49SfoKsTZ00OGRl" target="_blank"
                                    rel="nofollow" class="font-medium text-[#d98a5e]">Telegram Phim Mới</a> để cập nhật các
                                bộ phim hay nhất và
                                ủng hộ Subteam. Chúc bạn xem phim vui vẻ!
                            </span>
                        </p>
                    </div> --}}
                    <div>
                        <div class="pt-4">
                            @if (get_theme_option('head_layout_text'))
                                {!! get_theme_option('head_layout_text') !!}
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </main>
                {!! get_theme_option('footer') !!}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @if (get_theme_option('ads_catfish'))
        <div id="catfish" style="width: 100%;position:fixed;bottom:0;left:0;z-index:222" class="mp-adz">
            <div style="margin:0 auto;text-align: center;overflow: visible;" id="container-ads">
                <div id="hide_catfish"><a
                        style="font-size:12px; font-weight:bold;background: #ff8a00; padding: 2px; color: #000;display: inline-block;padding: 3px 6px;color: #FFF;background-color: rgba(0,0,0,0.7);border: .1px solid #FFF;"
                        onclick="jQuery('#catfish').fadeOut();">Đóng quảng cáo</a></div>
                <div id="catfish_content" style="z-index:999999;">
                    {!! get_theme_option('ads_catfish') !!}
                </div>
            </div>
        </div>
    @endif

    <div id="fb-root"></div>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '{{ setting('social_facebook_app_id') }}',
                xfbml: true,
                version: 'v5.0'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/vi_VN/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript" src="/themes/rophim/static/js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            var owl = $("#film_hot").owlCarousel({
                loop: true,
                items: 5,
                itemsDesktop: [1199, 4],
                itemsTablet: [770, 3],
                itemsMobile: [640, 2],
                scrollPerPage: true,
                lazyLoad: true,
                navigation: false,
                slideSpeed: 800,
                paginationSpeed: 400,
                stopOnHover: true,
                pagination: false,
                autoPlay: 8000,
            });

            $("#customNextBtn").click(function() {
                owl.trigger('owl.next');
            });

            $("#customPrevBtn").click(function() {
                owl.trigger('owl.prev');
            });

            var first_img_w = $("#film_hot .img-film").eq(0).width();
            var first_img_h = first_img_w * (1.42);
            $("#film_hot .img-film").height(first_img_h);

            $(".film-moi .img-film").height(252);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lozad.js/1.0.8/lozad.min.js"
        integrity="sha512-Nt+V5JYamXCSvlHzNVleriGhTrolnfxckJ8sEXxv/BJ0tKV1HyPDXH+bIFNcUJ5hcthQ95uAeU2JClPT16mFyg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const observer = lozad();
        observer.observe();
    </script>
    <script>
        jQuery(document).ready(function() {
            let timeoutID = null;
            $("input[name=search]").keyup(function(e) {
                clearTimeout(timeoutID);
                var search = e.target.value;
                if (search.length <= 1) {
                    $(".search-suggest").hide();
                    return false;
                }
                timeoutID = setTimeout(() => searching(search), 0);
            });

            function searching(search) {
                $.ajax({
                    type: "get",
                    url: "/search/" + search,
                    dataType: "json",
                    success: function(response) {
                        let results = "";
                        $(".search-suggest").show();
                        for (let i = 0; i < response.data.length; i++) {
                            const element = response.data[i];
                            let img = `<img src="${element["thumb_url"]}" alt="${element["name"]}">`;
                            let name = `<p>${element["name"]}</p>`;
                            results +=
                                '<div class="pt-2"><a href="' +
                                element["url"] +
                                '" class="hover:bg-zinc-700 border-b border-zinc-700 grid items-center grid-cols-12 mb-2 gapx-3""><div class="col-span-3 m-1"><img class="h-16 w-16 object-cover" src="' +
                                element["thumb_url"] +
                                '"></div><div class="col-span-9 m-1"><span class="block font-medium text-gray-200 text-sm">' +
                                element["name"] +
                                '</span><span class="block episode-font text-sm text-zinc-400">' +
                                element["episode_current"] +
                                "</span></div></a></div>";
                        }
                        results +=
                            '<a class="py-1 text-sm text-[#d98a5e] text-center w-full block hover:bg-zinc-700" href="/?search=' +
                            search +
                            '">Xem tất cả kết quả "' +
                            search +
                            '" </a>';
                        $(".search-suggest").html(results);
                    },
                });
            }
        });
    </script>

    {!! setting('site_scripts_google_analytics') !!}
@endsection
