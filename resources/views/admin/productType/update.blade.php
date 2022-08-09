@extends('admin.admin')

@section('content')

    @php
        $locale = app()->getLocale();
    @endphp

<div class="error">
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                    <div class="error-item"><img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error"><p class="error-desc">{{ $error }}</p></div>

            @endforeach
    @endif
</div>

    <div class="flex title-line">
        <h2>@lang('admin.product_type_change')</h2>
        <button type="submit" form="form" class="add-button">
            <img src="{{ asset('img/save.svg') }}" alt="Add">
        </button>
    </div>

    <ul class="create-list flex">
        <li><a href="#" class="name-btn current-btn">@lang('admin.title')</a></li>
    </ul>

    <form id="form" action="{{ route('productType.update', $productType->id) }}" method="POST" class="current-slide-wrap">

        @csrf
        @method('PUT')

        @php
            $title = $productType->localization[0];
        @endphp

        <div class="name-slide flex-col current-slide">
            <div class="input-wrap">
                <input type="text" id="title_uk" name="title_uk" value="{{ $title->uk }}">
                <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
            </div>
            <div class="input-wrap">
                <input type="text" id="title_ru" name="title_ru" value="{{ $title->ru }}">
                <label class="label" for="title_ru">@lang('admin.add_ru_title')</label>
            </div>
        </div>

    </form>
    <script src="{{ asset('js/create.js') }}"></script>
    <script src="{{ asset('js/simpleVisualTextEditor.js') }}"></script>
@endsection
