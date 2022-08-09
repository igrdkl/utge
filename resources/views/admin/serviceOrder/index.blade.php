@extends('admin.admin')

@section('content')

@php
$locale = app()->getLocale();
@endphp

<div class="flex title-line">
    <h2>@lang('admin.order-list')</h2>
</div>

<table class="product-table">
    <thead>
        <tr>
            <th>@lang('admin.number')</th>
            <th>@lang('admin.fio')</th>
            <th>@lang('admin.contacts')</th>
            <th>@lang('admin.interes-service')</th>
            <th>@lang('admin.status')</th>
            <th>@lang('admin.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($serviceOrders as $order)
            @if($order->deleted_at == NULL)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                    @if ($order->email == null)
                        <td><p>тел: {{ $order->phone }}</p></td>
                    @else
                        <td>
                            <p>тел: {{ $order->phone }}</p>
                            <p>e-mail: {{ $order->email }}</p>
                        </td>
                    @endif
                    <td>
                        {{ substr($order->interes, 0, 55) . '...' }}
                    </td>
                    @if ($order->status == 0)
                        <td class="order-status">
                            @if($order->status == 0)
                                <p>Нове замовлення</p>
                            @elseif($order->status == 1)
                                <p>Опрацьоване замовлення</p>
                            @endif
                        </td>
                    @else
                        <td class="order-status-one">
                            @if($order->status == 0)
                                <p>Нове замовлення</p>
                            @elseif($order->status == 1)
                                <p>Опрацьоване замовлення</p>
                            @endif
                        </td>
                    @endif
                    <td class="action">
                        <a title="Редагувати" href="{{ route('servicesOrder.edit', $order->id) }}"></a>
                        <a title="Видалити" href="{{ route('servicesOrder.delete', $order->id) }}"></a>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

@endsection
