@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('title',$title)
@section('content')
    <div class="add-product">
        <div class="errors add-product__errors"></div>
        <form class="add-product__form" action="{{route('products.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div>
                <input class="input" type="text" placeholder="name" name="name" required>
            </div>
            <div>
                <input class="input" value="0" type="number" name="price" required>
            </div>
            <div>
                <input type="file" name="image" required>
            </div>
            <div>
                <select class="add-product__category" name="category" required>
                    @foreach($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                    @endforeach
                </select>
            </div>
            <button class="add-product__submit submit" type="submit">create</button>
        </form>
    </div>
    <div class="products-list" style="margin-top:35px">
        @foreach($products as $product)
            <div class="products-list__item" id="product-{{$product->id}}">
                <p class="products-list__name">{{ Str::limit($product->name, 30) }}</p>
                <p class="products-list__category">{{ $product->category->name ?? 'No category' }}</p>
                <p class="products-list__price">${{ $product->price }}</p>
                <img class="products-list__image" src="{{ asset('storage/'.$product->image) }}"
                     alt="{{ $product->name }}">
                <div class="products-list__delete" x-data="ComponentsFabric.getProductDeleteComponent()">
                    <button
                        @click="deleteProduct({{$product->id}})"
                    >
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endsection
