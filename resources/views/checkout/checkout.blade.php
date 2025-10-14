@extends('template')

@section('content')
<div class="max-w-lg mx-auto py-10 px-10 md:px-0">
    <h2 class="text-2xl font-semibold mb-6">Checkout</h2>

    <form action="{{ route('checkout.address') }}" method="POST">
        @csrf
        
        @if ($errors->any())
        <div class="mb-6 p-4 text-red-800 bg-red-100 border border-red-200 rounded">
            <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <div class="space-y-4">
            <input type="text" name="first_name" placeholder="First Name" class="w-full border p-2" required>
            <input type="text" name="last_name" placeholder="Last Name" class="w-full border p-2" required>
            <input type="text" name="phone" placeholder="Phone" class="w-full border p-2" required>
            <input type="text" name="street_address" placeholder="Street Address" class="w-full border p-2" required>
            <input type="text" name="city" placeholder="City" class="w-full border p-2" required>
            <input type="text" name="state" placeholder="State" class="w-full border p-2" required>
            <input type="text" name="post_code" placeholder="Postal Code" class="w-full border p-2" required>
        </div>

        <button type="submit" class="mt-6 bg-black text-white px-6 py-2 rounded hover:bg-gray-800 w-full">
            Continue to Payment
        </button>
    </form>
</div>
@endsection
