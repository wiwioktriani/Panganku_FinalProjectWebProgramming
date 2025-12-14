@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">All Food Donations</h1>

    <a href="{{ route('donations.create') }}" 
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Add New Donation
    </a>

    @if ($donations->isEmpty())
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            No donations available.
        </div>
    @else
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2">Expired At</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $donation)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('donations.show', $donation) }}" 
                           class="text-blue-600 hover:underline">
                            {{ $donation->food_name }}
                        </a>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $donation->category?->name ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $donation->quantity }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ \Carbon\Carbon::parse($donation->expired_at)->format('d M Y') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="{{ $donation->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }} px-2 py-1 rounded">
                            {{ ucfirst($donation->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 space-x-2">
                        <a href="{{ route('donations.edit', $donation) }}" 
                           class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-2 rounded">
                            Edit
                        </a>

                        <form action="{{ route('donations.destroy', $donation) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this donation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection