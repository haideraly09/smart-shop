<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Brand Edit</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" name="name" value="{{ old('name', $brand->name) }}"
                               class="mt-1 border border-gray-300 rounded w-full">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Logo</label>

                        @if ($brand->logo)
                            <img src="{{ asset('storage/' . $brand->logo) }}"
                                 class="h-16 w-16 object-contain my-2" alt="{{ $brand->name }}">
                            <p class="text-xs text-gray-500 mb-1">Naya logo chunein to purana badal jayega.</p>
                        @endif

                        <input type="file" name="logo" accept="image/*" class="mt-1">
                        @error('logo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 bg-gray-800 text-white rounded">Update</button>
                        <a href="{{ route('admin.brands.index') }}" class="text-gray-600">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>