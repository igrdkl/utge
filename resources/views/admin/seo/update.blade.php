@extends('admin.admin')
@section('content')

<?php
        $locale = app()->getLocale();
?>

<div class="flex title-line">
    <h2>@lang('admin.seo_create')</h2>
    <button type="submit" form="form" class="add-button" id="save-btm">
        <img src="{{ asset('img/save.svg') }}" alt="Add">
    </button>
</div>

<ul class="create-list flex">
    <li><a href="#" class="seo-btn current-btn">SEO</a></li>
</ul>

<form id="form" action="{{ route('seo.update', $seo->id) }}" method="POST" enctype="multipart/form-data"
    class="current-slide-wrap">
    @csrf
    @method('PUT')

    @php
        $title_seo = $seo->localization[0];
        $og_title_seo = $seo->localization[1];
        $desc_seo = $seo->localization[2];
        $og_desc_seo = $seo->localization[3];
        $key_seo = $seo->localization[4];
        $custom_seo = $seo->localization[5];
    @endphp


    <div class="flex-col current-slide">

        <div class="flex">
            <div class="input-wrap mr-seo-input">
                <input type="text" name="title_seo_uk" class="title_seo_uk" id="title_seo_uk"
                    value="{{ $title_seo->uk }}">
                <label class="label" for="title_seo_uk">@lang('admin.add_title_seo_uk')</label>
            </div>


            <div class="input-wrap">
                <input type="text" class="title_seo_ru" id="title_seo_ru" value="{{ $title_seo->ru }}"
                    name="title_seo_ru">
                <label class="label" for="title_seo_ru">@lang('admin.add_title_seo')</label>
            </div>
        </div>

        <div class="flex">
            <div class="input-wrap mr-seo-input">
                <input type="text" class="title_seo_uk" id="og_title_seo_uk" value="{{ $og_title_seo->uk }}"
                    name="og_title_seo_uk">
                <label class="label" for="og_title_seo_uk">@lang('admin.og_add_title_seo_uk')</label>
            </div>


            <div class="input-wrap">
                <input type="text" class="title_seo_ru" id="og_title_seo_ru" value="{{ $og_title_seo->ru }}"
                    name="og_title_seo_ru">
                <label class="label" for="og_title_seo_ru">@lang('admin.og_add_title_seo')</label>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="og_desc_seo_uk">@lang('admin.og_add_desc_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_uk" name="og_desc_seo_uk"
                    id="">{{ $og_desc_seo->uk }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="og_desc_seo_ru">@lang('admin.og_add_desc_seo')</label>
                <textarea class="seo-textarea desc_seo_ru" name="og_desc_seo_ru"
                    id="og_desc_seo_ru">{{ $og_desc_seo->ru }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="desc_seo_uk">@lang('admin.add_desc_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_uk" name="desc_seo_uk" id="">{{ $desc_seo->uk }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="desc_seo_ru">@lang('admin.add_desc_seo')</label>
                <textarea class="seo-textarea desc_seo_ru" name="desc_seo_ru"
                    id="desc_seo_ru">{{ $desc_seo->ru }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="keywords_seo_uk">@lang('admin.add_key_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_other" name="keywords_seo_uk"
                    id="keywords_seo_uk">{{ $key_seo->uk }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="keywords_seo_ru">@lang('admin.add_key_seo')</label>
                <textarea class="seo-textarea desc_seo_other" name="keywords_seo_ru"
                    id="keywords_seo_ru">{{ $key_seo->ru }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="custom_seo_uk">@lang('admin.add_custom_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_other" name="custom_seo_uk"
                    id="custom_seo_uk">{{ htmlspecialchars_decode($custom_seo->uk) }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="custom_seo_ru">@lang('admin.add_custom_seo')</label>
                <textarea class="seo-textarea desc_seo_other" name="custom_seo_ru"
                    id="custom_seo_ru">{{ htmlspecialchars_decode($custom_seo->ru) }}</textarea>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/create.js') }}"></script>
<script src="{{ asset('js/seo.js') }}"></script>
@endsection
