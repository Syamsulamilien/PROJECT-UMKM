@extends('layouts.admin')

@section('header', 'Add New Product')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]"></textarea>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" min="0" step="1000" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock" min="0" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#44318D] focus:ring-[#44318D]">
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*" required
                           class="mt-1 block w-full">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-[#44318D] text-white px-4 py-2 rounded-lg hover:bg-[#2A1B3D]">
                        Create Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection