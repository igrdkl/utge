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
    <li><a href="#" class="rotute-btn current-btn">@lang('admin.page')</a></li>
    <li><a href="#" class="seo-btn">SEO</a></li>
</ul>

<form id="form" action="{{ route('seo.store') }}" method="POST" enctype="multipart/form-data"
    class="current-slide-wrap">
    @csrf

    <div class="name-slide flex-col current-slide">
        <select name="route">
            <option value="http://utge">@lang('admin.home-page')</option>
            <option value="http://utge/products">@lang('admin.product-page')</option>
            <option value="http://utge/deliveriesAndPayments">@lang('admin.delivery-page')</option>
            <option value="http://utge/news">@lang('admin.news-page')</option>
            <option value="http://utge/contacts">@lang('admin.contacts-page')</option>
        </select>
    </div>

    <div class="flex-col">

        <div class="flex">
            <div class="input-wrap mr-seo-input">
                <input type="text" name="title_seo_uk" class="title_seo_uk" id="title_seo_uk"
                    value="{{ old('title_seo_uk') }}">
                <label class="label" for="title_seo_uk">@lang('admin.add_title_seo_uk')</label>
            </div>


            <div class="input-wrap">
                <input type="text" class="title_seo_ru" id="title_seo_ru" value="{{ old('title_seo_ru') }}"
                    name="title_seo_ru">
                <label class="label" for="title_seo_ru">@lang('admin.add_title_seo')</label>
            </div>
        </div>

        <div class="flex">
            <div class="input-wrap mr-seo-input">
                <input type="text" class="title_seo_uk" id="og_title_seo_uk" value="{{ old('og_title_seo_uk') }}"
                    name="og_title_seo_uk">
                <label class="label" for="og_title_seo_uk">@lang('admin.og_add_title_seo_uk')</label>
            </div>


            <div class="input-wrap">
                <input type="text" class="title_seo_ru" id="og_title_seo_ru" value="{{ old('og_title_seo_ru') }}"
                    name="og_title_seo_ru">
                <label class="label" for="og_title_seo_ru">@lang('admin.og_add_title_seo')</label>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="og_desc_seo_uk">@lang('admin.og_add_desc_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_uk" name="og_desc_seo_uk"
                    id="">{{ old('og_desc_seo_uk') }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="og_desc_seo_ru">@lang('admin.og_add_desc_seo')</label>
                <textarea class="seo-textarea desc_seo_ru" name="og_desc_seo_ru"
                    id="og_desc_seo_ru">{{ old('og_desc_seo_ru') }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="desc_seo_uk">@lang('admin.add_desc_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_uk" name="desc_seo_uk" id="">{{ old('desc_seo_uk') }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="desc_seo_ru">@lang('admin.add_desc_seo')</label>
                <textarea class="seo-textarea desc_seo_ru" name="desc_seo_ru"
                    id="desc_seo_ru">{{ old('desc_seo_ru') }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="keywords_seo_uk">@lang('admin.add_key_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_other" name="keywords_seo_uk"
                    id="keywords_seo_uk">{{ old('keywords_seo_uk') }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="keywords_seo_ru">@lang('admin.add_key_seo')</label>
                <textarea class="seo-textarea desc_seo_other" name="keywords_seo_ru"
                    id="keywords_seo_ru">{{ old('keywords_seo_ru') }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label class="label seo-label" for="custom_seo_uk">@lang('admin.add_custom_seo_uk')</label>
                <textarea class="seo-textarea desc_seo_other" name="custom_seo_uk"
                    id="custom_seo_uk">{{ 'custom' }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label class="label seo-label" for="custom_seo_ru">@lang('admin.add_custom_seo')</label>
                <textarea class="seo-textarea desc_seo_other" name="custom_seo_ru"
                    id="custom_seo_ru">{{ 'custom' }}</textarea>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/create.js') }}"></script>
<script src="{{ asset('js/seo.js') }}"></script>
@endsection
