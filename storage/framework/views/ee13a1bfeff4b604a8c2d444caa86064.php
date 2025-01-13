

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Checkout</h2>
            <form action="<?php echo e(route('checkout.store')); ?>" method="POST" id="checkoutForm">
                <?php echo csrf_field(); ?>
                <div class="space-y-6">
                    <!-- Provinsi -->
                    <div>
                        <label for="province_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <select id="province_id" name="province_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
            
                    <!-- Kota -->
                    <div>
                        <label for="city_id" class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                        <select id="city_id" name="city_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                            <option value="">Pilih Kota/Kabupaten</option>
                        </select>
                    </div>
            
                    <!-- Kurir -->
                    <div>
                        <label for="courier_id" class="block text-sm font-medium text-gray-700">Kurir</label>
                        <select id="courier_id" name="courier" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                            <option value="">Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
            
                    <!-- Layanan Pengiriman -->
                    <div>
                        <label for="service_id" class="block text-sm font-medium text-gray-700">Layanan Pengiriman</label>
                        <select id="service_id" name="service" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                            <option value="">Pilih Layanan</option>
                        </select>
                    </div>
            
                    <!-- Alamat Lengkap -->
                    <div>
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea
                            id="shipping_address"
                            name="shipping_address"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]"
                            required></textarea>
                    </div>
            
                    <!-- Rincian Biaya -->
                    <div class="border-t border-gray-200 pt-6 space-y-2">
                        <div class="flex justify-between text-base text-gray-700">
                            <p>Subtotal</p>
                            <p id="subtotal">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></p>
                        </div>
                        <div class="flex justify-between text-base text-gray-700">
                            <p>Ongkos Kirim</p>
                            <p id="shippingCost">Rp 0</p>
                        </div>
                        <div class="flex justify-between text-base font-medium text-gray-900 pt-2 border-t">
                            <p>Total</p>
                            <p id="totalAmount">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></p>
                        </div>
                    </div>
            
                    <!-- Hidden Inputs -->
                    <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="0">
                    <input type="hidden" name="shipping_courier" id="shipping_courier_input">
                    <input type="hidden" name="shipping_service" id="shipping_service_input">
            
                    <button type="submit" class="w-full bg-[#44318D] text-white py-3 rounded-md hover:bg-[#2A1B3D]">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Load provinces
        fetch('/api/provinces', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(provinces => {
            const provinceSelect = document.getElementById('province_id');
            provinces.forEach(province => {
                provinceSelect.innerHTML += `<option value="${province.province_id}">${province.province}</option>`;
            });
        })
        .catch(error => {
            console.error('Error loading provinces:', error);
        });
    
        // Province change handler
        document.getElementById('province_id').addEventListener('change', function() {
            const provinceId = this.value;
            const citySelect = document.getElementById('city_id');
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
    
            if (provinceId) {
                fetch(`/api/cities/${provinceId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(cities => {
                    cities.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.city_id}">${city.type} ${city.city_name}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error loading cities:', error);
                });
            }
        });
    
        // Courier change handler
        document.getElementById('courier_id').addEventListener('change', function() {
            const cityId = document.getElementById('city_id').value;
            const courier = this.value;
            const serviceSelect = document.getElementById('service_id');
            
            if (!cityId) {
                alert('Silakan pilih kota terlebih dahulu');
                this.value = '';
                return;
            }
    
            if (cityId && courier) {
                fetch('/api/calculate-shipping', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        destination: cityId,
                        courier: courier
                    })
                })
                .then(response => response.json())
                .then(data => {
                    serviceSelect.innerHTML = '<option value="">Pilih Layanan</option>';
                    
                    if (data.shipping_costs && data.shipping_costs.length > 0) {
                        data.shipping_costs.forEach(service => {
                            const cost = service.cost[0].value;
                            serviceSelect.innerHTML += `
                                <option value="${service.service}" data-cost="${cost}">
                                    ${service.service} - ${service.description} - Rp ${new Intl.NumberFormat('id').format(cost)}
                                </option>
                            `;
                        });
                    }
                })
                .catch(error => {
                    console.error('Error calculating shipping:', error);
                });
            }
        });
    
        // Service change handler
        document.getElementById('service_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption) {
                const shippingCost = parseInt(selectedOption.dataset.cost) || 0;
                const subtotal = parseInt('<?php echo e($subtotal); ?>');
                const total = subtotal + shippingCost;
    
                document.getElementById('shippingCost').textContent = 'Rp ' + new Intl.NumberFormat('id').format(shippingCost);
                document.getElementById('totalAmount').textContent = 'Rp ' + new Intl.NumberFormat('id').format(total);
                
                // Update hidden inputs
                document.getElementById('shipping_cost_input').value = shippingCost;
                document.getElementById('shipping_courier_input').value = document.getElementById('courier_id').value;
                document.getElementById('shipping_service_input').value = this.value;
            }
        });
    
        // Form submit handler
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const cityId = document.getElementById('city_id').value;
            const courier = document.getElementById('courier_id').value;
            const service = document.getElementById('service_id').value;
    
            if (!cityId || !courier || !service) {
                e.preventDefault();
                alert('Silakan lengkapi data pengiriman');
            }
        });
    });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\samsul\baju-polos\resources\views/checkout/index.blade.php ENDPATH**/ ?>