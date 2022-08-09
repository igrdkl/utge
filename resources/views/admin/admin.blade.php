<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simpleVisualTextEditor.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>@lang('admin.utge_admin') @lang('admin.product_list')</title>
</head>
<body>
    <header>
        <div class="header-line flex">
            <ul class="header-menu flex">

                <li class="li-home">
                    <a href="{{ route('admin') }}" class="home flex">
                        <img src="{{ asset('img/home.svg') }}" alt="Home">
                    </a>
                </li>
                <li class="li-add">
                    <a href="#" class="add drop-btn">@lang('admin.add')</a>

                    <div class="add-menu drop-list hidden">
                        <ul>
                            <li><a href="{{ route('product.create') }}"><span class="link-text-drop-list">@lang('admin.product')</span></a></li>
                            <li><a href="{{ route('services.create') }}"><span class="link-text-drop-list">@lang('admin.services')</span></a></li>
                            <li><a href="{{ route('news.create') }}"><span class="link-text-drop-list">@lang('admin.news')</span></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <p class="lang-select">
                @if (app()->getLocale() == 'uk')
                    <a href="{{ route('locale', 'uk') }}" class="flex lang-uk selected-lang"><img src="{{ asset('img/uk_flag.svg') }}" alt=""><span>УКР</span></a>
                    <a href="{{ route('locale', 'ru') }}" class="flex lang-ru"><img src="{{ asset('img/uk_flag.svg') }}" alt=""><span>РУС</span></a>
                @elseif(app()->getLocale() == 'ru')
                    <a href="{{ route('locale', 'uk') }}" class="flex lang-uk"><img src="{{ asset('img/uk_flag.svg') }}" alt=""><span>УКР</span></a>
                    <a href="{{ route('locale', 'ru') }}" class="flex lang-ru selected-lang"><img src="{{ asset('img/uk_flag.svg') }}" alt=""><span>РУС</span></a>
                @endif
            </p>
        </div>
    </header>
    <aside>
        <p class="logo">
            <a href="{{ route('index') }}" class="flex">
                <img src="{{ asset('img/logo.png') }}" alt="Hashtag logo">
            </a>
        </p>
        <nav>
            <ul class="aside-menu">
                <li>
                    <a href="#" class="drop-btn product-btn"><span class="link-text">@lang('admin.products')</span></a></li>

                    <div class="drop-list hidden">
                        <ul>
                            <li><a href="{{ route('product.index') }}"><span class="link-text-drop-list">@lang('admin.products')</span></a></li>
                            <li><a href="{{ route('subCategory.index') }}"><span class="link-text-drop-list">@lang('admin.subcategory_product')</span></a></li>
                            <li><a href="{{ route('category.index') }}"><span class="link-text-drop-list">@lang('admin.categories_product')</span></a></li>
                            <li><a href="{{ route('productType.index') }}"><span class="link-text-drop-list">@lang('admin.product_types')</span></a></li>


                        </ul>
                    </div>
                <li>
                    <a href="#" class="drop-btn services-btn"><span span class="link-text">@lang('admin.services')</span></a></li>

                    <div class="drop-list hidden">
                        <ul>
                            <li><a href="{{ route('services.index') }}"><span class="link-text-drop-list">@lang('admin.services')</span></a></li>
                            <li><a href="{{ route('servicesTypes.index') }}"><span class="link-text-drop-list">@lang('admin.services_types')</span></a></li>
                            <li><a href="{{ route('servicesCategory.index') }}"><span class="link-text-drop-list">@lang('admin.services_category')</span></a></li>
                        </ul>
                    </div>
                <li>

                    @if(!empty($counts = count($servicesOrders)) || !empty($countp = count($productsOrders)))
                        @if (!isset($countp))
                        @php
                            $countp = count($productsOrders);
                        @endphp
                            <a href="#" class="drop-btn orders-btn"><span class="link-text aside-menu-item">@lang('admin.orders')<span class="order-circle-counter aside-menu-item">
                                <span>
                                    {{ $counts + $countp }}
                                </span>
                            </span></a></li>
                        @else
                            <a href="#" class="drop-btn orders-btn"><span class="link-text aside-menu-item">@lang('admin.orders')<span class="order-circle-counter aside-menu-item">
                                <span>
                                    {{ $counts + $countp }}
                                </span>
                            </span></a></li>
                        @endif
                    @else
                        <a href="#" class="drop-btn orders-btn"><span class="link-text">@lang('admin.orders')</span></a></li>
                    @endif

                    <div class="drop-list hidden">
                        <ul>
                            @if(!empty($count = count($servicesOrders)))
                                <li><a href="{{ route('servicesOrder.index') }}"><span class="link-text-drop-list aside-menu-item">@lang('admin.services')<span class="order-circle-counter"><span>{{ $counts }}</span></span></a></li>
                            @else
                                <li><a href="{{ route('servicesOrder.index') }}"><span class="link-text-drop-list">@lang('admin.services')<span></span></span></a></li>
                            @endif
                            @if(!empty($countp = count($productsOrders)))
                                <li><a href="{{ route('productsOrder.index') }}"><span class="link-text-drop-list aside-menu-item">@lang('admin.products')<span class="order-circle-counter"><span>{{ $countp }}</span></span></a></li>
                            @else
                                <li><a href="{{ route('productsOrder.index') }}"><span class="link-text-drop-list">@lang('admin.products')<span></span></span></a></li>
                            @endif
                        </ul>
                    </div>

                <li>
                    <a href="#" class="drop-btn news-btn"><span class="link-text">@lang('admin.news')</span></a></li>

                    <div class="drop-list hidden">
                        <ul>
                            <li><a href="{{ route('news.index') }}"><span class="link-text-drop-list">@lang('admin.news')</span></a></li>
                            <li><a href="{{ route('newsCategory.index') }}"><span class="link-text-drop-list">@lang('admin.category_news')</span></a></li>

                        </ul>
                    </div>
                <li><a href="{{ route('childPage.index') }}" class="module-btn"><span class="link-text">@lang('admin.modules')</span></a></li>
                <li><a href="{{ route('seo.index') }}" class="seo-btn"><span class="link-text">SEO</span></a></li>
                <li><a href="https://analytics.google.com/analytics/web/#/p325179285/reports/reportinghub?params=_u..nav%3Dmaui&collectionId=life-cycle" class="analitics-btn"><span class="link-text">Google Analitics</span></a></li>

                @if(!empty($count = count($trashProduct)))
                <li><a href="{{ route('trashBox.index') }}" class="trash-btn"><span class="link-text">@lang('admin.trash_box')<span class="trash-circle-counter"><span>{{ $count }}</span></span></a></li>
                @else
                <li><a href="{{ route('trashBox.index') }}" class="trash-btn"><span class="link-text">@lang('admin.trash_box')</span></a></li>
                @endif

            </ul>
        </nav>
        <p class="copy">
            <a href="https://hashtag.net.ua/" class="flex">
                <img src="{{ asset('img/hashtag_logo.svg') }}" alt="Hashtag logo">
            </a>
        </p>
    </aside>
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('js/lang.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}" type="module"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>
</body>
</html>
