@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
        <!-- Image gallery -->
        <div class="flex flex-col">
            <div class="overflow-hidden rounded-lg">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
            </div>
        </div>

        <!-- Product info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>
            
            <div class="mt-3">
                <p class="text-3xl text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            <div class="mt-6">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 space-y-6">
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            <div class="mt-6">
                <div class="flex items-center">
                    <h3 class="text-sm text-gray-600">Category:</h3>
                    <p class="ml-2 text-sm text-gray-900">{{ $product->category->name }}</p>
                </div>
                <div class="flex items-center mt-2">
                    <h3 class="text-sm text-gray-600">Stock:</h3>
                    <p class="ml-2 text-sm text-gray-900">{{ $product->stock }}</p>
                </div>
            </div>

            @auth
            <div class="mt-8">
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <div class="flex items-center">
                        <label for="quantity" class="mr-4 text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1"
                               class="shadow-sm focus:ring-[#44318D] focus:border-[#44318D] block w-20 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <button type="submit"
                            class="mt-8 w-full bg-[#44318D] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-[#2A1B3D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#44318D]">
                        Add to Cart
                    </button>
                </form>
            </div>
            @else
            <div class="mt-8">
                <a href="{{ route('login') }}"
                   class="w-full bg-[#44318D] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-[#2A1B3D]">
                    Login to Add to Cart
                </a>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection