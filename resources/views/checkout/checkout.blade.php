@extends('template')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Checkout</h1>

    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>First Name</label>
                <input type="text" name="first_name" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label>Last Name</label>
                <input type="text" name="last_name" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label>Phone</label>
                <input type="text" name="phone" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label>Street Address</label>
                <textarea name="street_address" class="w-full border p-2 rounded" required></textarea>
            </div>
            <div>
                <label>City</label>
                <input type="text" name="city" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label>State</label>
                <input type="text" name="state" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label>Post Code</label>
                <input type="text" name="post_code" class="w-full border p-2 rounded" required>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold">Your Order</h2>
            <ul class="border rounded p-4 bg-gray-50">
                @foreach($cart as $item)
                    <li class="flex justify-between py-2">
                        <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <button type="submit" class="mt-6 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Place Order
        </button>
    </form>
</div>
@endsection
