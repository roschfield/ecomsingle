@extends('template')
@section('page_title')
Home-Ecomwave
@endsection
@section('content')



<!-- Hero Section-->
@php
    $bgImage = asset('storage/images/hero-banner.jpg');
    $ctaImage = asset('storage/images/cta.jpg');

@endphp
<div class="hero w-full mx-auto md:py-10  flex justify-start  h-[600px] px-6 sm:px-20 bg-[url('{{ $bgImage }}')] bg-cover bg-center">
    <div class="w-[1200px] mx-auto flex flex-col justify-center gap-8">

        <p class="border border-2 rounded-full max-w-max px-4 py-2 border-gray-300 bg-white">Exclusive Collections</p>
        <h1 class="text-3xl max-w-3xl sm:text-6xl">PREMIUM <span class="font-bold text-white">CLOTHES</span> FOR <span class="font-bold text-white">COMFORT</span> WEAR</h1>
        <p class="text-xl">Step into Ecomwave, where every garment tells a story of enduring style and quality.</p>
        <a class="bg-black max-w-max py-3 px-4 text-white shadow rounded-md" href="{{ route('shop') }}">Explore Shop</a>
    </div>
</div>

<!-- Search Section -->
<div class="mx-auto py-8 px-4 md:px-2 lg:px-0">
    <form method="GET" action="{{ route('home') }}" class=" flex gap-2">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search products..."
            class="flex-1 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-black focus:outline-none"
        >
        <button type="submit"
            class="bg-black py-3 px-4 text-white shadow font-semibold w-32 md:w-64 rounded-md">
            Search
        </button>
    </form>

    <!-- Show results only if there's a search -->
    @if($search)
        @if($products->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4  gap-3 md:gap-6 ">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @else
            <p class="text-gray-500 text-center">No products found.</p>
        @endif
    @endif
</div>






<!-- Collections Section -->
<div class="container mx-auto py-10 px-4 md:px-2 lg:px-0">
@foreach($collections as $collection)
    <div class="category-section mb-12">
        <h2 class="text-2xl font-bold mb-4">{{ $collection->name }}</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4  gap-3 md:gap-6">
            @foreach($collection->products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <!-- Button to category page -->
        <div class="mt-4 text-center">
            <a href="{{ route('collection', [$collection->id, $collection->slug]) }}" 
               class="bg-black max-w-max py-3 px-4 text-white shadow rounded-md">
               View Collection
            </a>
        </div>
    </div>
@endforeach

    
</div>
@endsection