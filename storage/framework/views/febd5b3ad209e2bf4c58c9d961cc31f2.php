<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?> - Admin</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>

</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-[#2A1B3D] text-white">
            <div class="flex items-center justify-center h-16 border-b border-[#44318D]">
                <h1 class="text-xl font-bold">Baju Polos Admin</h1>
            </div>
            <nav class="mt-6">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center px-6 py-3 text-gray-100 hover:bg-[#44318D]">
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo e(route('admin.products.index')); ?>" class="flex items-center px-6 py-3 text-gray-100 hover:bg-[#44318D]">
                    <span>Products</span>
                </a>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="flex items-center px-6 py-3 text-gray-100 hover:bg-[#44318D]">
                    <span>Orders</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800"><?php echo $__env->yieldContent('header'); ?></h2>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\baju-polos\resources\views/layouts/admin.blade.php ENDPATH**/ ?>