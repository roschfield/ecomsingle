


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('page_title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  
</head>
<body>
  <!-- Navbar with Mega Menu -->
  <nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex-shrink-0 flex items-center">
            <img class="block h-8 w-auto" src="{{ asset('storage/images/logo.svg') }}" alt="Logo">
            <span class="ml-2 text-xl font-bold text-gray-800">Ecomwave</span>
          </div>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <a href="{{ route('home') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Home</a>

              <!-- Categories Dropdown Trigger -->
              <div class="relative group">
                <button class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium flex items-center">
                                    Categories
                                    <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                </button>

                <!-- Mega Menu -->
                <div
                  class="absolute left-10 mt-2 w-60 max-w-6xl bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform -translate-x-1/4">
                  <div class="grid grid-cols-1 gap-8 p-6">
                    <div class="w-full">
                      <ul class="space-y-3 w-full">
                         @php
                              $categories = App\Models\Category::latest()->get();
                         @endphp
                         @foreach ($categories as $category )
                  
                           <li>
                              <a href="{{ route('category',[$category->id,$category->slug]) }}" class="text-gray-600 hover:text-indigo-600">
                                   {{ $category->name }}
                              </a>
                            </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <a href="{{ route('shop') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Shop</a>
              <a href="{{ route('about') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">About</a>
              <a href="{{ route('contact') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
            </div>
          </div>
        </div>
         <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
              <!-- Right side (Cart + Auth) -->
              <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 space-x-4">

                <!-- Cart Icon -->
                <a href="{{ route('cart.cart') }}" class="relative flex items-center text-gray-700 hover:text-gray-900">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                  </svg>

                  @php $cartCount = count(session('cart', [])); @endphp
                  @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1">
                      {{ $cartCount }}
                    </span>
                  @endif
                </a>

                <!-- Auth Links -->
                @auth
                  <!-- User Dropdown -->
                  <div class="relative group">
                    <button class="flex items-center space-x-1 text-gray-700 hover:text-gray-900">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>

                      <span>{{ Auth::user()->name }}</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                      <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                      </form>
                    </div>
                  </div>
                @else
                  <!-- Guest -->
                  <a href="{{ route('login') }}" class="block rounded-sm bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900 transition hover:scale-105">Login</a>
                  <a href="{{ route('register') }}" class="ml-2 block rounded-sm bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:scale-105">Sign Up</a>
                @endauth
              </div>

             <!-- Mobile menu button -->
            <div class="sm:hidden">
            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false" id="mobile-menu-button">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
           </button>
            </div>
         </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div class="sm:hidden hidden" id="mobile-menu">
      <div class="flex flex-col px-2 pt-2 pb-3 space-y-1">
        <a href="#" class="hover:bg-gray-100 text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Home</a>

        <!-- Mobile Products Dropdown -->
        <div class="relative">
          <button class="w-full text-left text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium flex items-center justify-between mobile-dropdown-trigger">
                        Categories
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
          <div class="hidden px-4 py-2 mobile-dropdown-content">
            <div class="border-l-2 border-indigo-500 pl-2 mb-4">
              <ul class="space-y-2">
             
                  @foreach ($categories as $category )
                            <li>  
                      
                              <a href="{{ route('category',[$category->id,$category->slug]) }}" class="text-gray-600 hover:text-indigo-600">
                                   {{ $category->name }}
                              </a>
                            </li>
                   @endforeach
              </ul>
            </div>
           
          </div>
        </div>

        <a href="{{ route('shop') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Shop</a>
        <a href="{{ route('about') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">About</a>
        <a href="{{ route('contact') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Contact</a>

        <div class="pt-4 pb-3 border-t border-gray-200">
          <div class="flex items-center px-3 space-y-2 flex-col">
            <a href="#"
              class="block w-full text-center text-gray-900 bg-gray-100 px-3 py-2 text-base font-medium">
              Login
            </a>
            <a href="#"
              class="block w-full text-center bg-gray-900 text-white px-3 py-2 text-base font-medium">
              Sign Up
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Page content -->
  <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @yield('content')
  </div>

<!-- Newsletter Section-->
<section class="w-full bg-gradient-to-r from-[#00766e] via-green-800 to-[#00766e] py-16 px-4">
  <div class="max-w-[1200px] mx-auto text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
      Subscribe to our Newsletter
    </h2>
    <p class="text-green-200 mb-8 max-w-2xl mx-auto">
      Get the latest updates, articles, and resources straight to your inbox.
    </p>

    <form class="flex flex-col sm:flex-row items-center justify-center gap-4 max-w-2xl mx-auto">
      <input 
        type="email" 
        placeholder="Enter your email" 
        class="w-full sm:flex-1 px-4 py-3  border  focus:outline-none focus:ring-2 focus:ring-green-400"
      >
      <button 
        type="submit" 
        class="px-6 py-3 bg-black  text-white font-medium  transition-colors duration-200 w-full sm:w-auto"
      >
        Subscribe
      </button>
    </form>
  </div>
</section>

<!-- Footer -->
<footer class="bg-black text-white pt-12 pb-8">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
      <!-- Company Info -->
      <div class="space-y-4">
        <div class="flex items-center">
          <img class="block h-8 w-auto" src="{{ asset('storage/images/logo.svg') }}" alt="Logo">
          <span class="ml-2 text-xl font-bold">Ecomwave</span>
        </div>
        <p class="text-gray-300">Quality products, delivered with care.</p>
        
      </div>

      <!-- Quick Links -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold">Quick Links</h3>
        <ul class="space-y-2">
          <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition">Home</a></li>
          <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition">About Us</a></li>
          <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition">Contact</a></li>
         
        </ul>
      </div>

      <!-- Services -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold">Help</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-300 hover:text-white transition">Delivery Details</a></li>
          <li><a href="#" class="text-gray-300 hover:text-white transition">Privacy Policy</a></li>
          <li><a href="#" class="text-gray-300 hover:text-white transition">Terms & Conditions</a></li>
         
        </ul>
      </div>

      <!-- Contact -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold">Contact Us</h3>
        <address class="not-italic text-gray-300">
          <p>123 Hazarilane, </p>
          <p>Chattogram Bangladesh</p>
          <p class="mt-2">Email: <a href="mailto:info@company.com" class="hover:text-white transition">info@ecomwave.com</a></p>
          <p>Phone: <a href="tel:+11234567890" class="hover:text-white transition">+880145 324 55464</a></p>
        </address>
      </div>
    </div>

    <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
      <p class="text-gray-300 text-sm mb-4 md:mb-0">© 2025 Ecomwave. All rights reserved.</p>
      <div class="flex space-x-6">
        <a href="#" class="text-gray-300 hover:text-white transition">
            <span class="sr-only">Twitter</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
            </svg>
          </a>
        <a href="#" class="text-gray-300 hover:text-white transition">
            <span class="sr-only">Instagram</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#" class="text-gray-300 hover:text-white transition">
            <span class="sr-only">LinkedIn</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
            </svg>
          </a>
      </div>
    </div>
  </div>
</footer>




  <script>
    // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
        });
        
        // Mobile dropdown toggles
        document.querySelectorAll('.mobile-dropdown-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const content = this.nextElementSibling;
                content.classList.toggle('hidden');
            });
        });
  </script>
</body>

</html>

