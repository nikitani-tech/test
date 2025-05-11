<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product_slug): Renderable
    {
        $product = Product::where('slug', $product_slug)->with('media')->first();
        return view('product', ['product' => $product]);
    }
}
