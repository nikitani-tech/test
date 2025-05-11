@extends('app')
@section('content')
    <div class="mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $product->getFirstMediaUrl('product_image') }}" alt="Product image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1>{{ $product->product_name }}</h1>
                @if(!is_null($product->description))
                    <p class="lead">{{ $product->description }}</p>
                @endif
                <h3 class="text-danger">₴ {{ $product->price }}</h3>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/add-to-cart/{{ $product->id }}">
                        <button class="btn btn-primary">Add to cart</button>
                    </a>
                    <p class="mb-0">In stock: <span class="text-success">{{ $product->stock }} items</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
