<form id="form-filter" method="GET" action="/">
    <div class="flex flex-wrap text-gray-200 my-2">
        <div class="w-1/2 sm:w-48 pr-2 mb-2">
            <div class="relative mt-1">
                <select name="filter[sort]" form="form-filter"
                    class="relative w-full cursor-default rounded-lg bg-zinc-800 py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:ring-opacity-75 focus-visible:ring-offset-orange-300 text-sm"
                    id="order">
                    <option class="text-gray-200 block truncate" value="">Sắp xếp</option>
                    <option value="update" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'update') selected @endif>Thời gian cập nhật</option>
                    <option value="create" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'create') selected @endif>Thời gian đăng</option>
                    <option value="year" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'year') selected @endif>Năm sản xuất</option>
                    <option value="view" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'view') selected @endif>Lượt xem</option>
                </select>
            </div>
        </div>
        <div class="w-1/2 sm:w-48 pr-2 mb-2">
            <div class="relative mt-1">
                <select name="filter[type]" form="form-filter" class="relative w-full cursor-default rounded-lg bg-zinc-800 py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:ring-opacity-75 focus-visible:ring-offset-orange-300 text-sm" id="type">
                    <option value="">Định dạng</option>
                    <option value="series" @if (isset(request('filter')['type']) && request('filter')['type'] == 'series') selected @endif>Phim bộ</option>
                    <option value="single" @if (isset(request('filter')['type']) && request('filter')['type'] == 'single') selected @endif>Phim lẻ</option>
                </select>
            </div>
        </div>
        <div class="w-1/2 sm:w-48 pr-2 mb-2">
            <div class="relative mt-1">
                <select name="filter[category]" form="form-filter" class="relative w-full cursor-default rounded-lg bg-zinc-800 py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:ring-opacity-75 focus-visible:ring-offset-orange-300 text-sm" id="cat_id">
                    <option value="">Thể loại</option>
                    @foreach (\Ophim\Core\Models\Category::fromCache()->all() as $item)
                        <option value="{{ $item->id }}" @if (
                            (isset(request('filter')['category']) && request('filter')['category'] == $item->id) ||
                                (isset($category) && $category->id == $item->id)) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-1/2 sm:w-48 pr-2 mb-2">
            <div class="relative mt-1">
                <select name="filter[region]" form="form-filter" class="relative w-full cursor-default rounded-lg bg-zinc-800 py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:ring-opacity-75 focus-visible:ring-offset-orange-300 text-sm" id="city_id">
                    <option value="">Quốc gia</option>
                    @foreach (\Ophim\Core\Models\Region::fromCache()->all() as $item)
                        <option value="{{ $item->id }}" @if (
                            (isset(request('filter')['region']) && request('filter')['region'] == $item->id) ||
                                (isset($region) && $region->id == $item->id)) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-1/2 sm:w-48 pr-2 mb-2">
            <div class="relative mt-1">
                <select name="filter[year]" form="form-filter" class="relative w-full cursor-default rounded-lg bg-zinc-800 py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:ring-opacity-75 focus-visible:ring-offset-orange-300 text-sm" id="year">
                    <option value="">Năm</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @if (isset(request('filter')['year']) && request('filter')['year'] == $year) selected @endif>
                            {{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center w-full pt-1">
            <input form="form-filter" type="submit" class="cursor-pointer px-5 py-2 mb-2 text-sm rounded-full font-medium translate-y-1 bg-[#A3765D] hover:opacity-90 text-gray-300" value="Lọc phim">
        </div>
    </div>
</form>
