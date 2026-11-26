<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <label>Naam</label>
    <input type="text" name="name" value="{{ old('name') }}" class="border rounded w-full">
    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

    <label>Description</label>
    <textarea name="description" class="border rounded w-full">{{ old('description') }}</textarea>
    @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

    <button class="mt-4 px-4 py-2 bg-gray-800 text-white rounded">Save</button>
</form>