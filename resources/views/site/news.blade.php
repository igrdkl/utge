@extends('site.index')

@section('content')

@php
$locale = app()->getLocale();
@endphp

<div class="wrapper">
    <form id="filter" action="{{ route('news') }}"class="news-category-line flex-aic">
        <p class="category-wrap-btn">
            <input type="radio" name="category" id="all-news" @if (!isset($_GET['newsCategoryid_'])) checked @endif>
            <label for="all-news" class="flex-aic">@lang('utge.all_categories')</label>
        </p>
        @foreach ($newsCategories as $newsCategory)
        @php
            $title = $newsCategory->localization[0];
        @endphp
            <p class="category-wrap-btn"><input id="newsCategoryid_{{$newsCategory->id}}" type="radio" name="newsCategoryid_" value="{{$newsCategory->id}}" @if (isset($_GET['newsCategoryid_'])) @if ($_GET['newsCategoryid_'] == $newsCategory->id) checked @endif @endif>
            <label for="newsCategoryid_{{$newsCategory->id}}" class="flex-aic">{{ $title->$locale }}</label></p>
        @endforeach
    </form>


    <div class="news-list">
        @foreach ($news as $item)
            @php
                $title = $item->localization[0];
                $description = $item->localization[1];
            @endphp

            <article class="new shadow-box">
                <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}">
                <div class="new-desc">
                    <h3>{{ $title->$locale }}</h3>
                    <div class="desc">{!! $description->$locale !!}</div>
                </div>
            </article>
        @endforeach
    </div>

    <div class="pagination">
        <p class="page-link-previous"></p>
        <div class="flex-sb slider-nav">

        </div>
        <p class="page-link-next disabled"></p>
    </div>
</div>
<script src="{{ asset('js/news_filter.js') }}"></script>
@endsection
