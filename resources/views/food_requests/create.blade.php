@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Create Food Request</h1>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('requests.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">Choose Donation</label>
            <select name="food_donation_id"
                    required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">-- Select Donation --</option>
                @forelse($donations as $donation)
                    <option value="{{ $donation->id }}"
                        {{ old('food_donation_id') == $donation->id ? 'selected' : '' }}>
                        {{ $donation->food_name }} (Stock: {{ $donation->quantity }})
                    </option>
                @empty
                    <option disabled>No available donations</option>
                @endforelse
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Quantity</label>
            <input type="number"
                   name="quantity"
                   min="1"
                   value="{{ old('quantity') }}"
                   required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex space-x-3">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit Request
            </button>
            <a href="{{ route('requests.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Back
            </a>
        </div>
    </form>
</div>
@endsection