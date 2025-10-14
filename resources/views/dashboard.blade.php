@extends('template')
@section('page_title')
User Profile - Ecomwave
@endsection
@section('content')


  <header class="bg-white shadow mb-10 mx-4 md:mx-0 rounded-lg ">
    <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-gray-900">Welcome, {{ Auth::user()->name }}</h1>
      <a href="{{ route('logout') }}" 
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
         class="text-red-600 font-medium hover:underline">
        Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    </div>
  </header>

  <!-- Dashboard Grid -->
  <section class="max-w-7xl mx-4 md:mx-0 py-6">
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- My Orders -->
      <a href="{{ route('orders.index') }}" 
         class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex flex-col items-center text-center">
        <div class="bg-green-100 p-4 rounded-full mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1 9H4L3 3z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13h14l-1 8H6l-1-8z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">My Orders</h3>
        <p class="text-gray-500 text-sm">View and track all your orders.</p>
      </a>

      <!-- My Cart -->
      <a href="{{ route('cart.cart') }}" 
         class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex flex-col items-center text-center">
        <div class="bg-blue-100 p-4 rounded-full mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h14l1-5H6.4M7 13l-1 5h15M7 13l-4-8" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">My Cart</h3>
        <p class="text-gray-500 text-sm">Check items added to your cart.</p>
      </a>

      <!-- My Info -->
      <div
         class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex flex-col items-center text-center">
        <div class="bg-yellow-100 p-4 rounded-full mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.969 7.969 0 0112 15a7.969 7.969 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <h3 class="text-lg font-semibold">My Info</h3>
        <p class="text-gray-500 text-sm">Here’s your account information:</p>
        <div class="bg-gray-50 p-3 mt-3  rounded-md w-full">
          <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
          <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
        </div>
      </div>
    </div>
  </section>
@endsection