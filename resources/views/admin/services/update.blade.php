@extends('admin.admin')

@section('content')

@php
$locale = app()->getLocale();
@endphp


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

                                @case('price units')
                                    @lang('admin.error-units')
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
    <h2>@lang('admin.services-change')</h2>
    <button type="submit" form="form" class="add-button" id="save-btn">
        <img src="{{ asset('img/save.svg') }}" alt="Add">
    </button>
</div>

<ul class="create-list flex">
    <li><a href="#" class="name-btn current-btn">@lang('admin.title')</a></li>
    <li><a href="#" class="sp-btn">@lang('admin.material-price')</a></li>
    <li><a href="#" class="another-btn">@lang('admin.another')</a></li>
</ul>

<form id="form" action="{{ route('services.update', $service->id ) }}" method="POST" enctype="multipart/form-data"
    class="current-slide-wrap">

    @csrf
    @method('PUT')

    @php
        $title = $service->localization[0];
        $materials = $service->localization[1];
    @endphp

    <div class="name-slide flex-col current-slide">
        <div class="input-wrap">
            <input type="text" value="{{ $title->uk }}" id="title_uk" name="title_uk">
            <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
        </div>
        <div class="input-wrap">
            <input type="text" value="{{ $title->ru }}" id="title_ru" name="title_ru">
            <label class="label" for="title_ru">@lang('admin.add_ru_title')</label>
        </div>
    </div>
    <div class="size-price-slide flex-col">
        @php
            $counter = 0;
        @endphp

        <div class="size-price">

            @foreach ($service->servicessizeprice as $sizeprice)

                @php
                $counter++;
                @endphp
                <div class="size size{{ $counter }}">
                    <div class="input-wrap">

                        <input type="text" id="materials_uk" value="{{ $materials->uk }}" name="materials_uk">
                        <label class="label" for="materials_uk" >@lang('admin.add_title_materials')</label>
                    </div>
                    <div class="input-wrap">
                        <input type="text" id="materials_ru" name="materials_ru" value="{{ $materials->ru }}">
                        <label class="label" for="materials_ru">@lang('admin.add_title_ru_materials')</label>
                    </div>

                    <div class="input-wrap">
                        <input type="text" value="{{ $sizeprice->price }}" name="price/{{$counter}}" id="price{{$counter}}" class="auto-value">
                        <label class="label" for="price">@lang('admin.add_price')</label>
                    </div>

                    <div class="input-wrap">
                        <input type="text" value="{{ $sizeprice->units }}" name="units/{{$counter}}" id="units{{$counter}}" class="auto-value">
                        <label class="label" for="units{{$counter}}">@lang('admin.add_price_units')</label>
                    </div>
                    <div class="input-wrap size-price-bt-wrap">
                        <button class="size-price-bt-min" data-size-num="{{ $counter }}"><span class="btn-w-sp"><span>@lang('admin.delete_size_price')</span><img src="{{ asset('img/minus-label.svg') }}" ></span></button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="size-price-bt-wrap">
            <button id="add-size-price" class="size-price-bt-pl"><span class="btn-w-sp"><span>@lang('admin.add_size_price')</span><img src="{{ asset('img/plus-label.svg') }}" ></span></button>
        </div>
        <input type="hidden" name="sizecount" value="{{ $counter }}" id="product-counter">
    </div>


    <div class="another-slide flex-col">
        <div class="input-wrap sub-category-wrap">
            <p class="label">Виберіть під-категорію</p>
            <ul class="flex-space sub-category-wrap">
                {{-- <label><input type="hidden" name="sub_category_id"></label> --}}
                @foreach ($servicescategories as $category)
                @php
                $title = $category->localization[0];
                @endphp

                @if ($category->id == $service->sub_category_id)
                <input class="radio-change" id="subCategory{{$category->id}}" type="radio" value="{{$category->id}}" name="service_category_id" checked>
                <label class="radio-label" for="subCategory{{$category->id}}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                @else
                <input class="radio-change" id="subCategoryNon{{$category->id}}" type="radio" value="{{$category->id}}" name="service_category_id">
                <label class="radio-label" for="subCategoryNon{{$category->id}}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                @endif
                @endforeach
            </ul>
        </div>

    </div>
</form>


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
<script src="{{ asset('js/create.js') }}"></script>
<script src="{{ asset('js/seo.js') }}"></script>
<script src="{{ asset('js/simpleVisualTextEditor.js') }}"></script>
@endsection

`
