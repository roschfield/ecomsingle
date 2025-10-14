@extends('template')
@section('page_title')
Contact-Ecomwave
@endsection
@section('content')

  <!-- Header -->
  <header class=" shadow-sm py-6 mb-10">
    <div class="max-w-6xl mx-auto px-6 flex flex-col justify-center items-center">
      <h1 class="text-3xl font-bold text-gray-900">Contact Us</h1>
      <p class="text-gray-500">We’d love to hear from you. Send us a message below.</p>
    </div>
  </header>

  <!-- Contact Form -->
  <section class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8">
    @if (session('success'))
      <div class="mb-6 p-4 text-green-800 bg-green-100 border border-green-200 rounded">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-6 p-4 text-red-800 bg-red-100 border border-red-200 rounded">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-600"
          placeholder="Enter your name" required>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-600"
          placeholder="Enter your email" required>
      </div>

      <div>
        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
        <textarea id="message" name="message" rows="5"
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-600"
          placeholder="Write your message here..." required>{{ old('message') }}</textarea>
      </div>

      <div class="text-center">
        <button type="submit"
          class="bg-green-700 hover:bg-green-800 text-white font-medium px-8 py-3 rounded-lg transition-colors duration-200">
          Send Message
        </button>
      </div>
    </form>
  </section>

@endsection