<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Suppliers</h2>
            <a href="{{ route('admin.suppliers.create') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">+ Naya Supplier</a>
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
                            <th class="py-2">Phone</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr class="border-b">
                                <td class="py-2">{{ $supplier->id }}</td>
                                <td class="py-2">{{ $supplier->name }}</td>
                                <td class="py-2">{{ $supplier->phone ?? '-' }}</td>
                                <td class="py-2">{{ $supplier->email ?? '-' }}</td>
                                <td class="py-2 flex gap-3">
                                    <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                                       class="text-blue-600">Edit</a>
                                    <form method="POST"
                                          action="{{ route('admin.suppliers.destroy', $supplier) }}"
                                          onsubmit="return confirm('Pakka delete karna hai?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">
                                    Abhi koi supplier nahi hai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $suppliers->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>