@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-primary-500 py-20">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-bg.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Discover Your Perfect Style</h1>
        <p class="text-xl text-gray-200 mb-8">High-quality plain clothes for every occasion</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('products.index') }}" 
               class="bg-secondary-500 text-white px-8 py-3 rounded-md hover:bg-secondary-600 transition-colors duration-200">
                Shop Now
            </a>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-primary-500 mb-8">Featured Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-primary-500">{{ $product->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ $product->category->name }}</p>
                    <p class="text-secondary-500 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.show', $product) }}" 
                       class="mt-4 block w-full text-center bg-primary-600 text-white py-2 px-4 rounded hover:bg-accent-600 transition-colors duration-200">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Categories Section -->
<section id="categories" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Shop by Category</h2>
            <p class="mt-4 text-gray-500">Find exactly what you're looking for</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
               class="group relative h-64 overflow-hidden rounded-lg">
                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" 
                     class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300">
                    <div class="flex h-full items-center justify-center">
                        <h3 class="text-2xl font-bold text-white">{{ $category->name }}</h3>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-[#44318D]/10 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#44318D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 8l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Free Shipping</h3>
                <p class="mt-2 text-gray-500">On orders over Rp 500.000</p>
            </div>
            <div class="text-center">
                <div class="bg-[#44318D]/10 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#44318D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Easy Returns</h3>
                <p class="mt-2 text-gray-500">30-day return policy</p>
            </div>
            <div class="text-center">
                <div class="bg-[#44318D]/10 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#44318D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Secure Payments</h3>
                <p class="mt-2 text-gray-500">100% secure checkout</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-primary-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white">Join Our Newsletter</h2>
            <p class="mt-4 text-gray-300">Stay updated with our latest products and exclusive offers.</p>
            <form class="mt-8 flex flex-col sm:flex-row gap-4">
                <input type="email" required 
                       class="flex-1 min-w-0 px-4 py-3 text-gray-900 placeholder-gray-500 bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-white"
                       placeholder="Enter your email">
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-[#44318D] bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>
@endsection