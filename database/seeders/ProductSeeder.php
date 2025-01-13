<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua data lama

        // Data produk baru
        $products = [
            // Produk untuk kategori T-Shirt (category_id = 1)
            
            // Produk untuk kategori Polo Shirt (category_id = 2)
            [
                'category_id' => 2,
                'name' => 'Classic Polo Shirt',
                'description' => 'Timeless polo shirt with a comfortable fit',
                'price' => 150000,
                'stock' => 80,
                'image' => 'products/classic-polo-shirt.jpg',
            ],
            [
                'category_id' => 2,
                'name' => 'Striped Polo Shirt',
                'description' => 'Stylish striped polo shirt for a casual look',
                'price' => 160000,
                'stock' => 70,
                'image' => 'products/striped-polo-shirt.jpg',
            ],
            // Produk untuk kategori Hoodie (category_id = 3)
            [
                'category_id' => 3,
                'name' => 'Pullover Hoodie',
                'description' => 'Warm pullover hoodie perfect for cold weather',
                'price' => 250000,
                'stock' => 60,
                'image' => 'products/pullover-hoodie.jpg',
            ],
            [
                'category_id' => 3,
                'name' => 'Zip-Up Hoodie',
                'description' => 'Comfortable zip-up hoodie with a modern design',
                'price' => 270000,
                'stock' => 50,
                'image' => 'products/zip-up-hoodie.jpg',
            ],
            // Produk untuk kategori Sweater (category_id = 4)
            [
                'category_id' => 4,
                'name' => 'Knitted Sweater',
                'description' => 'Classic knitted sweater for a cozy feel',
                'price' => 300000,
                'stock' => 40,
                'image' => 'products/knitted-sweater.jpg',
            ],
            [
                'category_id' => 4,
                'name' => 'Crewneck Sweater',
                'description' => 'Simple and stylish crewneck sweater',
                'price' => 280000,
                'stock' => 50,
                'image' => 'products/crewneck-sweater.jpg',
            ],
            // Produk tambahan
            [
                'category_id' => 1,
                'name' => 'Graphic T-Shirt',
                'description' => 'Trendy graphic t-shirt with unique designs',
                'price' => 120000,
                'stock' => 90,
                'image' => 'products/graphic-tshirt.jpg',
            ],
            [
                'category_id' => 3,
                'name' => 'Oversized Hoodie',
                'description' => 'Relaxed oversized hoodie for ultimate comfort',
                'price' => 290000,
                'stock' => 40,
                'image' => 'products/oversized-hoodie.jpg',
            ],
        ];

        // Masukkan data baru ke database
        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);
            Product::create($product);
        }
    }
}
