<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class OrderController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function getProvinces()
{
    try {
        Log::info('Attempting to get provinces');
        $provinces = $this->rajaOngkirService->getProvinces();
        Log::info('Provinces retrieved successfully', $provinces);
        return response()->json($provinces);
    } catch (\Exception $e) {
        Log::error('Failed to get provinces: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to get provinces'], 500);
    }
}
    
    public function getCities($province, RajaOngkirService $service)
    {
        try {
            Log::info('Attempting to get cities for province: ' . $province);
            $cities = $service->getCities($province);
            Log::info('Cities retrieved successfully', $cities);
            return response()->json($cities);
        } catch (\Exception $e) {
            Log::error('Failed to get cities: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get cities'], 500);
        }
    }
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('orders.show', compact('order'));
    }

    public function calculateShipping(Request $request)
    {
        $request->validate([
            'destination' => 'required|numeric',
            'courier' => 'required|in:jne,pos,tiki'
        ]);

        // Hitung total berat dari items di cart
        $weight = Cart::where('user_id', auth()->id())
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->sum(DB::raw('carts.quantity * products.weight'));

        $shippingCosts = $this->rajaOngkirService->calculateShipping(
            $request->destination,
            $weight,
            $request->courier
        );

        return response()->json([
            'shipping_costs' => $shippingCosts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'courier' => 'required|string',
            'service' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            // Ambil items dari cart
            $cartItems = Cart::where('user_id', auth()->id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Cart is empty');
            }

            // Hitung total amount
            $subtotal = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            $total = $subtotal + $request->shipping_cost;

            // Buat order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . Str::random(10),
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'shipping_cost' => $request->shipping_cost,
                'courier' => $request->courier,
                'service' => $request->service,
                'status' => 'pending'
            ]);

            // Simpan order items
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // Kosongkan cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating order: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuat order.');
        }
    }
}