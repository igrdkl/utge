@extends('admin.admin')


    @section('content')
    <?php
        $locale = app()->getLocale();
    ?>

    <div class="flex title-line">
        <h2>@lang('admin.product_list')</h2>
        <a href="{{ route('product.create') }}" class="add-button action-button">
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
                    {{-- <th>@lang('admin.filters')</th> --}}
                    <th>@lang('admin.sizeprice')</th>
                    <th>@lang('admin.action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                @php
                    $title = $product->localization[0];
                    $description = $product->localization[3];
                @endphp
                <tr>
                    <td class="product-image"><img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}"></td>
                    <td>{{$title->$locale}}</td>

                    {{-- <td>{{$product->subcategory->localization[0]->$locale}}</td> --}}
                    {{-- <td>{{dd($product->subcategory->localization[0]->$locale)}}</td> --}}
                    <td>
                        @foreach ($product->sizeprices as $sizeprice)

                            @if ($sizeprice->size != null)
                                <p>
                                    {{ $sizeprice->size }}
                                    /
                                    {{ $sizeprice->price }}грн
                                    |
                                    @if ($sizeprice->available == 1)
                                        @lang('admin.available')
                                    @elseif ($sizeprice->available == 2)
                                        @lang('admin.not_available')
                                    @elseif ($sizeprice->available == 3)
                                        @lang('admin.waiting_available')
                                    @else
                                        @lang('admin.available_for_order')
                                    @endif
                                </p>
                            @else
                                <p>
                                    {{ $sizeprice->price }}грн
                                    @if ($sizeprice->available == 1)
                                        @lang('admin.available')
                                    @elseif ($sizeprice->available == 2)
                                        @lang('admin.not_available')
                                    @elseif ($sizeprice->available == 3)
                                        @lang('admin.waiting_available')
                                    @else
                                        @lang('admin.available_for_order')
                                    @endif
                                </p>
                            @endif
                        @endforeach
                        {{-- {{dd($product->sizeprice)}} --}}
                    </td>
                    <td class="action">
                        <a title="Редагувати" href="{{ route('product.edit', $product->id) }}"></a>
                        <a title="Видалити" href="{{ route('product.delete', $product->id) }}"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        </div>
            <form class="filter-form" action="{{ route('product.index') }}" method="GET">

                <p class="filter-item-title">@lang('admin.filters')</p>

                <p class="filter-item-desc">@lang('admin.to_product_type')</p>
                <div class="filter-item">
                    @foreach ($producttypes as $producttype)

                    @php
                        $title = $producttype->localization[0];
                    @endphp

                        <input class="filter-item-checkbox" id="producttypeid_{{$producttype->id}}" type="checkbox" name="producttypeid_{{$producttype->id}}" value="{{$producttype->id}}" @if (isset($_GET['producttypeid_'.$producttype->id])) @if ($_GET['producttypeid_'.$producttype->id] == $producttype->id) checked @endif @endif>
                        <label class="filter-item-label" for="producttypeid_{{$producttype->id}}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>

                    @endforeach
                </div>

                <p class="filter-item-desc">@lang('admin.to_category')</p>
                <div class="filter-item">
                    @foreach ($categories as $category)

                    @php
                        $title = $category->localization[0];
                    @endphp

                        <input class="filter-item-checkbox" id="categoryid_{{$category->id}}" type="checkbox" name="categoryid_{{$category->id}}" value="{{$category->id}}" @if (isset($_GET['categoryid_'.$category->id])) @if ($_GET['categoryid_'.$category->id] == $category->id) checked @endif @endif>
                        <label class="filter-item-label" for="categoryid_{{$category->id}}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>

                    @endforeach
                </div>

                <p class="filter-item-desc">@lang('admin.to_sub_category')</p>
                <div class="filter-item">
                        @foreach ($subcategories as $subcategory)

                        @php
                            $title = $subcategory->localization[0];
                        @endphp

                            <input class="filter-item-checkbox" id="subcategoryid_{{$subcategory->id}}" type="checkbox" name="subcategoryid_{{$subcategory->id}}" value="{{$subcategory->id}}" @if (isset($_GET['subcategoryid_'.$subcategory->id])) @if ($_GET['subcategoryid_'.$subcategory->id] == $subcategory->id) checked @endif @endif>
                            <label class="filter-item-label" for="subcategoryid_{{$subcategory->id}}"><span class="label-circle"></span><span class="label-desc">{{ $title->$locale }}</span></label>

                        @endforeach
                </div>

                <div class="filter-item filter-setting-button">
                    <input class="filter-item-button-button" id="filter-item-button" type="submit" value="filter">
                    <button class="filter-item-button-label" for="filter-item-button-label">@lang('admin.search')</button>
                </div>

            </form>
    </div>

    <div class="pagination">
        {{ $products->withQueryString()->links('vendor.pagination.utge-pagination') }}
    </div>

    @endsection
