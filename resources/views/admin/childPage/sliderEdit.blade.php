@extends('admin.admin')

@section('content')
    <?php
        $locale = app()->getLocale();
    ?>

    <div class="flex title-line">
        <h2>
            @if ($sliderId == 'slider1')
               @lang('utge.slider-feed')
            @endif

            @if ($sliderId == 'slider2')
                @lang('utge.slider-staves')
            @endif

            @if ($sliderId == 'slider3')
                @lang('utge.slider-product')
            @endif

            @if ($sliderId == 'slider4')
                @lang('utge.slider-service')
            @endif

        </h2>

        <a href="{{ route('childPage.sliderCreate') }}" class="add-button action-button">
            <img src="{{ asset('img/add.svg') }}" alt="Add">
        </a>
    </div>

    <div class="error">
        @if ($errors->any())
                @foreach ($errors->all() as $error)
                        <div class="error-item"><img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error"><p class="error-desc">{{ $error }}</p></div>
                @endforeach
        @endif
    </div>

    @foreach ($sliderImages as $sliderImg)
        @php
            $title = $sliderImg->localization[0];

        @endphp

        <div class="box-slider-page">
            <form action="{{ route('childPage.update', $sliderImg->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="image-slide flex-col current-slide image-slider-page">

                    <label class="image-changes" for="image-changes-{{ $sliderImg->id }}"><img class="old-image" src="{{ $sliderImg->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}"></label>
                    <p class="image-changes-desc">@lang('admin.update-image')</p>
                    <button class="image-changes-bt add-button" form="image-change-{{ $sliderImg->id }}" type="submit">@lang('admin.save-new-phot')</button>    

                </div>

                <div class="name-slide flex-col current-slide update-text-slider-page">
                    <div>
                        <div class="input-wrap">
                            <input type="text" name="title_uk" id="title_uk" value="{{ $title->uk }}">
                            <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
                        </div>
                        <div class="input-wrap">
                            <input type="text" name="title_ru" id="title_ru" value="{{ $title->ru }}">
                            <label class="label" for="title_ru">@lang('admin.add_ru_title')</label>
                        </div>
                        <div class="input-wrap name-box">
                            <input type="text" name="slider_link" value="{{ $sliderImg->localization[1]->$locale }}" id="slider_link" class="name-input-ru">
                            <label class="label" for="slider_link">@lang('admin.models-url')</label>
                        </div>
                        <div class="input-wrap name-box">
                            <input type="number" name="slider_order" value="{{ $sliderImg->order }}" id="slider_order" class="name-input-ru">
                            <label class="label" for="slider_order">@lang('admin.models-slider_order')</label>
                        </div>
                    </div>

                    <div class="slider-page-actions-btn">
                        <a href="{{ route('childPage.delete', $sliderImg->id) }}"></a>

        

                        <button type="submit" class="add-button" id="save-btn">
                            <img src="{{ asset('img/save.svg') }}" alt="Add">
                        </button>
                    </div>
                </div>


            </form>

            
            
            <form id="image-change-{{ $sliderImg->id }}" class="image-changes-form"  method="POST" action="{{ route('childPage.mediaUpdate', $sliderImg->id ) }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="test">
                <input id="image-changes-{{ $sliderImg->id }}" type="file" name="image">

                <input type="submit" value="img">
            </form>


        </div>
    @endforeach

    <script src="{{ asset('js/slider_edit.js') }}"></script>
@endsection

