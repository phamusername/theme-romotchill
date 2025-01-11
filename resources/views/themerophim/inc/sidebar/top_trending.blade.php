<div class="w-full">
    <span class="uppercase text-gray-200 text-md font-medium border-b border-zinc-800 w-full block pb-2">{{ $top['label'] }}</span>
    <ul id="tabss" class="flex list-none mb-2 pt-2 flex-wrap flex-row">
        <li class="-mb-px mr-2 cursor-pointer last:mr-0 flex-auto text-center">
            <a class="bg-zinc-700 text-[14px] font-medium px-3 py-1 block text-gray-100" href="#ngay">Ngày</a>
        </li>
        <li class="-mb-px mr-2 cursor-pointer last:mr-0 flex-auto text-center">
            <a class="text-[14px] font-medium px-3 py-1 block text-gray-100" href="#tuan">Tuần</a>
        </li>
        <li class="-mb-px mr-2 cursor-pointer last:mr-0 flex-auto text-center">
            <a class="text-[14px] font-medium px-3 py-1 block text-gray-100" href="#thang">Tháng</a>
        </li>
    </ul>
    <div id="tabs-contents" class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
        <div id="ngay" class="px-2 py-3 flex-auto">
            @foreach ($top['data']['d'] as $key => $movie)
            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }} "
                class="grid items-center grid-cols-12 pb-2 over:shadow-xl transform group hover:opacity-80 hover:scale-105 duration-300 gapx-3">
                <div class="col-span-2">
                    <div class="text-gray-200 font-medium text-md hover:shadow-lg">
                        <span
                            class="leading-7 text-xs bg-[#c58560] w-7 h-7 inline-block rounded-full text-center">{{ $loop->iteration }}</span>
                    </div>
                </div>
                <div class="col-span-10 ml-1"><span data-v-1ec6a80f=""
                        class="block text-gray-200 truncate capitalize">{{ $movie->name }} </span><span
                        class="text-xs text-gray-400">{{ number_format($movie->view_day) }} lượt xem</span></div>
            </a>
            @endforeach
        </div>
        <div id="tuan" class="hidden px-2 py-3 flex-auto">
            @foreach ($top['data']['w'] as $key => $movie)
            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }} "
                class="grid items-center grid-cols-12 pb-2 over:shadow-xl transform group hover:opacity-80 hover:scale-105 duration-300 gapx-3">
                <div class="col-span-2">
                    <div class="text-gray-200 font-medium text-md hover:shadow-lg">
                        <span
                            class="leading-7 text-xs bg-[#c58560] w-7 h-7 inline-block rounded-full text-center">{{ $loop->iteration }}</span>
                    </div>
                </div>
                <div class="col-span-10 ml-1"><span data-v-1ec6a80f=""
                        class="block text-gray-200 truncate capitalize">{{ $movie->name }} </span><span
                        class="text-xs text-gray-400">{{ number_format($movie->view_week) }} lượt xem</span></div>
            </a>
            @endforeach
        </div>
        <div id="thang" class="hidden px-2 py-3 flex-auto">
            @foreach ($top['data']['m'] as $key => $movie)
            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }} "
                class="grid items-center grid-cols-12 pb-2 over:shadow-xl transform group hover:opacity-80 hover:scale-105 duration-300 gapx-3">
                <div class="col-span-2">
                    <div class="text-gray-200 font-medium text-md hover:shadow-lg">
                        <span
                            class="leading-7 text-xs bg-[#c58560] w-7 h-7 inline-block rounded-full text-center">{{ $loop->iteration }}</span>
                    </div>
                </div>
                <div class="col-span-10 ml-1"><span data-v-1ec6a80f=""
                        class="block text-gray-200 truncate capitalize">{{ $movie->name }} </span><span
                        class="text-xs text-gray-400">{{ number_format($movie->view_month) }} lượt xem</span></div>
            </a>
            @endforeach
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabsContainer = document.querySelector("#tabss");
        const tabTogglers = tabsContainer.querySelectorAll("a");
        const tabContents = document.querySelector("#tabs-contents").children;

        tabTogglers.forEach((toggler, index) => {
            toggler.addEventListener("click", function(e) {
                e.preventDefault();
                const tabName = this.getAttribute("href").substring(1);

                for (let i = 0; i < tabContents.length; i++) {
                    tabContents[i].classList.add("hidden");
                    tabTogglers[i].classList.remove("bg-zinc-700", "text-white");
                    tabTogglers[i].classList.add("text-gray-100");
                }

                document.getElementById(tabName).classList.remove("hidden");
                this.classList.remove("text-gray-100");
                this.classList.add("bg-zinc-700", "text-white");
            });
        });
    });
</script>
