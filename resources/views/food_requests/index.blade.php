@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">All Food Requests</h1>

    <a href="{{ route('requests.create') }}"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Create New Request
    </a>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">Donation</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Created At</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr class="text-center border-t">
                        <td class="px-4 py-2">{{ $request->user->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $request->foodDonation->food_name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $request->quantity }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded {{ $request->status === 'pending' ? 'bg-yellow-300 text-yellow-800' : 'bg-green-300 text-green-800' }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $request->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            @if($request->status === 'pending')
                                <a href="{{ route('requests.edit', $request->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white px-2 py-1 rounded text-sm mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('requests.destroy', $request->id) }}" method="POST" class="inline" onsubmit="return confirm('Cancel this request?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">
                                        Cancel
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                            No food requests yet
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection