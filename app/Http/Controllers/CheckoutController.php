<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        return view('checkout.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'street_address' => 'required|string|max:500',
            'city'       => 'required|string|max:255',
            'state'      => 'required|string|max:255',
            'post_code'  => 'required|string|max:20',
        ]);

        // Calculate totals
        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        // Create Order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'grand_total'    => $grandTotal,
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'pending',
            'status'         => 'new',
            'currency'       => 'USD',
            'shipping_amount'=> 0,
            'shipping_method'=> 'standard',
            'notes'          => $request->notes ?? null,
        ]);

        // Create Order Items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $productId,
                'quantity'     => $item['quantity'],
                'unit_amount'  => $item['price'],
                'total_amount' => $item['price'] * $item['quantity'],
            ]);
        }

        // Save Address
        Address::create([
            'order_id'       => $order->id,
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'phone'          => $request->phone,
            'street_address' => $request->street_address,
            'city'           => $request->city,
            'state'          => $request->state,
            'post_code'      => $request->post_code,
        ]);

        // Clear cart
        session()->forget('cart');

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Order placed successfully!');
    }
}
