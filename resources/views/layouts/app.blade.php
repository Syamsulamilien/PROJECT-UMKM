<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Baju Polos') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-[Poppins] antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                            <span class="ml-2 text-xl font-bold text-[#2A1B3D]">Baju Polos</span>
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden sm:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-[#44318D] px-3 py-2 text-sm font-medium transition-colors duration-200">Home</a>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-[#44318D] px-3 py-2 text-sm font-medium transition-colors duration-200">Products</a>
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-gray-600 hover:text-[#44318D] focus:outline-none">
                                    <span class="mr-2">{{ Auth::user()->name }}</span>
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Cart ({{ Auth::user()->cart()->count() }})
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-[#44318D] hover:text-[#2A1B3D] px-4 py-2 text-sm font-medium transition-colors duration-200">Login</a>
                            <a href="{{ route('register') }}" class="bg-[#44318D] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#2A1B3D] transition-colors duration-200">Register</a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button @click="open = !open" class="text-gray-600 hover:text-[#44318D] focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="open" class="sm:hidden bg-white border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="block text-gray-600 hover:text-[#44318D] px-3 py-2 text-base font-medium">Home</a>
                    <a href="{{ route('products.index') }}" class="block text-gray-600 hover:text-[#44318D] px-3 py-2 text-base font-medium">Products</a>
                    @auth
                        <a href="{{ route('profile.edit') }}" class="block text-gray-600 hover:text-[#44318D] px-3 py-2 text-base font-medium">Profile</a>
                        <a href="{{ route('cart.index') }}" class="block text-gray-600 hover:text-[#44318D] px-3 py-2 text-base font-medium">
                            Cart ({{ Auth::user()->cart()->count() }})
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left text-gray-600 hover:text-[#44318D] px-3 py-2 text-base font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block text-gray-600 hover:text-[#44318D] px-3 py-2 text-base font-medium">Login</a>
                        <a href="{{ route('register') }}" class="block text-gray-600 hover:text-[#44318D] px-3 py-2 text-base font-medium">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 3000)"
                 class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="space-y-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <p class="text-gray-500 text-sm">Your one-stop shop for high-quality plain clothes.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-[#44318D]">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-[#44318D]">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Products</h3>
                        <ul class="mt-4 space-y-2">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-gray-500 hover:text-[#44318D]">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Support</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-500 hover:text-[#44318D]">Contact Us</a></li>
                            <li><a href="#" class="text-gray-500 hover:text-[#44318D]">FAQ</a></li>
                            <li><a href="#" class="text-gray-500 hover:text-[#44318D]">Shipping Info</a></li>
                            <li><a href="#" class="text-gray-500 hover:text-[#44318D]">Returns</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Newsletter</h3>
                        <p class="mt-4 text-gray-500 text-sm">Subscribe to get special offers, free giveaways, and updates.</p>
                        <form class="mt-4">
                            <div class="flex">
                                <input type="email" required class="flex-1 min-w-0 px-4 py-2 text-sm text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-[#44318D] focus:border-[#44318D]" placeholder="Enter your email">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-[#44318D] hover:bg-[#2A1B3D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#44318D]">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <p class="text-center text-gray-400 text-sm">&copy; {{ date('Y') }} Baju Polos. Made with ❤️ in Indonesia</p>
                    <div class="mt-4 flex justify-center space-x-6">
                        <a href="#" class="text-gray-400 hover:text-[#44318D]">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-[#44318D]">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-[#44318D]">Shipping Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Drawer -->
    <div x-data="{ isOpen: false }" @keydown.window.escape="isOpen = false">
        <!-- Cart Button -->
        @auth
        <button @click="isOpen = true" 
                class="fixed bottom-4 right-4 z-50 bg-[#44318D] text-white p-3 rounded-full shadow-lg hover:bg-[#2A1B3D] transition-colors duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center">
                {{ Auth::user()->cart()->count() }}
            </span>
        </button>
        @endauth

        <!-- Cart Sidebar -->
        <div x-show="isOpen" 
             class="fixed inset-0 overflow-hidden z-50" 
             style="display: none;">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                     @click="isOpen = false"></div>

                <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
                    <div class="w-screen max-w-md">
                        <div class="h-full flex flex-col bg-white shadow-xl">
                            <div class="flex-1 py-6 overflow-y-auto px-4">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900">Shopping Cart</h2>
                                    <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                                            @auth
                                                @forelse(Auth::user()->cart as $cartItem)
                                                <li class="py-6 flex">
                                                    <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                                        <img src="{{ asset($cartItem->product->image) }}" 
                                                             alt="{{ $cartItem->product->name }}" 
                                                             class="w-full h-full object-center object-cover">
                                                    </div>

                                                    <div class="ml-4 flex-1 flex flex-col">
                                                        <div>
                                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3>{{ $cartItem->product->name }}</h3>
                                                                <p class="ml-4">Rp {{ number_format($cartItem->product->final_price, 0, ',', '.') }}</p>
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-500">{{ $cartItem->product->category->name }}</p>
                                                        </div>
                                                        <div class="flex-1 flex items-end justify-between text-sm">
                                                            <div class="flex items-center">
                                                                <label for="quantity" class="mr-2 text-gray-500">Qty</label>
                                                                <input type="number" 
                                                                       min="1" 
                                                                       value="{{ $cartItem->quantity }}" 
                                                                       class="w-16 rounded-md border-gray-300"
                                                                       onchange="updateCart({{ $cartItem->id }}, this.value)">
                                                            </div>

                                                            <form action="{{ route('cart.remove', $cartItem) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="font-medium text-[#44318D] hover:text-[#2A1B3D]">
                                                                    Remove
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                                @empty
                                                <li class="py-6 text-center text-gray-500">
                                                    Your cart is empty
                                                </li>
                                                @endforelse
                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            @auth
                            <div class="border-t border-gray-200 py-6 px-4">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p>Rp {{ number_format(Auth::user()->cart->sum(function($item) {
                                        return $item->product->final_price * $item->quantity;
                                    }), 0, ',', '.') }}</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                                <div class="mt-6">
                                    <a href="{{ route('checkout.index') }}" 
                                       class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#44318D] hover:bg-[#2A1B3D]">
                                        Checkout
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                                    <p>
                                        or <button @click="isOpen = false" class="text-[#44318D] font-medium hover:text-[#2A1B3D]">
                                            Continue Shopping<span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('modals')

    <!-- Scripts -->
    <script>
        function updateCart(cartId, quantity) {
            fetch(`/cart/update/${cartId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }
    </script>
</div>
</body>
</html>