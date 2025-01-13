

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Shopping Cart</h2>
            <?php if($cartItems->count() > 0): ?>
                <div class="divide-y divide-gray-200">
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="py-6 flex items-center">
                        <img src="<?php echo e(asset($item->product->image)); ?>" alt="<?php echo e($item->product->name); ?>" 
                             class="w-24 h-24 object-cover rounded">
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-medium text-gray-900"><?php echo e($item->product->name); ?></h3>
                            <p class="mt-1 text-sm text-gray-500"><?php echo e($item->product->category->name); ?></p>
                            <p class="mt-1 text-sm font-medium text-[#44318D]">
                                Rp <?php echo e(number_format($item->product->price, 0, ',', '.')); ?>

                            </p>
                            <form action="<?php echo e(route('cart.update', $item)); ?>" method="POST" class="mt-2 flex items-center">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <label for="quantity-<?php echo e($item->id); ?>" class="sr-only">Quantity</label>
                                <input type="number" id="quantity-<?php echo e($item->id); ?>" name="quantity" 
                                       value="<?php echo e($item->quantity); ?>" min="1" max="<?php echo e($item->product->stock); ?>"
                                       class="shadow-sm focus:ring-[#44318D] focus:border-[#44318D] block w-20 sm:text-sm border-gray-300 rounded-md">
                                <button type="submit" class="ml-2 text-sm text-[#44318D] hover:text-[#2A1B3D]">
                                    Update
                                </button>
                            </form>
                        </div>
                        <form method="POST" action="<?php echo e(route('cart.remove', $item)); ?>" class="ml-4">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-900">Remove</button>
                        </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Subtotal</p>
                        <p>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></p>
                    </div>
                    <div class="mt-6">
                        <a href="<?php echo e(route('checkout.index')); ?>" 
                           class="block w-full bg-[#44318D] text-white text-center py-3 rounded-md hover:bg-[#2A1B3D]">
                            Proceed to Checkout
                        </a>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e(route('home')); ?>" 
                           class="block w-full bg-gray-200 text-gray-700 text-center py-3 rounded-md hover:bg-gray-300">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center py-8">Your cart is empty.</p>
                <div class="mt-4">
                    <a href="<?php echo e(route('home')); ?>" 
                       class="block w-full bg-[#44318D] text-white text-center py-3 rounded-md hover:bg-[#2A1B3D]">
                        Start Shopping
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\samsul\baju-polos\resources\views/cart/index.blade.php ENDPATH**/ ?>