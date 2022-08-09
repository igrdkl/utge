@extends('site.index')

@section('content')

    @php
        $locale = app()->getLocale();
    @endphp

    <section class="delivery">
        <h2>@lang('utge.delivery')</h2>

        <div class="wrapper delivery-list">
            @foreach ($deliveries as $item)
                @php
                    $title = $item->localization[0];
                    $description = $item->localization[1];
                @endphp

                <figure class="delivery-card shadow-box flex-aic">
                    <div class="img-wrap">
                        <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}">
                    </div>
                    <figcaption>
                        <h3>{{ $title->$locale }}</h2>
                        <p>{!! $description->$locale !!}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>
    <section class="delivery payment">
        <h2>@lang('utge.payment')</h2>

        <div class="wrapper delivery-list payment-list">
            @foreach ($payments as $item)
                @php
                    $title = $item->localization[0];
                    $description = $item->localization[1];
                @endphp

                <figure class="delivery-card shadow-box flex-aic">
                    <div class="img-wrap">
                        <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}">
                    </div>
                    <figcaption>
                        <h3>{{ $title->$locale }}</h2>
                        <p>{!! $description->$locale !!}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>

@endsection
