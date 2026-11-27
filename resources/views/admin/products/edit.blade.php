<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product Edit</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                               class="mt-1 border border-gray-300 rounded w-full">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                               class="mt-1 border border-gray-300 rounded w-full">
                        @error('sku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                   class="mt-1 border border-gray-300 rounded w-full">
                            @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cost Price</label>
                            <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}"
                                   class="mt-1 border border-gray-300 rounded w-full">
                            @error('cost_price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                   class="mt-1 border border-gray-300 rounded w-full">
                            @error('quantity') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Low Stock Limit</label>
                            <input type="number" name="low_stock_limit" value="{{ old('low_stock_limit', $product->low_stock_limit) }}"
                                   class="mt-1 border border-gray-300 rounded w-full">
                            @error('low_stock_limit') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" class="mt-1 border border-gray-300 rounded w-full">
                            <option value="">-- Chunein --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id', $product->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Brand</label>
                        <select name="brand_id" class="mt-1 border border-gray-300 rounded w-full">
                            <option value="">-- Chunein --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    @selected(old('brand_id', $product->brand_id) == $brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" class="mt-1 border border-gray-300 rounded w-full">
                            <option value="">-- Chunein --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    @selected(old('supplier_id', $product->supplier_id) == $supplier->id)>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Image</label>

                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="h-16 w-16 object-cover rounded my-2" alt="{{ $product->name }}">
                            <p class="text-xs text-gray-500 mb-1">Naya image chunein to purana badal jayega.</p>
                        @endif

                        <input type="file" name="image" accept="image/*" class="mt-1">
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 border border-gray-300 rounded w-full">{{ old('description', $product->description) }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 bg-gray-800 text-white rounded">Update</button>
                        <a href="{{ route('admin.products.index') }}" class="text-gray-600">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>