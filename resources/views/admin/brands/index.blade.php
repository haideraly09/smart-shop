<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Brands</h2>
            <a href="{{ route('admin.brands.create') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">+ Naya Brand</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">#</th>
                            <th class="py-2">Naam</th>
                            <th class="py-2">Logo</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr class="border-b">
                                <td class="py-2">{{ $brand->id }}</td>
                                <td class="py-2">{{ $brand->name }}</td>
                                <td class="py-2">
                                    @if ($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" class="h-10 w-10 object-contain" alt="{{ $brand->name }}">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="py-2 flex gap-3">
                                    <a href="{{ route('admin.brands.edit', $brand) }}"
                                       class="text-blue-600">Edit</a>
                                    <form method="POST"
                                          action="{{ route('admin.brands.destroy', $brand) }}"
                                          onsubmit="return confirm('Pakka delete karna hai?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">
                                    Abhi koi brand nahi hai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $brands->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>