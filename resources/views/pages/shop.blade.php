@extends('template')
@section('page_title')
Shop-Ecomwave
@endsection
@section('content')
<section class=" flex justify-center">
          <div class="w-full max-w-[1200px]  flex flex-col gap-6 px-4 sm:px-2 md:px-0">
            
            <!-- Heading -->
            <div class="flex justify-start items-center">
              <h2 class="text-2xl sm:text-3xl font-semibold text-black">Browse Categories</h2>
            </div>
        
            <!-- Categories Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                @foreach ($categories as $category )
                  <div class="h-56 rounded-[16px] md:rounded-[32px] flex items-end p-4" 
                    style="background-image: url('{{ asset('storage/' . $category->image) }}'); background-size: cover; background-position: center;">
                      <a href="{{ route('category',[$category->id,$category->slug]) }}" class="px-4 py-2.5 bg-white rounded-full font-semibold text-black text-lg">
                        {{ $category->name }}
                      </a>
                  </div>
                @endforeach
            </div>

             <!-- Filter & Sort -->
              <form method="GET" action="{{ route('shop') }}" class="bg-gray-50 border p-4 my-8 rounded-lg flex flex-wrap gap-4 items-end">
                  <!-- Price Range -->
                  <div class="flex gap-4 items-center">
                      <label class="block text-sm font-semibold mb-1">Price Range</label>
                      <div class="flex gap-2">
                          <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}"
                              class="w-24 border rounded-md p-2">
                          <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}"
                              class="w-24 border rounded-md p-2">
                      </div>
                  </div>
                  

                  <!-- In Stock -->
                  <div class="flex gap-4 items-center">
                      <label class="block text-sm font-semibold mb-1">Availability</label>
                      <select name="in_stock" class="border rounded-md py-2 px-3 w-36">
                          <option value="">All</option>
                          <option value="1" {{ request('in_stock') == '1' ? 'selected' : '' }}>In Stock</option>
                          <option value="0" {{ request('in_stock') == '0' ? 'selected' : '' }}>Out of Stock</option>
                      </select>
                  </div>

                  <!-- Collection -->
                  <div class="flex gap-4 items-center">
                      <label class="block text-sm font-semibold mb-1">Collection</label>
                      <select name="collection" class="border rounded-md p-2">
                          <option value="">All Collections</option>
                          @foreach ($collections as $collection)
                              <option value="{{ $collection->id }}" {{ request('collection') == $collection->id ? 'selected' : '' }}>
                                  {{ $collection->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Sorting -->
                  <div class="flex gap-4 items-center">
                      <label class="block text-sm font-semibold mb-1">Sort By</label>
                      <select name="sort" class="border rounded-md p-2">
                          <option value="">Default</option>
                          <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                          <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                          <option value="low_high" {{ request('sort') == 'low_high' ? 'selected' : '' }}>Price: Low to High</option>
                          <option value="high_low" {{ request('sort') == 'high_low' ? 'selected' : '' }}>Price: High to Low</option>
                      </select>
                  </div>

                  <div class="flex-1 flex justify-end">
                      <button type="submit" class="bg-black w-full text-white px-4 py-2 rounded-md">Apply</button>
                  </div>
            </form>

            <!-- Prodcuts Grid -->
             <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4  gap-3 md:gap-6">
           
                @if($products->isEmpty())
                   <p class="text-gray-500">No products available at the moment.</p>
                @endif
                @foreach($products as $product)
                
                <x-product-card :product="$product" />
         
              @endforeach
            </div>
          </div>
        </section>
@endsection