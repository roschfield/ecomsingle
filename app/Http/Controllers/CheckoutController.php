<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderReceiptMail;
use Exception;


class CheckoutController extends Controller
{
    // Step 1: Show checkout form
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        return view('checkout.checkout', [
            'cart' => $cart,
            'total' => $grandTotal,
        ]);
    }

    // Step 2: Save address + redirect to payment page
    public function processAddress(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'street_address' => 'required|string|max:500',
            'city'       => 'required|string|max:255',
            'state'      => 'required|string|max:255',
            'post_code'  => 'required|string|max:20',
        ]);

        session()->put('checkout_address', $request->only([
            'first_name', 'last_name', 'phone',
            'street_address', 'city', 'state', 'post_code'
        ]));

        return redirect()->route('checkout.payment');
    }

    // Step 3: Show payment page (Stripe)
    public function payment()
    {
        $cart = session()->get('cart', []);
        $address = session()->get('checkout_address');

        if (empty($cart) || !$address) {
            return redirect('/checkout')->with('error', 'Please enter your details first.');
        }

        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => (int) ($grandTotal * 100),
            'currency' => 'usd',
            'metadata' => ['user_id' => Auth::id()],
            'receipt_email' => Auth::user()->email,
        ]);

        return view('checkout.payment', [
            'clientSecret' => $paymentIntent->client_secret,
            'total' => $grandTotal,
        ]);
    }

    // Step 4: Confirm payment + create order
    public function confirm(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
        if ($paymentIntent->status !== 'succeeded') {
            return response()->json(['error' => 'Payment not completed'], 400);
        }

        $cart = session()->get('cart', []);
        $address = session()->get('checkout_address');

        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'stripe_payment_id' => $paymentIntent->id, // store ID
            'grand_total' => $grandTotal,
            'payment_method' => 'stripe',
            'payment_status' => 'paid',
            'status' => 'new',
            'currency' => 'USD',
            'shipping_amount' => 0,
            'shipping_method' => 'standard',
            'notes' => null,
        ]);

        // Order items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'unit_amount' => $item['price'],
                'total_amount' => $item['price'] * $item['quantity'],
            ]);
        }

        // Address
        Address::create(array_merge($address, [
            'order_id' => $order->id,
        ]));
        
        
       
        // Clear session data
        session()->forget(['cart', 'checkout_address']);

        try {
        $userEmail = Auth::user()->email;
        if ($userEmail) {
           Mail::to($userEmail)->send(new OrderReceiptMail($order));
        }
        } catch (Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }

        return response()->json(['success' => 'Payment Completed Succesfully', 'redirect' => route('order.show', $order->id)]);
    }
}
