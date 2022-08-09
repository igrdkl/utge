@extends('site.index')

<?php
    $locale = app()->getLocale();
?>

@section('content')

<div class="wrapper services">
    @foreach ($services as $service)
        @php
            $title = $service->localization[0];
            $description = $service->localization[1];
        @endphp
        <figure class="service shadow-box">
            <h2 class="flex-aic"><span>{{ $title->$locale }}</span></h2>
            <img src="{{ $service->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}">
            <figcaption>
                <p class="desc">
                    {{$description->$locale}}
                </p>
                <div class="button-line">
                    <a href="{{ route('service', $service->id) }}" class="details-btn">
                        @lang('utge.more')
                    </a>
                </div>
            </figcaption>
        </figure>
    @endforeach
</div>

@endsection
