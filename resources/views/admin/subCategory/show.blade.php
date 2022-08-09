@extends('admin.admin')

@section('content')
    <h2>subCategory title</h2>
    <p>{{ $subCategory->title}}</p>
    <h2>Products which belongs to subCategory</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Article</th>
        </tr>
        {{-- @foreach ($products as $product)
        <tr>
            <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->article}}</td>
            <td><img src="{{ asset($product->image->url) }}" alt="{{ $product->image->alt }}"></td>
            <td><a href="{{ route('product.show', $product->id) }}">show</a></td>
        </tr>
        @endforeach --}}
    </table>
@endsection