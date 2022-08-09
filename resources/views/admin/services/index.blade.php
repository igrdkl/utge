@extends('admin.admin')


    @section('content')
    <?php
        $locale = app()->getLocale();
    ?>

    <div class="flex title-line">
        <h2>@lang('admin.services_list')</h2>
        <a href="{{ route('services.create') }}" class="add-button action-button">
            <img src="{{ asset('img/add.svg') }}" alt="Add">
        </a>
    </div>


        <table class="product-table">
            <thead>
                <tr>
                    <th>@lang('admin.title')</th>
                    <th>@lang('admin.service_sizeprice')</th>
                    <th>@lang('admin.action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                @php
                    $title = $service->localization[0];
                @endphp
                <tr>
                    <td>{{$title->$locale}}</td>
                    <td>
                        @foreach ($service->servicessizeprice as $sizeprice)
                            @if ($sizeprice->materials != null)
                                <p>
                                    {{ $sizeprice->materials }}
                                    /
                                    {{ $sizeprice->price }}грн
                                </p>
                            @else
                                <p>
                                    {{ $sizeprice->price }}грн

                                </p>
                            @endif
                        @endforeach
                        {{-- {{dd($product->sizeprice)}} --}}
                    </td>
                    <td class="action">
                        <a title="Редагувати" href="{{ route('services.edit', $service->id) }}"></a>
                        <a title="Видалити" href="{{ route('services.delete', $service->id) }}"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>




    <div class="pagination">
        {{ $services->withQueryString()->links('vendor.pagination.utge-pagination') }}
    </div>

    @endsection
