<div class="container mt-4">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Order Summary</strong>
        </div>
        <div class="card-body">
            @foreach($cart_array as $item)
                <div class="d-flex justify-content-between border-bottom py-2">
                    <div>
                        <strong>{{ $item['product_name'] }}</strong><br>
                        <small>Quantity: {{ $item['quantity'] }}</small>
                    </div>
                    <div>
                        ₴{{ number_format($item['price'] * $item['quantity'], 2) }}
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-between mt-3">
                <strong>Total:</strong>
                <strong>₴{{ $cart_total }}</strong>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" wire:model.live="first_name" id="first_name" class="form-control">
            @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" wire:model.live="last_name" id="last_name" class="form-control">
            @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" wire:model.live="email" id="email" class="form-control">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" wire:model.live="phone_number" id="phone_number" class="form-control">
            @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="delivery_method" class="form-label">Delivery Method</label>
            <select wire:model.live="delivery_method" id="delivery_method" class="form-select">
                <option value="mail">Delivery by mail</option>
                <option value="pickup">Pickup</option>
            </select>
        </div>
        @if($delivery_method === 'mail')
            <div class="mb-3">
                <label for="address_line" class="form-label">Address Line</label>
                <input type="text" wire:model.live="address_line" id="address_line" class="form-control">
                @error('address_line') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" wire:model.live="city" id="city" class="form-control">
                @error('city') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" wire:model.live="postal_code" id="postal_code" class="form-control">
                @error('postal_code') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        @endif
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select wire:model.live="payment_method" id="payment_method" class="form-select">
                <option value="cash">Cash on delivery</option>
                <option value="online_payment">Online payment</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
