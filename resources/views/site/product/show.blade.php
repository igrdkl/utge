@extends('site.index')

@section('seo')

    @php
        $locale = app()->getLocale();
        
        $title_seo = $product->localization[1];
        $og_title_seo = $product->localization[2];
        $desc_seo = $product->localization[4];
        $og_desc_seo = $product->localization[5];
        $key_seo = $product->localization[6];
        // $custom_seo = $product->localization[7];

    @endphp

    <meta property="og:image" content="{{ $product->getFirstMediaUrl('images') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::url()}}">
    <meta property="og:title" content="{{ $og_title_seo->$locale }}">
    <meta property="og:description" content="{{ $og_desc_seo->$locale }}">
    <meta name="description" content="{{ $desc_seo->$locale }}">
    <meta name="keywords" content="{{ $key_seo->$locale }}">
    {{-- <meta property="" content="{{ $custom_seo->$locale }}"> --}}
    <title>{{ $title_seo->$locale }}</title>

@endsection

@section('content')

@php
    $locale = app()->getLocale();
    $title = $product->localization[0];
    $description = $product->localization[3];

    $min_price = $size;


    if ($product->sizeprices->where('size', $size)->first()->available == 1) {
        $available = 'available';
    } elseif ($product->sizeprices->where('size', $size)->first()->available == 2) {
        $available = 'not_available';
    } elseif ($product->sizeprices->where('size', $size)->first()->available == 3) {
        $available = 'waiting_available';
    } else {
        $available = 'available_for_order';
    }
@endphp

<div class="wrapper">
    <figure id="product" class="product_id current-product flex-sb {{ $available }}" data-product-id="{{ $product->id }}">
        <div class="img-half shadow-box">
            <p class="status">@lang('admin.'.$available)</p>
            <div class="img-wrap">
                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}">
            </div>
        </div>
        <section class="desc-half">
            <h2>{{ $title->$locale }}</h2>
            <div class="desc-wrap shadow-box">
                <p class="desc">
                    {!! $description->$locale !!}
                </p>
                <p class="certificate-line">
                    @if($product->getFirstMediaUrl('pdf') == null)
                        <a href="#" class="button details-btn">@lang('utge.quality-certificate')</a>
                    @else
                        <a href="{{ ($product->getFirstMediaUrl('pdf')) }}" class="button details-btn">@lang('utge.quality-certificate')</a>
                    @endif
                </p>
            </div>
            <div class="size-line flex-aic">
                @if($product->mass_id == 1)
                <p class="mass_netto">@lang('admin.massa_neto')</p>
                @endif
                @foreach ($product->sizePrices as $sizePrice)
                    @if ($sizePrice->size == $min_price)
                        <a href="{{ route('product', ['id' => $product->id, 'size' => $sizePrice->size],$product->localization[0]) }}" class="price active-size">{{ $sizePrice->size }}</a>
                    @else
                        <a href="{{ route('product', ['id' => $product->id, 'size' => $sizePrice->size], $product->localization[0]) }}" class="price">{{ $sizePrice->size }}</a>
                    @endif
                @endforeach

            </div>
            <hr>
            <div class="price-line flex-sb">
                <p class="general-price">
                    @lang('utge.price'): <span class="active-price">{{ $product->sizePrices->where('size', $size)->first()->price }}</span> {{ $product->sizePrices->where('size', $size)->first()->price_units }}
                </p>
                <div class="right-part flex-aic">
                    <form action="#" class="count-col">
                        <button class="product-minus">-</button>
                        <label>
                            <input type="number" name="product-quantify" class="product-quantify" value="1">
                        </label>
                        <button class="product-plus">+</button>
                    </form>
                    <p class="add-to-basket flex-aic">
                        <svg>
                            <use xlink:href="{{ asset('img/sprite.svg#basket') }}"></use>
                        </svg>
                        <span>
                            @lang('utge.add-to-basket')
                        </span>
                    </p>
                </div>
            </div>
        </section>
    </figure>
</div>
<div class="add-to-basket-popup">
    <div class="close-basket-popup-btn"><span></span><span></span></div>
    <p>@lang('utge.add-to-basket-popup')</p>
</div>

<script src="{{ asset('js/current_product.js') }}"></script>

@endsection
