@extends('admin.admin')

@section('content')

@php
$locale = app()->getLocale();
@endphp

@php
$title = $servicesCategory->localization[0];
@endphp

<div class="error">
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                    <div class="error-item"><img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error"><p class="error-desc">{{ $error }}</p></div>

            @endforeach
    @endif
</div>

<div class="flex title-line">
    <h2>@lang('admin.services_type_change')</h2>
    <button type="submit" form="form" class="add-button" id="save-btn">
        <img src="{{ asset('img/save.svg') }}" alt="Add">
    </button>
</div>

<ul class="create-list flex">
    <li><a href="#" class="name-btn current-btn">@lang('admin.title')</a></li>
    <li><a href="#" class="another-btn">@lang('admin.another')</a></li>
</ul>

<form id="form" class="current-slide-wrap" action="{{ route('servicesCategory.update', $servicesCategory->id) }}" method="POST">
    @csrf
    @method('PUT')

    @php
    $title = $servicesCategory->localization[0];
    @endphp

    <div class="name-slide flex-col current-slide">
        <div class="input-wrap">
            <input type="text" name="title_uk" id="title_uk" value="{{ $title->uk }}">
            <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
        </div>
        <div class="input-wrap">
            <input type="text" name="title_ru" id="title_ru" value="{{ $title->ru }}">
            <label class="label" for="title_ru">@lang('admin.add_ru_title')</label>
        </div>
    </div>

    <div class="desc-slide flex-col">
        <div class="another-slide flex-col">
            <div class="input-wrap sub-servicesType-wrap">
                <p class="label">Виберіть категорію</p>
                <div class="flex-space sub-servicesType-wrap">

                    @foreach ($servicesTypes as $servicesType)
                    @php
                    $title = $servicesType->localization[0];
                    @endphp

                    @if ($servicesType->id == $servicesCategory->service_type_id)

                    <input class="radio-change" id="subCategory{{$servicesType->id}}" type="radio" value="{{$servicesType->id}}"
                        name="service_type_id" checked>
                    <label class="radio-label" for="subCategory{{$servicesType->id}}"><span
                            class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                    @else
                    <input class="radio-change" id="subCategoryNon{{$servicesType->id}}" type="radio"
                        value="{{$servicesType->id}}" name="service_type_id">
                    <label class="radio-label" for="subCategoryNon{{$servicesType->id}}"><span
                            class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/create.js') }}"></script>
@endsection
