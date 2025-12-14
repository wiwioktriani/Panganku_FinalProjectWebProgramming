@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Food Donation Details</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $donation->food_name }}</h5>
            <p class="card-text"><strong>Category:</strong> {{ $donation->category->name ?? '-' }}</p>
            <p class="card-text"><strong>Quantity:</strong> {{ $donation->quantity }}</p>
            <p class="card-text"><strong>Expiration Date:</strong> {{ $donation->expired_at->format('d M Y') }}</p>
            <p class="card-text"><strong>Status:</strong> 
                @if($donation->status === 'active')
                    <span class="text-green-600 font-semibold">Active</span>
                @else
                    <span class="text-red-600 font-semibold">Inactive</span>
                @endif
            </p>
            <p class="card-text"><strong>Description:</strong> {{ $donation->description ?? '-' }}</p>
            <p class="card-text"><strong>Created By:</strong> {{ $donation->user->name ?? '-' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $donation->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="flex space-x-2">
        <a href="{{ route('donations.index') }}" 
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Back to List
        </a>

        @if($donation->user_id === auth()->id())
            <a href="{{ route('donations.edit', $donation->id) }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
               Edit
            </a>

            <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
