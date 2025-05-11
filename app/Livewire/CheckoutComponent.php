<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $first_name = '';

    public $last_name = '';

    public $email = '';

    public $phone_number = '';

    public $delivery_method = 'pickup';

    public $payment_method = 'online_payment';

    public $address_line = '';

    public $city = '';

    public $postal_code= '';


    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        $cart_array = CartService::getCartData();
        $cart_total = CartService::getCartTotal();

        return view('livewire.checkout-component', [
            'cart_array' => $cart_array,
            'cart_total' => $cart_total,
        ]);
    }

    public function save()
    {
        $this->validate();

        $cart = CartService::getCartData();

        $order = Order::create([
            'order_creator' => Auth::id(),
            'order_status' => 'new',
            'billing_info' => json_encode([
                'billing_first_name' => $this->first_name,
                'billing_last_name' => $this->last_name,
                'billing_street_address' => $this->address_line,
                'billing_city' => $this->city,
                'billing_zip' => $this->postal_code,
                'billing_phone' => $this->phone_number,
                'billing_email' => $this->email,
            ]),
            'payment_method' => $this->payment_method,
            'delivery_method' => $this->delivery_method,
            'order_total' => CartService::getCartTotal(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($cart as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'item_quantity' => $item['quantity'],
                'item_total' => $item['item_total'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->deleteStock($item['product_id'], $item['quantity']);
        }
        CartService::clearCart();
        return redirect('/thankyou/' . $order->id);
    }

    private function deleteStock(int $product_id, int $quantity): void
    {
        $product = Product::find($product_id);
        $product->stock -= $quantity;
        $product->save();
    }

    public function rules(): array
    {
        $rules = [
            'first_name'      => 'required|string|min:3',
            'last_name'       => 'required|string|min:3',
            'email'           => 'required|email',
            'phone_number'    => 'required|string|min:7',
            'delivery_method' => 'required|in:mail,pickup',
            'payment_method'  => 'required|in:cash,online_payment',
        ];
        if ($this->delivery_method === 'mail') {
            $rules['address_line'] = 'required|string|min:3';
            $rules['city'] = 'required|string|min:3';
            $rules['postal_code'] = 'required|string|min:3';
        }
        return $rules;
    }
}
