

<?php $__env->startSection('header', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Order Information</h3>
                <div class="mt-4 space-y-2">
                    <p><span class="font-medium">Order Number:</span> <?php echo e($order->order_number); ?></p>
                    <p><span class="font-medium">Date:</span> <?php echo e($order->created_at->format('d M Y H:i')); ?></p>
                    <p><span class="font-medium">Status:</span> 
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            <?php echo e($order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                               ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 
                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </p>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900">Customer Information</h3>
                <div class="mt-4 space-y-2">
                    <p><span class="font-medium">Name:</span> <?php echo e($order->user->name); ?></p>
                    <p><span class="font-medium">Email:</span> <?php echo e($order->user->email); ?></p>
                    <p><span class="font-medium">Shipping Address:</span><br><?php echo e($order->shipping_address); ?></p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900">Order Items</h3>
            <div class="mt-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="<?php echo e(asset($item->product->image)); ?>" alt="<?php echo e($item->product->name); ?>" class="h-16 w-16 object-cover rounded">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo e($item->product->name); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo e($item->quantity); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?></div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-medium">Total:</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-bold text-gray-900">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900">Update Status</h3>
            <form action="<?php echo e(route('admin.orders.update', $order)); ?>" method="POST" class="mt-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="flex items-center gap-4">
                    <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                        <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="processing" <?php echo e($order->status === 'processing' ? 'selected' : ''); ?>>Processing</option>
                        <option value="completed" <?php echo e($order->status === 'completed' ? 'selected' : ''); ?>>Completed</option>
                        <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-[#44318D] text-white px-4 py-2 rounded-lg hover:bg-[#2A1B3D]">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\samsul\baju-polos\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>