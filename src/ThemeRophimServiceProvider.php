<?php

namespace Ophim\ThemeRophim;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeRophimServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/rophim')
        ], 'rophim-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'rophim' => [
                'name' => 'Rophim',
                'author' => 'contact.animehay@gmail.com',
                'package_name' => 'ggg3/theme-romotchill',
                'publishes' => ['rophim-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations',
                        'label' => 'Phim đề cử',
                        'type' => 'code',
                        'hint' => 'display_label|find_by_field|value|limit|sort_by_field|sort_algo',
                        'value' => <<<EOT
                        Phim HOT|is_copyright|0|10|view_week|desc
                        Phim đề cử|is_recommended|1|10|view_week|desc
                        Phim ngẫu nhiên|random|random|10|view_week|desc
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 48,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 24,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url',
                        'value' => <<<EOT
                        Phim mới cập nhật||is_copyright|0|12|/danh-sach/phim-moi
                        Phim chiếu rạp mới||is_shown_in_theater|1|12|/danh-sach/phim-chieu-rap
                        Phim bộ mới||type|series|12|/danh-sach/phim-bo
                        Phim lẻ mới||type|single|12|/danh-sach/phim-le
                        Phim hoạt hình|categories|slug|hoat-hinh|12|/the-loai/hoat-hinh
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_thumb|top_trending)',
                        'value' => <<<EOT
                        Trending|trending|||||6|top_trending
                        Top phim lẻ||type|single|view_week|desc|6|top_thumb
                        Top phim bộ||type|series|view_week|desc|6|top_thumb
                        Bảng xếp hạng||is_copyright|0|view_week|desc|6|top_thumb
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => '',
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <footer class="border border-zinc-800 bg-black mx-auto text-gray-100 mt-2">
                            <div class="flex flex-col justify-between py-10 gap-10 px-6 space-y-8 lg:flex-row lg:space-y-0">
                                <div class="lg:w-1/3">
                                    <a href="/" class="flex justify-center space-x-3 lg:justify-start">
                                        <div class="flex items-center justify-center pb-2">
                                            <img src="/logo.webp" width="150" height="35" alt="Rổ Phim" loading="lazy" data-nuxt-img="">
                                        </div>
                                    </a>
                                    <div class="pt-2">
                                        <p class="text-gray-300 text-sm">
                                            <a class="text-[#d98a5e] hover:opacity-90"
                                                href="/"><strong>Rổ Phim</strong></a> - Trang web xem phim trực tuyến miễn phí
                                            chất lượng cao với giao diện trực quan, tốc độ tải trang nhanh, cùng kho phim với hơn
                                            10.000+ phim mới, phim hay, luôn cập nhật phim nhanh, hứa hẹn sẽ đem lại phút giây thư giãn
                                            cho bạn.
                                        </p>        
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 text-base gap-x-3 gap-y-8 lg:w-2/3 md:grid-cols-3">
                                    <div class="space-y-3">
                                        <span class="tracking-wide uppercase text-gray-50">Danh Mục</span>  
                                        <ul class="space-y-1">
                                            <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Mới"
                                                href="/danh-sach/phim-moi">Phim Mới</a></li>
                                            <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Chiếu Rạp"
                                                href="/danh-sach/phim-chieu-rap">Phim Chiếu Rạp</a></li>
                                            <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Bộ"
                                                href="/danh-sach/phim-bo">Phim Bộ</a></li>
                                            <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Lẻ"
                                                href="/danh-sach/phim-le">Phim Lẻ</a></li>
                                        </ul>    
                                    </div> 
                                    <div class="space-y-3">
                                        <span class="uppercase text-gray-50">Thể Loại</span>
                                            <ul class="space-y-1">
                                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Cổ Trang"
                                                    href="/the-loai/co-trang">Phim Cổ Trang</a></li>
                                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Đam Mỹ"
                                                    href="/the-loai/hanh-dong">Phim Hành Động</a></li>
                                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Bách Hợp"
                                                    href="/the-loai/hoat-hinh">Phim Hoạt Hình</a></li>
                                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Phim Viễn Tưởng"
                                                    href="/the-loai/vien-tuong">Phim Viễn Tưởng</a></li>
                                            </ul>
                                    </div>
                                    <div class="space-y-3"><span class="tracking-wide uppercase text-gray-50">Điều Khoản</span>
                            <ul class="space-y-1">
                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="DMCA"
                                        href="/dmca">DMCA</a></li>
                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Liên Hệ"
                                        href="/lien-he">Liên Hệ</a></li>
                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Privacy"
                                        href="#">Privacy</a></li>
                                <li><a class="text-sm text-gray-400 hover:text-blue-600" title="Terms of Service"
                                        href="#">Terms of Service</a></li>
                            </ul>
                        </div>
                                </div>                           
                            </div>
                            <div class="py-3 text-sm text-center text-gray-400 relative border-t border-zinc-700"><span>© 2024 Rổ Phim.
                        All rights reserved.</span><button type="button"
                        class="bg-zinc-700 px-3 py-1.5 absolute right-2 top-1 rounded-sm" aria-label="Back to top"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5"></path>
                        </svg></button></div>
                        </footer>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'show_fb_comment_in_single',
                        'label' => 'Show FB Comment In Single',
                        'type' => 'boolean',
                        'value' => false,
                        'tab' => 'FB Comment'
                    ]
                ],
            ]
        ])]);
    }
}
