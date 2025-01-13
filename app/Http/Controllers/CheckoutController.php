<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $weight = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->weight;
        });

        return view('checkout.index', compact('subtotal', 'weight'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'courier' => 'required|string',
            'service' => 'required|string'
        ]);

        return app(OrderController::class)->store($request);
    }
}