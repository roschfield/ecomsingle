@extends('template')
@section('page_title')
Collection-Ecomwave
@endsection
@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">All {{ $collection->name }}</h1>
    @if($collection->products->isEmpty())
                   <p class="text-gray-500">No products available at the moment.</p>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        @foreach($collection->products as $product)
          <x-product-card :product="$product" />
        @endforeach
    </div>
</div>
@endsection