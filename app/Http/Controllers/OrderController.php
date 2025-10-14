<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
                       ->where('user_id', Auth::id())
                       ->latest()
                       ->get();

        return view('order.order', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product', 'address'])
                      ->where('user_id', Auth::id())
                      ->findOrFail($id);

        return view('order.show', compact('order'));
    }
}
