@extends('admin.admin')

@section('content')
<div class="error">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
            <div class="error-item"><img class="error-icon" src="{{ asset('img/error.svg') }}" alt="error"><p class="error-desc">{{ $error }}</p></div>
      @endforeach
    @endif
</div>

  <div class="flex title-line">
      <h2>@lang('admin.childPage_create')</h2>
      <button type="submit" form="form" class="add-button" id="save-btn">
          <img src="{{ asset('img/save.svg') }}" alt="Add">
      </button>
  </div>

  <ul class="create-list flex">
      <li><a href="#" class="another-btn current-btn">@lang('admin.block')</a></li>
      <li><a href="#" class="name-btn">@lang('admin.title')</a></li>
      <li><a href="#" class="desc-btn">@lang('admin.description')</a></li>
      <li><a href="#" class="photo-btn" display="none">@lang('admin.photo')</a></li>
  </ul>

  <form id="form" action="{{ route('childPage.store') }}" method="POST" enctype="multipart/form-data" class="current-slide-wrap">
      @csrf

    <div class="another-slide flex-col current-slide">
        <div class="input-wrap pt0">

            @foreach ($childPages as $childPage)
				@php
                    if ($childPage->route == 'logo-img') {
                        $isLogoImg = true;
                        break;
                    } else {
						$isLogoImg = false;
                    }
                @endphp
            @endforeach

            @foreach ($childPages as $childPage)
                @php
                    if ($childPage->route == 'logo-name') {
                        $isLogoName = true;
                        break;
                    } else {
                        $isLogoName = false;
                    }

                @endphp
            @endforeach
            @foreach ($childPages as $childPage)
                @php
                    if ($childPage->route == 'about_us') {
                        $isLogoAbout = true;
                        break;
                    } else {
                        $isLogoAbout = false;
                    }
                @endphp
            @endforeach


            <select name="route" id="child-page-select" class="auto-value">
                <option value="" id="child-page-first-option" selected>@lang('admin.child_page_father')</option>
                <option disabled  class="models-slider-option">------------</option>
                <option value="phone">@lang('admin.phone')</option>
                <option value="logo-img" @if ($isLogoImg == true) disabled @endif>@lang('admin.logo-img')</option>
                <option value="logo-name" @if ($isLogoName == true) disabled @endif>@lang('admin.logo-name')</option>
                <option disabled class="models-slider-option">------------</option>
                <option value="footer-place">@lang('admin.footer-place')</option>
                <option value="email">@lang('admin.email')</option>
                <option disabled class="models-slider-option">------------</option>
                <option value="about_us" @if ($isLogoAbout == true) disabled @endif>@lang('utge.about-us')</option>
                <option value="delivery">@lang('utge.delivery')</option>
                <option value="payment">@lang('utge.payment')</option>
                <option value="contacts">@lang('utge.contacts')</option>
            </select>
        </div>
      <div class="input-wrap phone-box">
        <input type="text" name="phone" class="phone-input" id="phone">
        <label class="label" for="phone">@lang('admin.add_phone')</label>
      </div>
      <div class="input-wrap email-box">
        <input type="email" name="email" class="email-input" id="email">
        <label class="label" for="email">@lang('admin.email')</label>
      </div>
    </div>


    <div class="name-slide flex-col">
        <div class="input-wrap name-box">
            <input type="text" name="title_uk" id="title_uk" value="{{ old('title_uk') }}" class="name-input-uk">
            <label class="label" for="title_uk">@lang('admin.add_uk_title')</label>
        </div>
        <div class="input-wrap name-box">
            <input type="text" name="title_ru" value="{{ old('title_ru') }}" id="title_ru" class="name-input-ru">
            <label class="label" for="title_ru">@lang('admin.add_ru_title')</label>
        </div>
        <div class="input-wrap name-box-none">
          <p class="this-block-name">@lang('admin.this-block-name')</p>
          <p class="choose-block-name">@lang('admin.choose-block')</p>
        </div>
    </div>

    <div class="desc-slide flex-col">
      <div class="input-wrap desc-box">
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
            <textarea id="desc_uk" name="description_uk" class="desc-input-uk"></textarea>
            <label class="label" for="desc_uk">@lang('admin.add_uk_desc')</label>
          </div>
        </div>
      </div>
      <div class="input-wrap desc-box">
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
            <textarea id="desc_ru" name="description_ru" class="desc-input-ru"></textarea>
            <label class="label" for="desc_ru">@lang('admin.add_ru_desc')</label>
          </div>
        </div>
      </div>
      <div class="input-wrap desc-box-none">
        <p class="this-block-desc">@lang('admin.this-block-desc')</p>
        <p class="choose-block-desc">@lang('admin.choose-block')</p>
      </div>
    </div>

    <div class="image-slide flex-col">
      <div class="input-wrap img-box">
          <label><input type="hidden" name="image" class="img-input" value=""></label>
          <label><input type="file" name="image" class="img-input"></label>
      </div>
      <div class="input-wrap img-box-none">
        <p class="this-block-img">@lang('admin.this-block-img')</p>
        <p class="choose-block-img">@lang('admin.choose-block')</p>
      </div>
    </div>

  </form>

  <script src="{{ asset('js/create.js') }}"></script>
  <script src="{{ asset('js/childPage.js') }}"></script>
  <script src="{{ asset('js/simpleVisualTextEditor.js') }}"></script>
@endsection
