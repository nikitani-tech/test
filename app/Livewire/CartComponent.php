<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartComponent extends Component
{
    public $cart_total = 0;

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.cart-component', ['cart_data' => $this->setCartData()]);
    }

    private function setCartData(): ?array
    {
        $this->cart_total = CartService::getCartTotal();
        return CartService::getCartData();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeItem($product_id): void
    {
        $product = Product::find($product_id);
        if ($product) {
            $cart_array = session()->get('user.cart');
            $product_key = array_search($product_id, $cart_array);
            unset($cart_array[$product_key]);
            $new_cart_array = array_values($cart_array);
            session()->put('user.cart', $new_cart_array);
        }
    }

    public function addItem($product_id): void
    {
        $product = Product::find($product_id);
        if ($product) {
            session()->push('user.cart', $product->id);
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function deleteItem($product_id): void
    {
        $product = Product::find($product_id);
        if ($product) {
            $cart_array = session()->get('user.cart');
            foreach (array_keys($cart_array, $product_id) as $key) {
                unset($cart_array[$key]);
            }
            $new_cart_array = array_values($cart_array);
            session()->put('user.cart', $new_cart_array);
        }
    }
}
