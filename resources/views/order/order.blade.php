@extends('template')

@section('content')
<div class="max-w-5xl mx-auto p-6">
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
    <h1 class="text-2xl font-bold mb-4">My Orders</h1>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-500 text-white ">
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($orders as $order)
                <tr>
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
