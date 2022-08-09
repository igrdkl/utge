@extends('admin.admin')

@section('content')
    <?php
            $locale = app()->getLocale();
    ?>

<div class="error">
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                    <div class="error-item"><img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error"><p class="error-desc">{{ $error }}</p></div>

            @endforeach
    @endif
</div>

    <div class="flex title-line">
        <h2>@lang('admin.news_create')</h2>
        <button type="submit" form="form" class="add-button" id="save-btn">
            <img src="{{ asset('img/save.svg') }}" alt="Add">
        </button>
    </div>

    <ul class="create-list flex">
        <li><a href="#" class="name-btn current-btn">@lang('admin.title')</a></li>
        <li><a href="#" class="desc-btn">@lang('admin.description')</a></li>
        <li><a href="#" class="photo-btn">@lang('admin.photo')</a></li>
        <li><a href="#" class="another-btn">@lang('admin.another')</a></li>
    </ul>

    <form id="form" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="current-slide-wrap">
        @csrf

        <div class="name-slide flex-col current-slide">
            <div class="input-wrap">
                <input type="text" name="title_uk" value="{{ old('title_uk') }}" id="title_uk">
                <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
            </div>
            <div class="input-wrap">
                <input type="text" name="title_ru" value="{{ old('title_ru') }}" id="title_ru">
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
                  <div id='editor1' style='' contenteditable>{!! old('description_uk') !!}</div>
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
                  <div id='editor2' style='' contenteditable>{!! old('description_ru') !!}</div>
                  <textarea id="desc_ru" name="description_ru"></textarea>
                  <label class="label" for="desc_ru">@lang('admin.add_ru_desc')</label>
                </div>
              </div>
            </div>
          </div>

        <div class="image-slide flex-col">
            <label><input type="hidden" name="image" value=""></label>
            <label><input type="file" name="image"></label>
        </div>

        <div class="desc-slide flex-col">
            <div class="another-slide flex-col">
                <div class="input-wrap sub-category-wrap">
                    <p class="label">Виберіть категорію</p>
                    <div class="flex-space sub-category-wrap">
                        <label><input type="hidden" name="news_category_id"></label>
                        @foreach ($newsCategories as $newsCategory)
                            @php
                                $title = $newsCategory->localization[0];
                            @endphp

                            <input class="radio-change" id="newsCategory{{$newsCategory->id}}" type="radio" value="{{$newsCategory->id}}" name="news_category_id">
                            <label class="radio-label" for="newsCategory{{$newsCategory->id}}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>
                        @endforeach

                    </div>
                </div>
        </div>

    </form>

    <script src="{{ asset('js/create.js') }}"></script>
    <script src="{{ asset('js/simpleVisualTextEditor.js') }}"></script>
@endsection
