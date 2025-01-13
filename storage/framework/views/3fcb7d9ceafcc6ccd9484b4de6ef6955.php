

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
        <!-- Image gallery -->
        <div class="flex flex-col">
            <div class="overflow-hidden rounded-lg">
                <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-center object-cover">
            </div>
        </div>

        <!-- Product info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900"><?php echo e($product->name); ?></h1>
            
            <div class="mt-3">
                <p class="text-3xl text-gray-900">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
            </div>

            <div class="mt-6">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 space-y-6">
                    <p><?php echo e($product->description); ?></p>
                </div>
            </div>

            <div class="mt-6">
                <div class="flex items-center">
                    <h3 class="text-sm text-gray-600">Category:</h3>
                    <p class="ml-2 text-sm text-gray-900"><?php echo e($product->category->name); ?></p>
                </div>
                <div class="flex items-center mt-2">
                    <h3 class="text-sm text-gray-600">Stock:</h3>
                    <p class="ml-2 text-sm text-gray-900"><?php echo e($product->stock); ?></p>
                </div>
            </div>

            <?php if(auth()->guard()->check()): ?>
            <div class="mt-8">
                <form action="<?php echo e(route('cart.add', $product)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="flex items-center">
                        <label for="quantity" class="mr-4 text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="1" max="<?php echo e($product->stock); ?>" value="1"
                               class="shadow-sm focus:ring-[#44318D] focus:border-[#44318D] block w-20 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <button type="submit"
                            class="mt-8 w-full bg-[#44318D] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-[#2A1B3D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#44318D]">
                        Add to Cart
                    </button>
                </form>
            </div>
            <?php else: ?>
            <div class="mt-8">
                <a href="<?php echo e(route('login')); ?>"
                   class="w-full bg-[#44318D] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-[#2A1B3D]">
                    Login to Add to Cart
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\baju-polos\resources\views/products/show.blade.php ENDPATH**/ ?>