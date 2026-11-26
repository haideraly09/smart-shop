<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Naya Supplier</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.suppliers.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 border border-gray-300 rounded w-full">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="mt-1 border border-gray-300 rounded w-full">
                        @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="mt-1 border border-gray-300 rounded w-full">
                        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address" rows="3"
                                  class="mt-1 border border-gray-300 rounded w-full">{{ old('address') }}</textarea>
                        @error('address') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 bg-gray-800 text-white rounded">Save</button>
                        <a href="{{ route('admin.suppliers.index') }}" class="text-gray-600">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>