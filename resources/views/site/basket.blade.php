@extends('site.index')


@section('content')

    @php
        $locale = app()->getLocale();
        $productsData = json_decode($_POST['products']);
    @endphp


    <div class="basket-page">
        <div class="basket-empty-popup" id="popupBox">
            <div class="basket-popup" id="popup">
                <h3 class="basket-clear">@lang('utge.basket-is-empty')</h3>
                <a href="{{ route('products') }}" class="send-order-btn">@lang('utge.go-shoping')</a>
            </div>
            <div id="basket-empty-popup-bg"></div>
        </div>
        <div class="basket-table">


            @if (empty($productsData))
                <div class="basket-products">
                    <h1 class="basket-clear">@lang('utge.basket-is-empty')</h1>
                </div>
                @else
                <h2>@lang('utge.basket')</h2>
                <div class="wrapper">
                    <div class="basket-row title-row">
                        <div class="img-col col"></div>
                        <div class="name-col col">
                            <h4>@lang('utge.product')</h4>
                        </div>
                        <div class="count-col col">
                            <h4>@lang('utge.quatify')</h4>
                        </div>
                        <div class="price-col col">
                            <h4>@lang('utge.price')</h4>
                        </div>
                        <div class="delete-col col"></div>
                    </div>
                    @foreach ($productsData as $productData)
                        @foreach ($products as $product)
                            @if ($product->id == $productData[0])
                                @php
                                    $title = $product->localization[0];
                                    $description = $product->localization[1];
                                    $min_size = $productData[2];
                                    $min_price = $productData[3];
                                @endphp

                                <div class="basket-row product-row" data-product-id="{{ $product->id }}">
                                    <div class="img-col col">
                                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $title->$locale }}">
                                    </div>
                                    <div class="name-col col">
                                        <h3>{{ $title->$locale }}</h3>
                                    </div>
                                    <div class="count-col col">
                                        <button class="product-minus">-</button>
                                        <label>
                                            <input type="number" name="product-quantify" class="product-quantify" min="1" value="{{ $productData[1] }}">
                                        </label>
                                        <button class="product-plus">+</button>
                                    </div>
                                    <div class="price-col col">
                                        <input type="hidden" class="default-size" value="{{ $min_size }}">
                                        <input type="hidden" class="default-price" value="{{ $min_price }}">
                                        <p class="basket-price">{{ $min_price }} грн</p>
                                    </div>
                                    <div class="delete-col col">
                                        <a href="#" class="delete-product">
                                            <svg>
                                                <use xlink:href="{{ asset('img/sprite.svg#trashBox') }}"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                            @endif
                        @endforeach
                    @endforeach
                    <div class="basket-row title-row general-row">
                        <div class="img-col col"></div>
                        <div class="name-col col">
                            <h4>@lang('utge.general')</h4>
                        </div>
                        <div class="count-col col">
                            <h4 class="general-quantify"></h4>
                        </div>
                        <div class="price-col col">
                            <h4 class="general-price"></h4>
                        </div>
                        <div class="delete-col col"></div>
                    </div>
                    <div class="commit-order">
                        <label><input type="button" id="to-order-btn" value="@lang('utge.confirm_order')"></label>
                    </div>
                </div>
            </div>
            @endif

        <div class="placing-an-order">
            <h2>@lang('utge.placingAnOrder')</h2>
            <div class="wrapper">
                <form class="order-form" method="POST" action="{{ route('storeProductOrder') }}">

                    @csrf

                    <div class="order-contacts">

                        <h3>1. @lang('utge.contactDetails')</h3>

                        <div class="basket-contacts-wrapp">

                            <div class="bascket-name">
                                <div>
                                    <label for="">@lang('utge.firstname')<span>*</span></label>
                                    <input required name="firstname" type="text">
                                </div>
                                <div>
                                    <label for="">@lang('utge.lastname')<span>*</span></label>
                                    <input required name="lastname" type="text">
                                </div>
                            </div>

                            <div class="bascket-number">
                                <label for="">@lang('utge.number-phone')<span>*</span></label>
                                <input id="popup-phone" required name="phone" type="text">
                            </div>

                        </div>

                        <h3>2. @lang('utge.delivery')</h3>

                        <div class="basket-delivery">

                            <label for="">@lang('admin.city')<span>*</span></label>
                            <input name="city" type="text" required>

                            <p>@lang('utge.deliveryType')<span>*</span></p>

                            <div class="basket-delivery-type">

                                <input required type="radio" value="ind" name="delivery_type" id="ind" class="self_delivery" checked>
                                <label for="ind">@lang('admin.ind-delivery')</label>

                                <input required type="radio" value="adres" name="delivery_type" id="adres" class="adress_delivery">
                                <label for="adres">@lang('admin.adres-delivery')</label>

                                <input required type="radio" value="nova" name="delivery_type" id="nova" class="post_delivery">
                                <label for="nova">@lang('admin.nova-poshta')</label>

                                <input required type="radio" value="ukr" name="delivery_type" id="ukr" class="post_delivery">
                                <label for="ukr">@lang('admin.ukr-poshta')</label>

                                <input required type="radio" value="int" name="delivery_type" id="int" class="post_delivery">
                                <label for="int">@lang('admin.intime')</label>

                                <input required type="radio" value="avl" name="delivery_type" id="avl" class="adress_delivery">
                                <label for="avl">@lang('admin.avtolux')</label>

                            </div>
                            <div class="self_delivery_label">
                                <label>
                                    <div class="post_delivery_label">@lang('utge.postNumber')</div>
                                    <div class="adress_delivery_label">@lang('admin.adress')</div><span>*</span>
                                </label>
                                <input name="adress_delivery" type="text">
                            </div>

                        </div>

                        <h3>3. @lang('utge.payment')</h3>

                        <div class="basket-payment-type">

                            <p>@lang('utge.paymentType')<span>*</span></p>

                            <input required value="cash" type="radio" name="payment_type" id="cash" checked>
                            <label for="cash">@lang('admin.cash')</label>

                            <input required value="privat" type="radio" name="payment_type" id="privat">
                            <label for="privat">@lang('admin.privat')</label>

                            <input required value="cart" type="radio" name="payment_type" id="cart">
                            <label for="cart">@lang('admin.cart')</label>

                        </div>

                    </div>
                    <div class="order-product">
                        <div class="order-product-wrap">
                            <h3>@lang('utge.yourOrder')</h3>
                            <div class="order-product-inf">
                                <table class="order-product-table">

                                    @foreach ($productsData as $productData)

                                        @foreach ($products as $product)

                                            @if ($product->id == $productData[0])

                                                @php
                                                    $title = $product->localization[0];
                                                    $description = $product->localization[1];
                                                    $min_size = $product->sizeprices->where('price', $productData[3])->first()->size;
                                                @endphp

                                                <tr class="product-tr" data-product-id="{{ $product->id }}">
                                                    <td>{{ $title->$locale }}, {{ $min_size }}</td>
                                                    <td class="bold product-quantify-order"></td>
                                                    <td class="bold product-price-order"></td>
                                                </tr>

                                            @endif
                                        @endforeach
                                    @endforeach

                                </table>

                                <input type="hidden" name="product" id="products" value="">

                                <div class="price-delivery">
                                    <p>@lang('utge.deliveryPrice')</p>
                                    <p class="accordingTariffs-p">@lang('utge.accordingTariffs')</p>
                                    <p class="freeDelivery-p">@lang('utge.freeDelivery')</p>
                                </div>

                                <div class="total-price">
                                    <p>@lang('utge.paymentWhithOutDelivery')</p>
                                    <p class="general-price"></p>
                                </div>
                                <div class="btn-wrap">
                                    <button class="send-order-btn" {{--type="button"--}} type="submit" id="popupBtn">@lang('utge.confirmOrder')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="popupBox">
            <div class="basket-popup" id="popup">
                <div class="basket-popup-img">
                    <img src="{{ asset('img/basket-popup-img.png') }}" alt="basket popup img">
                </div>
                <h3>дякуємо за замовлення!</h3>
                <a href="{{ route('products') }}" class="send-order-btn">повернутися до покупок</a>
            </div>
            <div id="popupCloseBox"></div>
        </div>
    </div>

    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('js/basket.js') }}"></script>
    <script src="{{ asset('js/popup.js') }}"></script>

@endsection
