@extends('template')
@section('page_title')
Product Details-Ecomwave
@endsection
@section('content')
<div class="container mx-auto py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 sm:px-2 md:px-0">
       
        <!-- Product Image -->
        <div>
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-auto object-cover rounded-lg"/>
        </div>

        <!-- Product Details -->
        <div>
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-gray-700 mb-4">{{ $product->description }}</p>
            <p class="text-xl font-semibold mb-4">BDT {{ $product->price }}</p>

            <p class="mb-4">Category: 
                <a href="{{ route('category', [$product->category->id, $product->category->slug]) }}" 
                   class="text-blue-600 hover:underline">
                   {{ $product->category->name }}
                </a>
            </p>
             <!-- Stock Status -->
            @if($product->in_stock && $product->stock_quantity > 0)
                <p class="text-green-600 font-medium mb-2">
                    ✅ In Stock ({{ $product->stock_quantity }} available)
                </p>
            @else
                <p class="text-red-600 font-medium mb-2">
                    ❌ Out of Stock
                </p>
            @endif

            <!-- Quantity & Add to Cart -->
            @if($product->in_stock && $product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                        @csrf
                        <label for="quantity" class="block mb-2 font-medium">Quantity</label>
                        <input type="number" name="quantity" id="quantity" 
                            value="1" min="1" max="{{ $product->stock_quantity }}"
                            class="w-24 border border-gray-300 rounded px-2 py-1">
                        
                        <button type="submit" 
                                class="ml-3 bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                            Add to Cart
                        </button>
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
                </form>

            @endif
        </div>
    </div>

    <!--Related Products -->
    @if($relatedProducts->isNotEmpty())
        <div class="mt-12 px-4 sm:px-2 md:px-0">
            <h2 class="text-2xl font-bold mb-6">Related Products</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4  gap-3 md:gap-6">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection






