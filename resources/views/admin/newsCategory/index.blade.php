@extends('admin.admin')

@section('content')

    @php
        $locale = app()->getLocale();
    @endphp

    <div class="flex title-line">
        <h2>@lang('admin.category_list')</h2>
        <a href="{{ route('newsCategory.create') }}" class="add-button action-button">
            <img src="{{ asset('img/add.svg') }}" alt="Add">
        </a>
    </div>

    <table class="product-table">
        <tr>
            <th>@lang('admin.title')</th>
            <th>@lang('admin.action')</th>
        </tr>
        @foreach ($newsCategories as $newsCategory)

        @php
            $title = $newsCategory->localization[0];
        @endphp

        <tr>
            <td>{{ $title->$locale }}</td>
            <td class="action">
                <a title="Редагувати" href="{{ route('newsCategory.edit', $newsCategory->id) }}"></a>
                <a title="Видалити" href="{{ route('newsCategory.delete', $newsCategory->id) }}"></a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
