<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
            <a href="{{ route('admin.products.create') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">+ Naya Product</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

<form method="GET" action="{{ route('admin.products.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="search" value="{{ $search }}"
           placeholder="Naam ya SKU se dhoondein..."
           class="border border-gray-300 rounded w-full max-w-sm">
    <button class="px-4 py-2 bg-gray-800 text-white rounded">Search</button>

    @if ($search)
        <a href="{{ route('admin.products.index') }}"
           class="px-4 py-2 text-gray-600">Clear</a>
    @endif
</form>




            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Image</th>
                            <th class="py-2">Naam</th>
                            <th class="py-2">SKU</th>
                            <th class="py-2">Category</th>
                            <th class="py-2">Brand</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">Stock</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b {{ $product->quantity <= $product->low_stock_limit ? 'bg-red-50 text-red-700' : '' }}">
                                <td class="py-2">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             class="h-10 w-10 object-cover rounded" alt="{{ $product->name }}">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="py-2">{{ $product->name }}</td>
                                <td class="py-2">{{ $product->sku }}</td>
                                <td class="py-2">{{ $product->category->name ?? '-' }}</td>
                                <td class="py-2">{{ $product->brand->name ?? '-' }}</td>
                                <td class="py-2">{{ number_format($product->price, 2) }}</td>
                                <td class="py-2">{{ $product->quantity }}</td>
                                <td class="py-2">
                                    <div class="flex gap-3">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="text-blue-600">Edit</a>
                                        <form method="POST"
                                              action="{{ route('admin.products.destroy', $product) }}"
                                              onsubmit="return confirm('Pakka delete karna hai?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                             <tr>
                                <td colspan="8" class="py-4 text-center text-gray-500">
                                    @if ($search)
                                        "{{ $search }}" ke liye koi product nahi mila.
                                    @else
                                        Abhi koi product nahi hai.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>