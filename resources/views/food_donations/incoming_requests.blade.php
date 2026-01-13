@extends('layouts.app')

@section('content')
<div class="py-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Permintaan Masuk</h1>

    @forelse($requests as $request)
        <div class="bg-white p-4 rounded-lg shadow mb-4 border border-gray-200">
            <div class="flex justify-between items-start gap-4">
                <div>
                    <p><strong>Peminta:</strong> {{ $request->user->name }}</p>
                    <p><strong>Makanan:</strong> {{ $request->foodDonation->food_name }}</p>
                    <p><strong>Jumlah:</strong> {{ $request->quantity }}</p>
                    <p>
                        <strong>Status:</strong>
                        @if($request->status === 'pending')
                            <span class="text-yellow-600 font-semibold">Pending</span>
                        @elseif($request->status === 'approved')
                            <span class="text-green-600 font-semibold">Disetujui</span>
                        @elseif($request->status === 'rejected')
                            <span class="text-red-600 font-semibold">Ditolak</span>
                        @endif
                    </p>
                </div>

                {{-- ACTION BUTTONS --}}
                @if($request->status === 'pending')
                    <div class="flex gap-2 relative z-50 overflow-visible">
                        <!-- Approve -->
                        <form method="POST" action="{{ route('requests.approve', $request) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="px-4 py-2 text-white rounded shadow relative z-50"
                                style="background-color:#16a34a;"
                            >
                                Approve
                            </button>
                        </form>

                        <!-- Reject -->
                        <form method="POST" action="{{ route('requests.reject', $request) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="px-4 py-2 text-white rounded shadow relative z-50"
                                style="background-color:#dc2626;"
                            >
                                Reject
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-600">Tidak ada permintaan masuk</p>
    @endforelse
</div>
@endsection