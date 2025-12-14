@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Food Donation</h1>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('donations.update', $donation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="food_name" class="block text-gray-700 font-bold mb-2">Food Name</label>
            <input type="text" name="food_name" id="food_name" value="{{ old('food_name', $donation->food_name) }}" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="food_category_id" class="block text-gray-700 font-bold mb-2">Category</label>
            <select name="food_category_id" id="food_category_id" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('food_category_id', $donation->food_category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-bold mb-2">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $donation->quantity) }}" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="1" required>
        </div>

        <div class="mb-4">
            <label for="expired_at" class="block text-gray-700 font-bold mb-2">Expiration Date</label>
            <input type="date" name="expired_at" id="expired_at" value="{{ old('expired_at', $donation->expired_at->format('Y-m-d')) }}" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" id="status" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="active" {{ old('status', $donation->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $donation->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" id="description" rows="3" 
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $donation->description) }}</textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Donation
            </button>
            <a href="{{ route('donations.index') }}" 
               class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
               Cancel
            </a>
        </div>
    </form>
</div>
@endsection