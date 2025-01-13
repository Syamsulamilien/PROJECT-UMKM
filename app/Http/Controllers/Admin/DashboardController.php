<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use App\Models\Product;
    use App\Models\User;

    class DashboardController extends Controller
    {
       // DashboardController.php
public function index()
{
    $totalUsers = User::where('role', 'user')->count();
    $totalProducts = Product::count();
    $totalOrders = Order::count();
    $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
    
    // Get orders for last 7 days
    $recentOrders = Order::with('user')
        ->latest()
        ->take(5)
        ->get();
        
    // Monthly revenue data
    $monthlyRevenue = Order::where('status', 'completed')
        ->whereYear('created_at', now()->year)
        ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
        ->groupBy('month')
        ->get();
        
    // Low stock products alert
    $lowStockProducts = Product::where('stock', '<=', 5)->get();
    
    return view('admin.dashboard', compact(
        'totalUsers',
        'totalProducts',
        'totalOrders',
        'totalRevenue',
        'recentOrders',
        'monthlyRevenue',
        'lowStockProducts'
    ));
}
    }