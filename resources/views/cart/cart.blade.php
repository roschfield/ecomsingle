@extends('template')

@section('page_title', 'Your Cart - Ecomwave')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($cart && count($cart) > 0)
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3">Image</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Quantity</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Subtotal</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td class="p-3">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 object-cover rounded" />
                        </td>
                        <td class="p-3">{{ $item['name'] }}</td>
                        <td class="p-3">{{ $item['quantity'] }}</td>
                        <td class="p-3">BDT {{ $item['price'] }}</td>
                        <td class="p-3">BDT {{ $subtotal }}</td>
                        <td class="p-3">
                            <a href="{{ route('cart.remove', $id) }}" 
                               class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Remove
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr class="font-bold">
                    <td colspan="4" class="p-3 text-right">Total:</td>
                    <td class="p-3">BDT {{ $total }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
