@php
    $locale = app()->getLocale();
    $isName = false;
@endphp

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @foreach ($seos as $seo)
        @php
            if(!isset($seo->localization[0])){
                $seo->localization[0] = 'def';
            } else {
                $title_seo = $seo->localization[0];
            }
            $og_title_seo = $seo->localization[1];
            $desc_seo = $seo->localization[2];
            $og_desc_seo = $seo->localization[3];
            $key_seo = $seo->localization[4];
            $custom_seo = $seo->localization[5];
        @endphp


        @switch(Request::url() == $seo->route)

            @case("http://utge/news")
            @case("http://utge/products")
            @case("http://utge/contacts")
            @case("http://utge")
            @case("http://utge/deliveriesAndPayments")

                <title>{{$title_seo->$locale}}</title>
                <meta property="og:url" content="{{ Request::url() }}">
                <meta property="og:title" content="{{ $og_title_seo->$locale }}">
                <meta property="og:description" content="{{ $og_desc_seo->$locale }}">
                <meta property="og:type" content="website">
                <meta property="og:img" content="{{Request::url()}}/public/img/logo.png">
                <meta name="description" content="{{ $desc_seo->$locale }}">
                <meta name="keywords" content="{{ $key_seo->$locale }}">
                    @if(is_string(htmlspecialchars_decode($custom_seo->$locale)) && stristr(htmlspecialchars_decode($custom_seo->$locale), '<script>'))
                        {!! htmlspecialchars_decode($custom_seo->$locale) !!}
                    @else
                        {{$custom_seo->$locale = false}}
                    @endif

                @break

            @default

        @endswitch

    @endforeach
    @yield('seo')
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
</head>

<body>
    <header>
        <div class="wrapper">
            <div class="info-line flex-sb">
                <div class="phone flex-aic">
                    <svg>
                        <use xlink:href="{{ asset('img/sprite.svg#tel') }}"></use>
                    </svg>
                    <ul class="phone-list">
                        @foreach ($phones as $item)
                            @php
                                $phone = $item->localization[0];
                                $phoneHref = preg_replace( "/[^0-9]/" , '' , $phone->$locale );
                            @endphp
                        <li><a href="tel:+{{ $phoneHref }}">{{ $phone->$locale }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="logo">
                    <a class="flex-col" href="{{ route('index') }}">
                        @foreach ($logoName as $item)
                            @if (isset($item) && !empty($item))
                                @php
                                    $name = $item->localization[0];
                                    $isName = true;
                                @endphp
                            @endif
                        @endforeach

                        @foreach ($logoImg as $item)
                            @if (isset($item) && !empty($item))
                                <img src="{{ $item->getFirstMediaUrl('images') }}" alt=" @if ($isName == true) {{ $name->$locale }} @endif " />
                            @endif
                        @endforeach

                        @if ($isName == true)
                            <h1>{{ $name->$locale }}</h1>
                        @endif
                    </a>
                </div>
                <div class="control flex-sb">
                    <form action="{{ route('basket') }}" method="POST">
                        @csrf
                        @method('POST')

                        <label><input type="hidden" name="products" id="basket_products" value=""></label>
                        <label class="basket flex-sb">
                            <span></span>
                            <svg>
                                <use xlink:href="{{ asset('img/sprite.svg#basket') }}"></use>
                            </svg>
                            <input type="submit">
                        </label>
                    </form>

                    <a href="{{ route('favourite') }}" class="like">
                        <span></span>
                        <svg>
                            <use xlink:href="{{ asset('img/sprite.svg#like') }}"></use>
                        </svg>
                    </a>
                    <p class="lang-select">
                        @if (app()->getLocale() == 'uk')
                        <a href="{{ route('locale', 'uk') }}" class="flex lang-uk selected-lang">
                            <svg class="flag">
                                <use xlink:href="{{ asset('img/sprite.svg#uk_flag') }}"></use>
                            </svg>
                            <span>УКР</span>
                        </a>
                        <a href="{{ route('locale', 'ru') }}" class="flex lang-ru">
                            <svg class="flag">
                                <use xlink:href="{{ asset('img/sprite.svg#uk_flag') }}"></use>
                            </svg>
                            <span>РУС</span>
                        </a>
                        @elseif(app()->getLocale() == 'ru')
                        <a href="{{ route('locale', 'uk') }}" class="flex lang-uk">
                            <svg class="flag">
                                <use xlink:href="{{ asset('img/sprite.svg#uk_flag') }}"></use>
                            </svg>
                            <span>УКР</span>
                        </a>
                        <a href="{{ route('locale', 'ru') }}" class="flex lang-ru selected-lang">
                            <svg class="flag">
                                <use xlink:href="{{ asset('img/sprite.svg#uk_flag') }}"></use>
                            </svg>
                            <span>РУС</span>
                        </a>
                        @endif
                        <script src="{{ asset('js/lang.js') }}"></script>
                    </p>
                </div>
            </div>
        </div>
        <div class="menu">
            <a href="#" class="burger-btn">
                <span class="menu-text">@lang('utge.menu')</span>
                <span class="burger"></span>
            </a>

            <nav>
                <span class="close"><svg>
                    <use xlink:href="{{ asset('img/sprite.svg#close') }}"></use>
                </svg></span>
                <div class="wrapper">
                    <ul class="flex-sb">
                        <li><a href="{{ route('index') }}">@lang('utge.main')</a></li>
                        <li class="sub-menu-parent">
                            <a href="{{ route('products') }}">@lang('utge.goods')</a>
                            @php

                                $url = Request::url();
                                $e = explode('/', $url);
                                $r = [3 => 'products'];
                                $er = array_replace($e,$r);
                                $urlp = implode('/', $er);

                            @endphp
                            <div class="sub-menu">
                                @foreach ($categories as $category)
                                    <a href="products?categoryid_{{$category->id}}={{$category->id}}">{{ $category->localization[0]->$locale }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="sub-menu-parent">
                            <a href="{{ route('services') }}">@lang('utge.services')</a>
                            <div class="sub-menu">
                                @foreach ($servicesType as $serviceType)
                                    <a href="{{ route('service', $serviceType->id) }}">{{ $serviceType->localization[0]->$locale }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li><a href="{{ route('deliveriesAndPayments') }}">@lang('utge.delivery-payment')</a></li>
                        <li><a href="{{ route('news') }}">@lang('utge.news')</a></li>
                        <li><a href="{{ route('contacts') }}">@lang('utge.contacts')</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="wrapper">
            <div class="info-line flex-sb">
                <div class="phone flex-aic">
                    <svg>
                        <use xlink:href="{{ asset('img/sprite.svg#tel') }}"></use>
                    </svg>
                    <ul class="phone-list">
                        @foreach ($phones as $item)
                            @php
                                $phone = $item->localization[0];
                                $phoneHref = preg_replace( "/[^0-9]/" , '' , $phone->$locale );
                            @endphp
                            <li><a href="tel:+{{ $phoneHref }}">{{ $phone->$locale }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="address flex-aic">
                    <svg>
                        <use xlink:href="{{ asset('img/sprite.svg#gps') }}"></use>
                    </svg>
                    <address>
                        @foreach ($footerPlace as $item)
                            @php
                                $place = $item->localization[0];
                            @endphp
                                {!! $place->$locale !!}
                        @endforeach
                    </address>
                </div>
                <div class="mail flex-aic">
                    <svg>
                        <use xlink:href="{{ asset('img/sprite.svg#email') }}"></use>
                    </svg>
                    <div class="flex-col-left">
                    @foreach ($email as $item)
                        @php
                            $email = $item->localization[0];
                        @endphp
                        <a href="mailto:{{ $email }}">{{ $email->$locale }}</a>
                    @endforeach
                    </div>
                </div>
            </div>
            <p class="copy">&copy; utge since 2016</p>
        </div>
    </footer>

<script src="{{ asset('js/public.js') }}"></script>
<script src="{{ asset('js/add_to_basket.js') }}"></script>
<script src="{{ asset('js/favourite.js') }}"></script>

</body>

</html>
