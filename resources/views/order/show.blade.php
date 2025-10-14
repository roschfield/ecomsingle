@extends('template')

@section('content')
<div class="max-w-4xl mx-auto p-6">
     @if (session('success'))
        <div class="my-6 p-4 text-green-800 bg-green-100 border border-green-200 rounded">
         {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="my-6 p-4 text-red-800 bg-red-100 border border-red-200 rounded">
             <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
