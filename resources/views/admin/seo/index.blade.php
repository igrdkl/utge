@extends('admin.admin')
@section('content')

<?php
        $locale = app()->getLocale();
    ?>

<div class="flex title-line">
    <h2>SEO</h2>
    <a href="{{ route('seo.create') }}" class="add-button action-button">
        <img src="{{ asset('img/add.svg') }}" alt="Add">
    </a>
</div>
<div class="list-filter-wrapp">
        <table class="product-table">
            <thead>
                <tr>
                    <th>@lang('admin.title-page')</th>
                    <th>@lang('admin.action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seos as $seo)
                <tr>
                    @if ($seo->route == 'http://utge/news')
                        <td>@lang('admin.news-page')</td>
                    @elseif ($seo->route == 'http://utge/products')
                        <td>@lang('admin.product-page')</td>
                    @elseif ($seo->route == 'http://utge/deliveriesAndPayments')
                        <td>@lang('admin.delivery-page')</td>
                    @elseif ($seo->route == 'http://utge/contacts')
                        <td>@lang('admin.contacts-page')</td>
                    @elseif ($seo->route == 'http://utge')
                        <td>@lang('admin.home-page')</td>
                    @endif

                    <td class="action">
                        <a title="Редагувати" href="{{ route('seo.edit', $seo->id) }}"></a>
                        <a title="Редагувати" href="{{ route('seo.delete', $seo->id) }}"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


@endsection
