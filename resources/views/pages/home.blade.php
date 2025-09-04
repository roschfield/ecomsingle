@extends('template')
@section('page_title')
Home-Ecomwave
@endsection
@section('content')
<div class="container mx-auto py-10">
    
@foreach($collections as $collection)
    <div class="category-section mb-12">
        <h2 class="text-2xl font-bold mb-4">{{ $collection->name }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($collection->products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <!-- Button to category page -->
        <div class="mt-4 text-center">
            <a href="{{ route('collection', [$collection->id, $collection->slug]) }}" 
               class="px-6 py-2 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700">
               View Collection
            </a>
        </div>
    </div>
@endforeach

    
</div>
@endsection