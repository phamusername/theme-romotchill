<div class="relative tabpanel">
    <style>
        .tabs-navigation li.active {
            background-color: #333;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }
    </style>
    <ul class="w-auto flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row gap-y-2 tabs-navigation">
        <li role="presentation" class="text-white hover:text-gray-200 text-[14px] font-medium cursor-pointer transition-all ease-linear duration-100 rounded-sm px-3 py-1 uppercase block active">
            <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Phim bộ mới</a>
        </li>
        <li role="presentation" class="text-white hover:text-gray-200 text-[14px] font-medium cursor-pointer transition-all ease-linear duration-100 rounded-sm px-3 py-1 uppercase block">
            <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Phim lẻ mới</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="pt-3 tab-pane active">
            <div class="grid grid-cols-2 gap-x-4 sm:gap-x-4 gap-y-3 md:grid-cols-4">
                @foreach ($phimbomoi as $movie)
                    <div>
                        <article class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2 bg-[#181818]">
                            <a title="{{$movie->name}}" href="{{$movie->getUrl()}}" class="relative">
                                <img data-src="{{$movie->getThumbUrl()}}" alt="{{$movie->name}}" loading="lazy" title="{{$movie->name}}" class="object-cover lozad object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200" src="{{$movie->getThumbUrl()}}" data-loaded="true">
                            </a>
                            <div class="mt-3 px-2">
                                <a title="{{$movie->name}}" class="block truncate" href="{{$movie->getUrl()}}">
                                    <h3 class="text-[15px] font-medium capitalize pt-1 block truncate">{{$movie->name}}</h3>
                                    <span class="text-sm font-medium text-gray-400 truncate">{{$movie->origin_name}}</span>
                                </a>
                            </div>
                            <span class="font-medium text-xs py-[3px] px-1 block rounded-br-md rounded-tr-md bg-[#A3765D] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{$movie->episode_current}}</span>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="tab-2" class="pt-3 tab-pane">
            <div class="grid grid-cols-2 gap-x-4 sm:gap-x-4 gap-y-3 md:grid-cols-4">
                @foreach ($phimlemoi as $movie)
                <div>
                    <article class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2 bg-[#181818]">
                        <a title="{{$movie->name}}" href="{{$movie->getUrl()}}" class="relative">
                            <img data-src="{{$movie->getThumbUrl()}}" alt="{{$movie->name}}" loading="lazy" title="{{$movie->name}}" class="object-cover lozad object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200" src="{{$movie->getThumbUrl()}}" data-loaded="true">
                        </a>
                        <div class="mt-3 px-2">
                            <a title="{{$movie->name}}" class="block truncate" href="{{$movie->getUrl()}}">
                                <h3 class="text-[15px] font-medium capitalize pt-1 block truncate">{{$movie->name}}</h3>
                                <span class="text-sm font-medium text-gray-400 truncate">{{$movie->origin_name}}</span>
                            </a>
                        </div>
                        <span class="font-medium text-xs py-[3px] px-1 block rounded-br-md rounded-tr-md bg-[#A3765D] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{$movie->episode_current}}</span>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Add jQuery to enable tab switching -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Khi người dùng click vào tab
        $('.tabs-navigation a').click(function (e) {
            e.preventDefault(); // Ngừng hành động mặc định của thẻ <a>

            // Xóa class active khỏi tất cả các tab và nội dung
            $('.tabs-navigation li').removeClass('active');
            $('.tab-pane').removeClass('active');

            // Thêm class active cho tab và nội dung được chọn
            $(this).parent().addClass('active');
            $($(this).attr('href')).addClass('active');
        });
    });
</script>
