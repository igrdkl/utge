@extends('site.index')

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp

<div class="wrapper">
    <div class="main-contacts-header">
        <div class="own-section">
            @foreach ($contacts as $item)
                @php
                    $title = $item->localization[0];
                    $description = $item->localization[1];
                @endphp
        
                <div class="own-block">
                    <div class="own-block-title">
                        <span>
                            <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}">
                        </span>
                        <h3>{{ $title->$locale }}</h2>
                    </div>
                    {!! $description->$locale !!}
                </div>
            @endforeach
        </div>
    
        <div class="feedback-section">
            <div class="service-popup">
                <p>@lang('utge.feedback-form')</p>
                <form class="service-form" id="service-form" action="{{ route('storeServiceOrder') }}" method="POST">
                    @csrf
                    @method('POST')
        
                    <div>
                        <div class="service-form-item">
                            <div>
                                <label for="firstname">@lang('utge.firstname')<span>*</span></label>
                                <input required id="firstname" type="text" name="firstname">
                            </div>
                            <div>
                                <label for="lastname">@lang('utge.lastname')<span>*</span></label>
                                <input required id="lastname" type="text" name="lastname">
                            </div>
                        </div>
                        <div class="service-form-item">
                            <div>
                                <label for="popup-phone">@lang('utge.number-phone')<span>*</span></label>
                                <input required id="popup-phone" type="text" name="phone">
                            </div>
                            <div>
                                <label for="mail">E-Mail</label>
                                <input id="mail" type="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="interes">@lang('utge.form-message')<span>*</span></label>
                        <textarea name="interes" id="interes"></textarea>
                    </div>
                    <i><span>*</span>@lang('utge.i')</i>
                    <button for="service-form" type="submit">надіслати</button>
                </form>
            </div>
        </div>
    </div>

    <div class="map-section">
        <h3 class="map-section-title">
            <svg><use xlink:href="{{ asset('img/sprite.svg#globus') }}"></use></svg>
            @lang('utge.contact-map')
        </h3>
        <div class="map">
            <iframe src="https://www.google.com/maps/d/embed?mid=1bfywxVrKQe2RLd_IV4VH6Z5_jgHCyJU&ehbc=2E312F" width="100%" height="120%"></iframe>
        </div>
    </div>
</div>

@endsection
