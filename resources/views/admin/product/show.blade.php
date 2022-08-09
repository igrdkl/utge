@extends('admin.admin')
    @section('content')
        <div class="flex title-line">
            <h2>{{ $product->title }}</h2>
            <div class="button-box">
                <a href="{{ route('product.edit', $product->id) }}" class="action-button">
                    <img src="{{ asset('img/edit.svg') }}" alt="Edit"> edit
                </a>
                <a href="{{ route('product.delete', $product->id) }}" class="action-button">
                    <img src="{{ asset('img/delete.svg') }}" alt="Delete"> delete
                </a>
            </div>
        </div>

    @endsection
