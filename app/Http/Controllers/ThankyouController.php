<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThankyouController extends Controller
{
    public function index(string $order_id, Request $request): Renderable
    {
        $order = Order::query()->findOrFail($order_id);


        if (!Auth::check() || (int) $order->order_creator !== (int) Auth::id()) {
            abort(404);
        }

        return view('thankyou', [
            'order_id' => $order->id,
            'order_total' => $order->order_total,
            'payment_method' => $order->payment_method,
        ]);
    }
}
