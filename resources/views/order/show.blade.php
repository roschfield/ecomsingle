@extends('template')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Shipping Address</h2>
        <p>{{ $order->address->full_name }}</p>
        <p>{{ $order->address->street_address }}</p>
        <p>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->post_code }}</p>
        <p>Phone: {{ $order->address->phone }}</p>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Order Items</h2>
        <ul class="border rounded p-4 bg-gray-50">
            @foreach($order->items as $item)
                <li class="flex justify-between py-2">
                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                    <span>${{ number_format($item->total_amount, 2) }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="text-right font-bold text-lg">
        Grand Total: ${{ number_format($order->grand_total, 2) }}
    </div>

    <div class="mt-6">
        <a href="{{ route('orders.index') }}" 
           class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">
            Back to Orders
        </a>
    </div>
</div>
@endsection
