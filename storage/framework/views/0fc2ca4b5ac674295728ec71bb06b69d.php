

<?php $__env->startSection('content'); ?>
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="<?php echo e(route('home')); ?>" class="text-gray-400 hover:text-gray-500">Home</a>
                </li>
                <li>
                    <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-700">Products</span>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <!-- Filters Sidebar -->
            <div class="hidden lg:block">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Filters</h2>
                
                <!-- Categories Filter -->
                <div class="mb-8">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Categories</h3>
                    <div class="space-y-2">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="category-<?php echo e($category->id); ?>"
                                   name="categories[]" 
                                   value="<?php echo e($category->id); ?>"
                                   class="h-4 w-4 text-[#44318D] focus:ring-[#44318D] border-gray-300 rounded">
                            <label for="category-<?php echo e($category->id); ?>" class="ml-2 text-sm text-gray-600">
                                <?php echo e($category->name); ?>

                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-8">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Price Range</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="min-price" class="text-sm text-gray-600">Min Price</label>
                            <input type="number" id="min-price" name="min_price" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring focus:ring-[#44318D] focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="max-price" class="text-sm text-gray-600">Max Price</label>
                            <input type="number" id="max-price" name="max_price"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring focus:ring-[#44318D] focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <!-- Sort and Filter Controls -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500">Showing <?php echo e($products->firstItem()); ?> - <?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> products</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <select class="rounded-md border-gray-300 text-sm focus:border-[#44318D] focus:ring focus:ring-[#44318D] focus:ring-opacity-50">
                            <option>Sort by: Default</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest First</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group relative">
                        <div class="relative aspect-square overflow-hidden rounded-lg bg-gray-100">
                            <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" 
                                 class="h-full w-full object-cover object-center group-hover:opacity-75 transition duration-300">
                            <?php if($product->discount > 0): ?>
                                <div class="absolute top-2 right-2 bg-red-500 text-white text-sm px-2 py-1 rounded-full">
                                    -<?php echo e($product->discount); ?>%
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity duration-300 flex items-center justify-center">
                                <div class="translate-y-8 group-hover:translate-y-0 transition-transform duration-300">
                                    <a href="<?php echo e(route('products.show', $product)); ?>" 
                                       class="inline-flex items-center px-4 py-2 bg-white text-[#44318D] rounded-md hover:bg-[#44318D] hover:text-white transition duration-300">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-sm text-gray-700"><?php echo e($product->name); ?></h3>
                            <p class="mt-1 text-sm text-gray-500"><?php echo e($product->category->name); ?></p>
                            <div class="mt-2 flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-medium text-[#44318D]">
                                        Rp <?php echo e(number_format($product->final_price, 0, ',', '.')); ?>

                                    </span>
                                    <?php if($product->discount > 0): ?>
                                        <span class="ml-2 text-sm text-gray-500 line-through">
                                            Rp <?php echo e(number_format($product->original_price, 0, ',', '.')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <?php if(auth()->guard()->check()): ?>
                                    <form action="<?php echo e(route('cart.add', $product)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" 
                                                class="p-2 text-[#44318D] hover:bg-[#44318D]/10 rounded-full transition duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                            </svg>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Filter Dialog -->
<div x-data="{ open: false }" class="lg:hidden">
    <!-- Mobile filter button -->
    <button type="button" 
            @click="open = true"
            class="fixed bottom-4 right-4 inline-flex items-center rounded-full bg-[#44318D] p-3 text-white shadow-lg">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
        </svg>
    </button>

    <!-- Filter dialog -->
    <div x-show="open" 
         class="relative z-50" 
         aria-labelledby="slide-over-title" 
         role="dialog" 
         aria-modal="true">
        <div x-show="open" 
             x-transition:enter="ease-in-out duration-500" 
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in-out duration-500" 
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div x-show="open" 
                         x-transition:enter="transform transition ease-in-out duration-500" 
                         x-transition:enter-start="translate-x-full"
                         x-transition:enter-end="translate-x-0" 
                         x-transition:leave="transform transition ease-in-out duration-500" 
                         x-transition:leave-start="translate-x-0"
                         x-transition:leave-end="translate-x-full" 
                         class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex items-center justify-between px-4 py-6">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Filters</h2>
                                <button type="button" 
                                        @click="open = false"
                                        class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="px-4 pb-6">
                                <!-- Mobile Filters Content -->
                                <!-- Categories -->
                                <div class="mb-8">
                                    <h3 class="text-sm font-medium text-gray-900 mb-3">Categories</h3>
                                    <div class="space-y-2">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                   id="mobile-category-<?php echo e($category->id); ?>"
                                                   name="categories[]" 
                                                   value="<?php echo e($category->id); ?>"
                                                   class="h-4 w-4 text-[#44318D] focus:ring-[#44318D] border-gray-300 rounded">
                                            <label for="mobile-category-<?php echo e($category->id); ?>" class="ml-2 text-sm text-gray-600">
                                                <?php echo e($category->name); ?>

                                            </label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <!-- Price Range -->
                                <div class="mb-8">
                                    <h3 class="text-sm font-medium text-gray-900 mb-3">Price Range</h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label for="mobile-min-price" class="text-sm text-gray-600">Min Price</label>
                                            <input type="number" 
                                                   id="mobile-min-price" 
                                                   name="min_price" 
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring focus:ring-[#44318D] focus:ring-opacity-50">
                                        </div>
                                        <div>
                                            <label for="mobile-max-price" class="text-sm text-gray-600">Max Price</label>
                                            <input type="number" 
                                                   id="mobile-max-price" 
                                                   name="max_price"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring focus:ring-[#44318D] focus:ring-opacity-50">
                                        </div>
                                    </div>
                                </div>

                                <!-- Apply Filters Button -->
                                <button type="button"
                                        class="w-full bg-[#44318D] text-white px-4 py-2 rounded-md hover:bg-[#2A1B3D] transition duration-300">
                                    Apply Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\baju-polos\resources\views/products/index.blade.php ENDPATH**/ ?>