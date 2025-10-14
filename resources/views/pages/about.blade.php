@extends('template')
@section('page_title')
About-Ecomwave
@endsection
@section('content')

<section class="w-full py-16 px-6 ">
  <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">

    <div>
      <h2 class="text-4xl font-bold text-gray-900 mb-6">About <span class="text-green-600">EcomWave</span></h2>
      <p class="text-gray-600 mb-4 leading-relaxed">
        Welcome to <strong>EcomWave</strong> — your trusted online destination for quality products and seamless shopping.  
        Our mission is to make online shopping not just convenient but enjoyable.
      </p>
      <p class="text-gray-600 mb-4 leading-relaxed">
        We focus on providing authentic, high-quality products across various categories while maintaining top-tier customer
        support and fast delivery. Our team is passionate about innovation, sustainability, and customer satisfaction.
      </p>
      <a href="{{ route('shop') }}" class="inline-block mt-4 px-6 py-3 bg-black text-white font-medium rounded-md hover:bg-gray-800 transition">
        Shop Now
      </a>
    </div>

    <!-- Right Image Column -->
    <div class="relative">
      <img src="{{ asset('storage/images/about-banner.jpg') }}" alt="About Us" class="w-full h-auto rounded-lg shadow-lg object-cover">
      <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent rounded-lg"></div>
    </div>
  </div>
</section>

<!-- Our Vision Section -->
<section class="w-full py-20 b">
  <div class="max-w-6xl mx-auto text-center mb-12 px-4 md:px-0">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Vision</h2>
    <p class="text-gray-600 max-w-2xl mx-auto">
      We are driven by values that shape our business and strengthen our bond with customers worldwide.
    </p>
  </div>

  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6">
    <!-- Vision Card 1 -->
    <div class="bg-gray-50 p-8 rounded-lg shadow-sm hover:shadow-md transition">
      <div class="bg-green-100 w-12 h-12 flex items-center justify-center rounded-full mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
        </svg>
      </div>
      <h3 class="text-xl font-semibold mb-3">Innovation</h3>
      <p class="text-gray-600">
        We constantly evolve by integrating modern technology and trends to improve the shopping experience.
      </p>
    </div>

    <!-- Vision Card 2 -->
    <div class="bg-gray-50 p-8 rounded-lg shadow-sm hover:shadow-md transition">
      <div class="bg-green-100 w-12 h-12 flex items-center justify-center rounded-full mb-5 ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>
      <h3 class="text-xl font-semibold mb-3">Trust & Quality</h3>
      <p class="text-gray-600">
        Our goal is to build long-term relationships by offering verified, durable products that meet your expectations.
      </p>
    </div>

    <!-- Vision Card 3 -->
    <div class="bg-gray-50 p-8 rounded-lg shadow-sm hover:shadow-md transition">
      <div class="bg-green-100 w-12 h-12 flex items-center justify-center rounded-full mb-5 ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
        </svg>
      </div>
      <h3 class="text-xl font-semibold mb-3">Sustainability</h3>
      <p class="text-gray-600">
        We are committed to reducing our carbon footprint through eco-friendly packaging and ethical sourcing.
      </p>
    </div>
  </div>
</section>

<!-- Store Location Section -->
<section class="w-full py-20 px-6 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
  <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
    <!-- Store Info -->
    <div>
      <h2 class="text-3xl font-bold mb-6">Visit Our Store</h2>
      <p class="mb-4 text-green-100">
        Experience our products in person at our flagship location. Our team will be happy to assist you with personalized service and product recommendations.
      </p>

      <ul class="space-y-2">
        <li><strong>Address:</strong>123 Hazarilane, Chattogram Bangladesh</li>
        <li><strong>Hours:</strong> Sat – Thu: 10:00 AM – 8:00 PM</li>
        <li><strong>Phone:</strong> +880145 324 55464</li>
        <li><strong>Email:</strong> support@ecomwave.com</li>
      </ul>
    </div>

    <!-- Embedded Map -->
    <div class="rounded-xl overflow-hidden shadow-lg">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.530987646263!2d91.82207317437389!3d22.33606497965815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd8821b8a6a1b%3A0x33f2b63cb72c736e!2sHazari%20Ln%2C%20Chittagong!5e0!3m2!1sen!2sbd!4v1728916547892!5m2!1sen!2sbd" 
        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
      </iframe>
    </div>
  </div>
</section>

@endsection

 
  