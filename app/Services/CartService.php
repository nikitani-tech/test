<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;

class CartService
{
    public static function clearCart(): void
    {
        session()->forget('user.cart');
    }

    public static function getCartTotal(): float|int
    {
        $total = 0;
        foreach (self::getCartData() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public static function getCartData()
    {
        $cart_array = session()->get('user.cart');
        $cart_items = [];
        if (isset($cart_array[0])) {
            foreach (array_count_values($cart_array) as $key => $value) {
                $product = Product::with('media')->find($key);
                $item_total = round($product->price * $value, 2);
                $cart_items[] = [
                    'product_id' => $key,
                    'quantity' => $value,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'product_name' => $product->product_name,
                    'product_image' => $product->getFirstMediaUrl('product_image'),
                    'item_total' => $item_total,
                ];
            }
            return $cart_items;
        }
    }
}
