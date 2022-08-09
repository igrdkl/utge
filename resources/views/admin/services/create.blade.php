@extends('admin.admin')
@section('content')

    <?php

    $locale = app()->getLocale();

    ?>
        <div class="error">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    @if (strripos($error, '/') == true)
                        <div class="error-item">
                            <img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error">

                            <p class="error-desc">
                                @switch(explode('/', $error)[0])
                                    @case('materials')
                                        @lang('admin.error-material')
                                        @break

                                    @case('price')
                                        @lang('admin.error-price')
                                        @break

                                    @case('units')
                                        @lang('admin.error-price_units')
                                        @break


                                    @default

                                @endswitch

                                <?= ' '.explode('/', $error)[1];?>
                            </p>
                        </div>
                    @else
                        <div class="error-item"><img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error"><p class="error-desc">{{ $error }}</p></div>
                    @endif
                @endforeach

        @endif
        </div>

    <div class="flex title-line">
        <h2>@lang('admin.services_create')</h2>
        <button type="submit" form="form" class="add-button" id="save-btn">
            <img src="{{ asset('img/save.svg') }}" alt="Add">
        </button>
    </div>

    <ul class="create-list flex">
        <li><a href="#" class="name-btn current-btn">@lang('admin.title')</a></li>
        <li><a href="#" class="sp-btn">@lang('admin.services_sizeprice')</a></li>
        <li><a href="#" class="another-btn">@lang('admin.another')</a></li>
    </ul>

    <form id="form" action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="current-slide-wrap">
        @csrf

        <div class="name-slide flex-col current-slide">
            <div class="input-wrap">
                <input type="text" id="title_uk" value="{{ old('title_uk') }}" name="title_uk">
                <label class="label" for="title_uk" >@lang('admin.add_uk_title')</label>
            </div>
            <div class="input-wrap">
                <input type="text" id="title_ru" name="title_ru" value="{{ old('title_ru')}}">
                <label class="label" for="title_ru">@lang('admin.add_ru_title')</label>
            </div>
        </div>

        <div class="size-price-slide flex-col">
            <div class="size-price">
                <div class="size size1">
                    <div class="input-wrap">
                        <input type="text" id="materials_uk1" name="materials_uk/1" class="auto-value" value="{{ old('materials_uk') }}" >
                        <label class="label" for="materials_uk1" >@lang('admin.add_title_materials')</label>
                    </div>
                    <div class="input-wrap">
                        <input type="text" id="materials_ru1" name="materials_ru/1" class="auto-value" value="{{ old('materials_ru')}}">
                        <label class="label" for="materials_ru1">@lang('admin.add_title_ru_materials')</label>
                    </div>

                    <div class="input-wrap">
                        <input type="text" name="price/1" value="{{ old('price/1') }}" id="price1" class="auto-value">
                        <label class="label" for="price1">@lang('admin.add_price')</label>
                    </div>

                    <div class="input-wrap">
                        <input type="text" name="units/1" value="{{ old('units/1') }}" id="units1" class="auto-value">
                        <label class="label" for="units1">@lang('admin.add_units')</label>
                    </div>
                    <div class="input-wrap size-price-bt-wrap">
                        <button class="size-price-bt-min" data-size-num="1"><span class="btn-w-sp"><span>@lang('admin.delete_material_price')</span><img src="{{ asset('img/minus-label.svg') }}" ></span></button>
                    </div>
                </div>
            </div>
            <div class="size-price-bt-wrap">
                <button id="add-size-price" class="size-price-bt-pl"><span class="btn-w-sp"><span>@lang('admin.add_material_price')</span><img src="{{ asset('img/plus-label.svg') }}" ></span></button>
            </div>
            <input type="hidden" name="sizecount" value="1" id="product-counter">
        </div>
        <div class="another-slide flex-col">
            <div class="input-wrap sub-category-wrap">
                <p class="label">Виберіть категорію</p>
                <div class="flex-space sub-category-wrap">
                    <label><input type="hidden" name="service_category_id"></label>

                    @foreach ($servicesCategories as $sevicesCategory)
                        @php
                            $title = $sevicesCategory->localization[0];
                        @endphp

                        <input class="radio-change" type="radio" id="{{ $sevicesCategory->id }}" name="service_category_id" value="{{ $sevicesCategory->id }}">
                        <label class="radio-label" for="{{ $sevicesCategory->id }}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                    @endforeach
                </div>
            </div>

        <script>
            function getStructure(counter) {
                return structure = `
                    <div class="size size${counter}">

                        <div class="input-wrap">
                            <input type="text" id="materials_uk${counter}" value="{{ old('materials_uk') }}" name="materials_uk/${counter}">
                            <label class="label" for="materials_uk${counter}">@lang('admin.add_title_materials')</label>
                        </div>
                        <div class="input-wrap">
                            <input type="text" id="materials_ru${counter}" name="materials_ru/${counter}" value="{{ old('materials_ru')}}">
                            <label class="label" for="materials_ru${counter}">@lang('admin.add_title_ru_materials')</label>
                        </div>

                        <div class="input-wrap">
                            <input type="number" name="price/${counter}" id="price${counter}" class="auto-value">
                            <label class="label" for="price${counter}">@lang('admin.add_price')</label>
                        </div>

                        <div class="input-wrap">
                            <input type="text" name="units/${counter}" id="units${counter}" class="auto-value">
                            <label class="label" for="units${counter}">@lang('admin.add_units')</label>
                        </div>
                        <div class="input-wrap size-price-bt-wrap">
                            <button class="size-price-bt-min" data-size-num="${counter}"><span class="btn-w-sp"><span>@lang('admin.delete_material_price')</span><img src="{{ asset('img/minus-label.svg') }}" ></span></button>
                        </div>
                    </div>
                `;
            }

        </script>
        <script src="{{ asset('js/sizeprice.js') }}"></script>
    </form>
    <script src="{{ asset('js/create.js') }}"></script>
    <script src="{{ asset('js/seo.js') }}"></script>
    <script src="{{ asset('js/simpleVisualTextEditor.js') }}"></script>
@endsection
