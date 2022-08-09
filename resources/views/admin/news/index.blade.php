@extends('admin.admin')

@section('content')

<?php
        $locale = app()->getLocale();
?>

<div class="flex title-line">
    <h2>@lang('admin.news')</h2>
    <a href="{{ route('news.create') }}" class="add-button action-button">
        <img src="{{ asset('img/add.svg') }}" alt="Add">
    </a>
</div>

<div class="list-filter-wrapp">
    <div class="y">
        <table class="product-table">
            <thead>
                <tr>
                    <th>@lang('admin.image')</th>
                    <th>@lang('admin.title')</th>
                    <th>@lang('admin.action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                @php
                $title = $item->localization[0];
                $description = $item->localization[1];
                @endphp
                <tr>
                    <td class="product-image"><img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}"></td>
                    <td>{{ $title->$locale }}</td>
                    <td class="action">
                        <a title="Редагувати" href="{{ route('news.edit', $item->id) }}"></a>
                        <a title="Видалити" href="{{ route('news.delete', $item->id) }}"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <form class="filter-form" action="{{ route('news.index') }}" method="GET">

        <p class="filter-item-title">@lang('admin.filters')</p>


        <p class="filter-item-desc">@lang('admin.to_category')</p>
        <div class="filter-item">
            @foreach ($newsCategories as $newsCategory)

            @php
                $title = $newsCategory->localization[0];
            @endphp

                <input class="filter-item-checkbox" id="newsCategoryid_{{$newsCategory->id}}" type="checkbox" name="newsCategoryid_{{$newsCategory->id}}" value="{{$newsCategory->id}}" @if (isset($_GET['newsCategoryid_'.$newsCategory->id])) @if ($_GET['newsCategoryid_'.$newsCategory->id] == $newsCategory->id) checked @endif @endif>
                <label class="filter-item-label" for="newsCategoryid_{{$newsCategory->id}}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>

            @endforeach
        </div>


        <div class="filter-item filter-setting-button">
            <input class="filter-item-button-button" id="filter-item-button" type="submit" value="filter">
            <button class="filter-item-button-label" for="filter-item-button-label">@lang('admin.search')</button>
        </div>

    </form>

</div>
@endsection
