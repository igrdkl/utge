@extends('site.index')

<?php
    $locale = app()->getLocale();
?>
@section('content')

<div class="services-show">

    @foreach ($types as $type)
        @php
            $title_type = $type->localization[0];
            $desc_type = $type->localization[1];
        @endphp
        <h3>{{ $title_type->$locale }}</h3>
        <p class="wrapper services-desc">{{ $desc_type->$locale }}</p>
    @endforeach
    <div class="wrapper service-table-box">
        <table class="service-table">
            <tr class="service-units">
                <td>@lang('utge.type-work')</td>
                <td>@lang('utge.material')</td>
                <td>@lang('utge.units')</td>
                <td>@lang('utge.price-units')</td>
            </tr>
            @foreach ($categories as $category)
                @php
                    $title_category = $category->localization[0];
                @endphp
                <tr class="service-category">
                    <td  colspan="4">{{ $title_category->$locale }}</td>
                </tr>
                    @foreach ($services as $service)
                        @php
                            $title_service = $service->localization[0];
                            $materials = $service->localization[1];
                        @endphp
                        @if ($service->service_category_id == $category->id)

                            @foreach ($service->servicesSizePrice as $item)
                                {{-- @dump($item->service_id) --}}
                            @endforeach

                            @if (empty($materials->$locale))
                                <tr class="service-item">
                                    <td>{{ $title_service->$locale }}</td>
                                    <td></td>
                                    <td>{{ $service->servicesSizePrice[0]->units}}</td>
                                    <td>{{ $service->servicesSizePrice[0]->price}}</td>
                                </tr>
                            @else
                                <tr class="service-item">
                                    <td>{{ $title_service->$locale }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($service->servicesSizePrice as $sizePrize)
                                <tr class="service-item">
                                    <td></td>
                                    <td class="service-item-materials">{{ $materials->$locale}}</td>
                                    <td>{{ $sizePrize->units}}</td>
                                    <td>{{ $sizePrize->price}}</td>
                                </tr>
                                @endforeach
                            @endif
                        @endif
                    @endforeach
            @endforeach
        </table>
    </div>
    <div class="wrapper">
        <div class="service-btn" id="popupBtn">
            <p>@lang('utge.order-service')</p>
        </div>
    </div>
    <div id="popupBox">
        <div id="popupCloseBox"></div>
        <div class="service-popup" id="popup">
            <div class="close-popup-btn">
                <span></span>*
                <span></span>
            </div>
            <p>@lang('utge.order-service')</p>
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
                    <label for="interes">@lang('utge.interes-service')<span>*</span></label>
                    <textarea name="interes" id="interes"></textarea>
                </div>
                <i><span>*</span>@lang('utge.i')</i>
                <button for="service-form" type="submit">надіслати</button>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/site.js') }}"></script>
<script src="{{ asset('js/popup.js') }}"></script>

@endsection
