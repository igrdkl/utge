@extends('admin.admin')

@section('content')

@php
$locale = app()->getLocale();
@endphp

@php
$title = $subCategory->localization[0];
@endphp

<div class="error">
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                    <div class="error-item"><img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error"><p class="error-desc">{{ $error }}</p></div>

            @endforeach
    @endif
</div>

<div class="flex title-line">
    <h2>@lang('admin.subcategory_change')</h2>
    <button type="submit" form="form" class="add-button" id="save-btn">
        <img src="{{ asset('img/save.svg') }}" alt="Add">
    </button>
</div>

<ul class="create-list flex">
    <li><a href="#" class="name-btn current-btn">@lang('admin.title')</a></li>
    <li><a href="#" class="desc-btn">@lang('admin.description')</a></li>
    <li><a href="#" class="name-btn">@lang('admin.another')</a></li>
</ul>

<form id="form" class="current-slide-wrap" action="{{ route('subCategory.update', $subCategory->id) }}" method="POST">
    @csrf
    @method('PUT')

    @php
        $title = $subCategory->localization[0];
        if (isset($subCategory->localization[1])) 
        {
            $description = $subCategory->localization[1];
        }
    @endphp

    <div class="name-slide flex-col current-slide">
        <div class="input-wrap">
            <input type="text" name="title_uk" id="title_uk" value="{{ $title->uk }}">
            <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
        </div>
        <div class="input-wrap">
            <input type="text" name="title_ru" id="title_ru" value="{{ $title->ru }}">
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
              <div id='editor1' style='' contenteditable>@if (isset($subCategory->localization[1]) && $description->uk != 'utge undefined description') {!! $description->uk !!}@endif</div>
              <textarea id="desc_uk" name="sub_description_uk"></textarea>
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
              <div id='editor2' style='' contenteditable>@if (isset($subCategory->localization[1]) && $description->ru != 'utge undefined description') {!! $description->ru !!}@endif</div>
              <textarea id="desc_ru" name="sub_description_ru"></textarea>
              <label class="label" for="desc_ru">@lang('admin.add_ru_desc')</label>
            </div>
          </div>
        </div>
    </div>
    <div class="desc-slide flex-col">
        <div class="another-slide flex-col">
            <div class="input-wrap sub-category-wrap">
                <p class="label">Виберіть категорію</p>
                <div class="flex-space sub-category-wrap">

                    @foreach ($categories as $category)
                    @php
                    $title = $category->localization[0];
                    @endphp

                    @if ($category->id == $subCategory->category_id)

                    <input class="radio-change" id="subCategory{{$category->id}}" type="radio" value="{{$category->id}}"
                        name="categories_id" checked>
                    <label class="radio-label" for="subCategory{{$category->id}}"><span
                            class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                    @else
                    <input class="radio-change" id="subCategoryNon{{$category->id}}" type="radio"
                        value="{{$category->id}}" name="categories_id">
                    <label class="radio-label" for="subCategoryNon{{$category->id}}"><span
                            class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/create.js') }}"></script>
<script src="{{ asset('js/simpleVisualTextEditor.js') }}"></script>
@endsection
