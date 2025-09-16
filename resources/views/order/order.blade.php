@extends('template')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">My Orders</h1>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Order #</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="border px-4 py-2">#{{ $order->id }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($order->status) }}</td>
                    <td class="border px-4 py-2">${{ number_format($order->grand_total, 2) }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('order.show', $order->id) }}" 
                           class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
