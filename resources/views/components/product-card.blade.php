<a href="{{ route('product', [$product->id, $product->slug]) }}" class="group block ">
    <img src="{{ asset('storage/' . $product->image) }}" 
         alt="{{ $product->name }}" 
         class="h-80 w-full object-cover transition duration-500 rounded-3xl group-hover:scale-105"/>
    <div class=" py-4 px-1">
        <h3 class=" text-md md:text-lg font-medium">{{ $product->name }}</h3>
        <p class="text-sm md:text-base text-gray-700">USD {{ $product->price }}</p>
    </div>
</a>
