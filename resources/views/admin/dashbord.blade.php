@extends('admin.admin')

@section('content')

    @php
    $locale = app()->getLocale();
    @endphp



    @php
        $count_products = count($products);
        $count_customers = count($customers);
        $count_customers_all = count($customers_all);
        $count_services_order = count($services_order);
        $count_services = count($services);
    @endphp


    <h2>Панель стану</h2>

    {{-- <form action="{{ route('admin.setValueToCache') }}" method="GET">
        <input type="submit" value="cashe">
    </form> --}}
    <div class="dashbord-wraper">

        <div class="dashbord-wraper-block">
            <div class="wraper-box">
                <p class="dashbord-wraper-block-desc">Кількість товарів на сайті</p>
                <p class="dashbord-wraper-block-count"><span>{{ $count_products }}</span></p>
                <a href="{{ route('product.index') }}">Детальніше ...</a>
            </div>
        </div>

        <div class="dashbord-wraper-block">
            <div class="wraper-box">
                <p class="dashbord-wraper-block-desc">Кількість послуг на сайті</p>
                <p class="dashbord-wraper-block-count"><span>{{ $count_services }}</span></p>
                <a href="{{ route('services.index') }}">Детальніше ...</a>
            </div>
        </div>

        <div class="dashbord-wraper-block">
            <div class="wraper-box">
                <p class="dashbord-wraper-block-desc">Нові замовлення товрів</p>
                @if ($count_customers >= 1)
                    <p class="dashbord-wraper-block-count plus-order"><span>+ {{ $count_customers }}</span></p>
                @else
                    <p class="dashbord-wraper-block-count"><span>{{ $count_customers }}</span></p>
                @endif
                <a href="{{ route('productsOrder.index') }}">Детальніше ...</a>
            </div>
        </div>

        <div class="dashbord-wraper-block">
            <div class="wraper-box">
                <p class="dashbord-wraper-block-desc">Нові замовлення послуг</p>
                @if ($count_services_order >= 1)
                    <p class="dashbord-wraper-block-count plus-order"><span>+ {{ $count_services_order }}</span></p>
                @else
                    <p class="dashbord-wraper-block-count "><span>{{ $count_services_order }}</span></p>
                @endif
                <a href="{{ route('servicesOrder.index') }}">Детальніше ...</a>
            </div>
        </div>

        <div class="dashbord-wraper-block">
            <div class="wraper-box">
                <div class="wraper-box-flex">
                    <p>Загальна кількість замовлень товарів</p>
                    <p>Загальна сума замовлень</p>
                </div>
                <div class="wraper-box-flex-count">
                    <p>{{ $count_customers_all }}</p>
                    @foreach ($products_order as $order)
                        @if ($order->deleted_at == NULL)
                            @php
                                $gen_price[] = $order->top_price;
                            @endphp
                        @endif
                    @endforeach
                    @if (!isset($gen_price))
                        <p>0</p>
                    @else
                        <p>{{array_sum($gen_price)}} грн</p>
                    @endif
                </div>
                <a href="{{ route('servicesOrder.index') }}">Детальніше ...</a>
            </div>
        </div>

    </div>


@endsection
