@extends('template')
@section('page_title')
Category-Ecomwave
@endsection
@section('content')
<div class="container mx-auto py-10 px-4 md:px-2 lg:px-0">
    <h1 class="text-3xl font-bold mb-6">{{ $category->name }}</h1>
    @if($category->products->isEmpty())
                   <p class="text-gray-500">No products available at the moment.</p>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4  gap-3 md:gap-6">
        @foreach($category->products as $product)
          <x-product-card :product="$product" />
        @endforeach
    </div>
</div>
@endsection