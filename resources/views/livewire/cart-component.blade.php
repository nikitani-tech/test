<div>
    <div class="my-5">
        @if(count($cart_data) > 0)
            @foreach($cart_data as $cart_item)
                <div class="card mb-3">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-2 text-center">
                            <img src="{{ $cart_item['product_image'] }}" class="img-fluid rounded-start" alt="Product Name">
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h5 class="card-title mb-1">{{ $cart_item['product_name'] }}</h5>
                                <p class="card-text text-muted mb-1">₴{{ $cart_item['price'] }}</p>
                                <p class="card-text"><small class="text-muted">Article: {{ $cart_item['product_id'] }}</small></p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="input-group justify-content-center">
                                <button wire:click="removeItem({{$cart_item['product_id']}})" class="btn btn-outline-secondary" type="button">-</button>
                                <input type="text" class="form-control text-center" value="{{ $cart_item['quantity'] }}" style="max-width: 60px;">
                                <button wire:click="addItem({{$cart_item['product_id']}})" class="btn btn-outline-secondary" type="button">+</button>
                            </div>
                            @if($cart_item['quantity'] > $cart_item['stock'])
                                <p class="card-text text-danger">Sorry, we have only {{ $cart_item['stock'] }} items in stock</p>
                            @endif
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="fw-bold mb-0">Total: ₴{{ $cart_item['item_total'] }}</p>
                        </div>
                        <div class="col-md-1 text-center">
                            <button wire:click="deleteItem({{$cart_item['product_id']}})" class="btn btn-danger btn-sm">✕</button>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="text-end mt-4">
                <h4>Total: ₴{{ $cart_total }}</h4>
                <a href="{{ route('checkout') }}" class="btn btn-success mt-2">Proceed to checkout</a>
            </div>
        @else
            <h3>Cart is empty</h3>
        @endif
    </div>
</div>
