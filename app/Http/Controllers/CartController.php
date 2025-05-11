<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(): Renderable
    {
        return view('cart');
    }

    public function add_to_cart(Request $request, $product_id)
    {
        $product = Product::where('id', $product_id)->first();
        if ($product) {
            $request->session()->push('user.cart', $product->id);
            if (is_array(session('user.cart'))) {
                return redirect(route('cart'));
            } else {
                return 0;
            }
        }
    }
}
