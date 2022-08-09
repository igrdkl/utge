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
                                @case('size')
                                    @lang('admin.error-size')
                                    @break

                                @case('price')
                                    @lang('admin.error-price')
                                    @break

                                @case('price units')
                                    @lang('admin.error-price_units')
                                    @break

                                @case('available')
                                    @lang('admin.error-available')
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
    <h2>@lang('admin.product_change')</h2>
    <button id="save-btn" type="submit" form="form" class="add-button">
        <img src="{{ asset('img/save.svg') }}" alt="Add">
    </button>
</div>

<ul class="create-list flex">
    <li><a href="#" class="name-btn current-btn">@lang('admin.title')</a></li>
    <li><a href="#" class="desc-btn">@lang('admin.description')</a></li>
    <li><a href="#" class="sp-btn">@lang('admin.sizeprice')</a></li>
    <li><a href="#" class="photo-btn">@lang('admin.photo')</a></li>
    <li><a href="#" class="another-btn">@lang('admin.another')</a></li>
    <li><a href="#" class="seo-btn">SEO</a></li>
</ul>

<form id="form" action="{{ route('product.update', $product->id ) }}" method="POST" enctype="multipart/form-data"
    class="current-slide-wrap">

    @csrf
    @method('PUT')

    @php
        $title = $product->localization[0];
        $title_seo = $product->localization[1];
        $og_title_seo = $product->localization[2];
        $description = $product->localization[3];
        $desc_seo = $product->localization[4];
        $og_desc_seo = $product->localization[5];
        $key_seo = $product->localization[6];
        $custom_seo = $product->localization[7];
    @endphp

    <div class="name-slide flex-col current-slide">
        <div class="input-wrap">
            <input type="text" value="{{ $title->uk }}" id="title_uk" name="title_uk">
            <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
        </div>
        <div class="input-wrap">
            <input type="text" value="{{ $title->ru}}" id="title_ru" name="title_ru">
            <label class="label" for="title_ru">@lang('admin.add_ru_title')</label>
        </div>
    </div>

    <div class="desc-slide flex-col">
        <div class="input-wrap">
          <div class="content">
            <div id="editparent">
              <div id='editControls1' style='text-align:center; padding:5px;'>
                <div class='btn-group'>
                  <a class='btn' data-role='bold' href='#' title='Жирний текст'><b>B</b></a>
                  <a class='btn' data-role='italic' href='#' title='Курсив'><em>I</em></a>
                  <a class='btn' data-role='underline' href='#' title='Підкреслений'><u><b>U</b></u></a>
                  <a class='btn' data-role='strikeThrough' href='#' title='Перекреслений текст'><strike>abc</strike></a>
                  <a class='btn' data-role='removeFormat' href='#' title='Прибрати стилі шрифта'><i class="fas fa-remove-format"></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='justifyLeft' href='#' title='Вирівняти по лівому краю'><i class='fas fa-align-left'></i></a>
                  <a class='btn' data-role='justifyCenter' href='#' title='Вирівняти по центру'><i class='fas fa-align-center'></i></a>
                  <a class='btn' data-role='justifyRight' href='#' title='Вирівняти по правому краю'><i class='fas fa-align-right'></i></a>
                  <a class='btn' data-role='justifyFull' href='#' title='Вирівняти по ширині'><i class='fas fa-align-justify'></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='insertUnorderedList' href='#' title='Ненумерований список'><i class='fas fa-list-ul'></i></a>
                  <a class='btn' data-role='insertOrderedList' href='#' title='Нумерований список'><i class='fas fa-list-ol'></i></a>
                  <a class='btn' data-role='insertTable' href='#' title='Вставити таблицю'><i class='fas fa-table'></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='h1' href='#' title='Заголовок 1-го порядку'>h1</a>
                  <a class='btn' data-role='h2' href='#' title='Заголовок 2-го порядку'>h2</a>
                  <a class='btn' data-role='h3' href='#' title='Заголовок 3-го порядку'>h3</a>
                  <a class='btn' data-role='p' href='#' title='Звичайний текст'>p</a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='createlink' href='#' title='Створити посилання'><i class='fa fa-link'></i></a>
                  <a class='btn' data-role='unlink' href='#' title='Прибрати посилання'><i class='fa fa-unlink'></i></a>
                  <a class='btn' data-role='insertimage' href='#' title='Додати зображення'><i class='fa fa-image'></i></a>
                  <a class='btn' data-role='subscript' href='#' title='Нижній індекс'><i class='fas fa-subscript'></i></a>
                  <a class='btn' data-role='superscript' href='#' title='Верхній індекс'><i class='fas fa-superscript'></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' id="converToCode1" data-role='switchEditor' href='#' title='Перейти в редактор коду'>&lt;code&gt;</a>
                </div>
              </div>
              <div id='editor1' style='' contenteditable>{!! $description->uk !!}</div>
              <textarea id="desc_uk" name="description_uk"></textarea>
              <label class="label" for="desc_uk">@lang('admin.add_uk_desc')</label>
            </div>
          </div>
        </div>
        <div class="input-wrap">
          <div class="content">
            <div id="editparent">
              <div id='editControls2' style='text-align:center; padding:5px;'>
                <div class='btn-group'>
                  <a class='btn' data-role='bold' href='#' title='Жирний текст'><b>B</b></a>
                  <a class='btn' data-role='italic' href='#' title='Курсив'><em>I</em></a>
                  <a class='btn' data-role='underline' href='#' title='Підкреслений'><u><b>U</b></u></a>
                  <a class='btn' data-role='strikeThrough' href='#' title='Перекреслений текст'><strike>abc</strike></a>
                  <a class='btn' data-role='removeFormat' href='#' title='Прибрати стилі шрифта'><i class="fas fa-remove-format"></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='justifyLeft' href='#' title='Вирівняти по лівому краю'><i class='fas fa-align-left'></i></a>
                  <a class='btn' data-role='justifyCenter' href='#' title='Вирівняти по центру'><i class='fas fa-align-center'></i></a>
                  <a class='btn' data-role='justifyRight' href='#' title='Вирівняти по правому краю'><i class='fas fa-align-right'></i></a>
                  <a class='btn' data-role='justifyFull' href='#' title='Вирівняти по ширині'><i class='fas fa-align-justify'></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='insertUnorderedList' href='#' title='Ненумерований список'><i class='fas fa-list-ul'></i></a>
                  <a class='btn' data-role='insertOrderedList' href='#' title='Нумерований список'><i class='fas fa-list-ol'></i></a>
                  <a class='btn' data-role='insertTable' href='#' title='Вставити таблицю'><i class='fas fa-table'></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='h1' href='#' title='Заголовок 1-го порядку'>h1</a>
                  <a class='btn' data-role='h2' href='#' title='Заголовок 2-го порядку'>h2</a>
                  <a class='btn' data-role='h3' href='#' title='Заголовок 3-го порядку'>h3</a>
                  <a class='btn' data-role='p' href='#' title='Звичайний текст'>p</a>
                </div>
                <div class='btn-group'>
                  <a class='btn' data-role='createlink' href='#' title='Створити посилання'><i class='fa fa-link'></i></a>
                  <a class='btn' data-role='unlink' href='#' title='Прибрати посилання'><i class='fa fa-unlink'></i></a>
                  <a class='btn' data-role='insertimage' href='#' title='Додати зображення'><i class='fa fa-image'></i></a>
                  <a class='btn' data-role='subscript' href='#' title='Нижній індекс'><i class='fas fa-subscript'></i></a>
                  <a class='btn' data-role='superscript' href='#' title='Верхній індекс'><i class='fas fa-superscript'></i></a>
                </div>
                <div class='btn-group'>
                  <a class='btn' id="converToCode2" data-role='switchEditor' href='#' title='Перейти в редактор коду'>&lt;code&gt;</a>
                </div>
              </div>
              <div id='editor2' style='' contenteditable>{!! $description->ru !!}</div>
              <textarea id="desc_ru" name="description_ru"></textarea>
              <label class="label" for="desc_ru">@lang('admin.add_ru_desc')</label>
            </div>
          </div>
        </div>
    </div>

    <div class="size-price-slide flex-col">
        @if($product->mass_id == 1)
        <div class="mass-netto">
            <input checked class="mass-netto-checkbox" id="mass_id" type="checkbox" name="mass_id" value="1">
            <label class="mass-netto-label" for="mass_id"><span>@lang('admin.massa_neto')</span></label>
        </div>
        @else
        <div class="mass-netto">
            <input class="mass-netto-checkbox" id="mass_id" type="checkbox" name="mass_id" value="1">
            <label class="mass-netto-label" for="mass_id"><span>@lang('admin.massa_neto')</span></label>
        </div>
        @endif
        @php
            $counter = 0;
        @endphp
            <div class="size-price">
                @foreach ($product->sizeprices as $sizeprice)

                    @php
                    $counter++;
                    @endphp

                    <div class="size{{$counter}} size">
                        <div class="input-wrap">
                            <input type="text" value="{{ $sizeprice->size }}" name="size/{{$counter}}" id="size{{$counter}}" class="auto-value">
                            <label class="label" for="size{{$counter}}">@lang('admin.add_size')</label>
                        </div>

                        <div class="input-wrap">
                            <input type="number" value="{{ $sizeprice->price }}" name="price/{{$counter}}" id="price{{$counter}}" class="auto-value">
                            <label class="label" for="price">@lang('admin.add_price')</label>
                        </div>

                        <div class="input-wrap">
                            <input type="text" value="{{ $sizeprice->price_units }}" name="price_units/{{$counter}}" id="price_units{{$counter}}" class="auto-value">
                            <label class="label" for="price_units{{$counter}}">@lang('admin.add_price_units')</label>
                        </div>

                        <div class="input-wrap pt0">
                            <p>@lang('admin.add_available')</p>
                            <select name="available/{{$counter}}" class="auto-value">
                                @if ($sizeprice->available == 1)
                                    <option value="1" selected>@lang('admin.available')</option>
                                @else
                                    <option value="1">@lang('admin.available')</option>
                                @endif
                                @if ($sizeprice->available == 2)
                                    <option value="2" selected>@lang('admin.not_available')</option>
                                @else
                                    <option value="2">@lang('admin.not_available')</option>
                                @endif
                                @if ($sizeprice->available == 3)
                                    <option value="3" selected>@lang('admin.waiting_available')</option>
                                @else
                                    <option value="3">@lang('admin.waiting_available')</option>
                                @endif
                                @if ($sizeprice->available == 4)
                                    <option value="4" selected>@lang('admin.available_for_order')</option>
                                @else
                                    <option value="4">@lang('admin.available_for_order')</option>
                                @endif
                            </select>
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
            <input type="hidden" name="sizecount" value="{{$counter}}" id="product-counter">
    </div>

    <div class="image-slide flex-col">


        <label class="image-changes" for="image-changes"><img class="old-image"
                src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}"></label>
        <p class="image-changes-desc">@lang('admin.update-image')</p>

        <button class="image-changes-bt" type="submit" form="image-change"
            class="add-button">@lang('admin.save-new-phot')</button>

    </div>

    <div class="another-slide flex-col">
        <div class="input-wrap sub-category-wrap">
            <p class="label">Виберіть під-категорію</p>
            <ul class="flex-space sub-category-wrap">
                <label><input type="hidden" name="sub_category_id"></label>
                @foreach ($subCategories as $subCategory)
                @php
                $title = $subCategory->localization[0];
                @endphp

                @if ($subCategory->id == $product->sub_category_id)
                <input class="radio-change" id="subCategory{{$subCategory->id}}" type="radio"
                    value="{{$subCategory->id}}" name="sub_category_id" checked>
                <label class="radio-label" for="subCategory{{$subCategory->id}}"><span class="label-circle"></span><span
                        class="label-desc">{{ $title->$locale }}</span></label>
                @else
                <input class="radio-change" id="subCategoryNon{{$subCategory->id}}" type="radio"
                    value="{{$subCategory->id}}" name="sub_category_id">
                <label class="radio-label" for="subCategoryNon{{$subCategory->id}}"><span
                        class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                @endif
                @endforeach
            </ul>
        </div>

        <div class="input-wrap">
            <p>@lang('admin.add_home_view')</p>
            <select name="home_view">
                @if ($product->home_view == 0)
                <option value="1">@lang('admin.home_view')</option>
                <option selected value="0">@lang('admin.not_home_view')</option>
                @elseif ($product->home_view == 1)
                <option selected value="1">@lang('admin.home_view')</option>
                <option value="0">@lang('admin.not_home_view')</option>
                @endif
            </select>
        </div>
        <div class="input-wrap">
            <input type="number" name="list_position" value="{{ $product->list_position }}" id="list_pos">
            <label for="list_pos" class="label">@lang('admin.add_list_position')</label>
        </div>
        {{-- pdf --}}
        <div class="input-wrap flex-col">

            @if($product->getFirstMediaUrl('pdf') == null)
                <p>@lang('utge.quality-certificate')</p>
                <input type="file" name="pdf">
            @else
                @php
                    $pdfname = $product->getMedia('pdf');
                    $pdfname[0]->name;
                @endphp
                <a class="certificate" href="{{ $product->getFirstMediaUrl('pdf') }}" class="button details-btn"><p>@lang('utge.quality-certificate')</p> / {{$pdfname[0]->name}}</a>
                <label class="pdf-changes" for="pdf-changes">Вибрати новий сертифікат</label>
                <button class="image-changes-bt" type="submit" form="pdf-change"
                class="add-button">@lang('admin.save-new-pdf')</button>
            @endif

        </div>
    </div>
    <div class="flex-col">

        <div class="flex">
            <div class="input-wrap mr-seo-input">
                <input type="text" class="title_seo_uk" id="title_seo_uk" value="{{ $title_seo->uk }}" name="title_seo_uk">
                <label class="label" for="title_seo_uk">@lang('admin.add_title_seo_uk')</label>
            </div>


            <div class="input-wrap">
                <input type="text" class="title_seo_ru" id="title_seo_ru" value="{{ $title_seo->ru }}" name="title_seo_ru">
                <label class="label" for="title_seo_ru">@lang('admin.add_title_seo')</label>
            </div>
        </div>

        <div class="flex">
            <div class="input-wrap mr-seo-input">
                <input type="text" id="og_title_seo_uk" value="{{ $og_title_seo->uk }}" name="og_title_seo_uk" class="title_seo_uk">
                <label class="label" for="og_title_seo_uk">@lang('admin.og_add_title_seo_uk')</label>
            </div>


            <div class="input-wrap">
                <input type="text" id="og_title_seo_ru" value="{{ $og_title_seo->ru }}" name="og_title_seo_ru" class="title_seo_ru">
                <label class="label" for="og_title_seo_ru">@lang('admin.og_add_title_seo')</label>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label  class="label seo-label" for="og_desc_seo_uk">@lang('admin.og_add_desc_seo_uk')</label>
                <textarea class="seo-textarea" name="og_desc_seo_uk" id="">{{ $og_desc_seo->uk }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label  class="label seo-label" for="og_desc_seo_ru">@lang('admin.og_add_desc_seo')</label>
                <textarea class="seo-textarea" name="og_desc_seo_ru" id="og_desc_seo_ru">{{ $og_desc_seo->ru }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label  class="label seo-label" for="desc_seo_uk">@lang('admin.add_desc_seo_uk')</label>
                <textarea class="seo-textarea" name="desc_seo_uk" id="">{{ $desc_seo->uk }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label  class="label seo-label" for="desc_seo_ru">@lang('admin.add_desc_seo')</label>
                <textarea class="seo-textarea" name="desc_seo_ru" id="desc_seo_ru">{{ $desc_seo->ru }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label  class="label seo-label" for="keywords_seo_uk">@lang('admin.add_key_seo_uk')</label>
                <textarea class="seo-textarea" name="keywords_seo_uk" id="keywords_seo_uk">{{ $key_seo->uk }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label  class="label seo-label" for="keywords_seo_ru">@lang('admin.add_key_seo')</label>
                <textarea class="seo-textarea" name="keywords_seo_ru" id="keywords_seo_ru">{{ $key_seo->ru }}</textarea>
            </div>
        </div>

        <div class="flex">

            <div class="seo-textarea-wrap mr-seo-input">
                <label  class="label seo-label" for="custom_seo_uk">@lang('admin.add_custom_seo_uk')</label>
                <textarea class="seo-textarea" name="custom_seo_uk" id="custom_seo_uk">{{ $custom_seo->uk }}</textarea>
            </div>

            <div class="seo-textarea-wrap">
                <label  class="label seo-label" for="custom_seo_ru">@lang('admin.add_custom_seo')</label>
                <textarea class="seo-textarea" name="custom_seo_ru" id="custom_seo_ru">{{ $custom_seo->ru }}</textarea>
            </div>
        </div>
</form>

<form id="image-change" class="image-changes-form" action="{{ route('product.mediaUpdate', $product->id ) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <input id="image-changes" type="file" name="image">
    <input type="submit" value="img">
</form>

<form id="pdf-change" class="image-changes-form" action="{{ route('product.mediaUpdatePdf', $product->id ) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <input id="pdf-changes" type="file" name="pdf">
    <input type="submit" value="pdf">
</form>




<script>
    function getStructure(counter) {
        return structure = `
                    <div class="size${counter} size">
                        <div class="input-wrap">
                            <input type="text" name="size/${counter}" id="size${counter}" class="auto-value">
                            <label class="label" for="size${counter}">@lang('admin.add_size')</label>
                        </div>

                        <div class="input-wrap">
                            <input type="number" name="price/${counter}" id="price${counter}" class="auto-value">
                            <label class="label" for="price${counter}">@lang('admin.add_price')</label>
                        </div>

                        <div class="input-wrap">
                            <input type="text" name="price_units/${counter}" id="price_units${counter}" class="auto-value">
                            <label class="label" for="price_units${counter}">@lang('admin.add_price_units')</label>
                        </div>

                        <div class="input-wrap pt0">
                            <p>@lang('admin.add_available')</p>
                            <select name="available/${counter}" class="auto-value">
                                <option value="1">@lang('admin.available')</option>
                                <option value="2">@lang('admin.not_available')</option>
                                <option value="3">@lang('admin.waiting_available')</option>
                                <option value="4">@lang('admin.available_for_order')</option>
                            </select>
                        </div>
                        <div class="input-wrap size-price-bt-wrap">
                            <button class="size-price-bt-min" data-size-num="${counter}"><span class="btn-w-sp"><span>@lang('admin.delete_size_price')</span><img src="{{ asset('img/minus-label.svg') }}" ></span></button>
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
