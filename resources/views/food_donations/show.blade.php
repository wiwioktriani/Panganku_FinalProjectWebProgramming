@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 space-y-4">

                <h2 class="text-2xl font-bold mb-4">
                    Detail Donasi Makanan
                </h2>

                <div>
                    <span class="font-semibold">Nama Makanan:</span>
                    <p>{{ $donation->food_name }}</p>
                </div>

                <div>
                    <span class="font-semibold">Kategori:</span>
                    <p>{{ $donation->category?->name ?? 'Tidak ada kategori' }}</p>
                </div>

                <div>
                    <span class="font-semibold">Jumlah:</span>
                    <p>{{ $donation->quantity }}</p>
                </div>

                <div>
                    <span class="font-semibold">Tanggal Kadaluarsa:</span>
                    <p>{{ $donation->expired_at->format('d M Y') }}</p>
                </div>

                <div>
                    <span class="font-semibold">Status:</span>
                    <span class="{{ $donation->status === 'available' ? 'text-green-600' : 'text-red-600' }} font-medium">
                        {{ ucfirst($donation->status) }}
                    </span>
                </div>

                <div>
                    <span class="font-semibold">Deskripsi:</span>
                    <p>{{ $donation->description ?? '-' }}</p>
                </div>

                <div class="pt-6 flex gap-4">
                    <a href="{{ route('donations.edit', $donation) }}"
                       class="text-indigo-600 hover:text-indigo-800 font-medium">
                        Edit
                    </a>

                    <a href="{{ route('donations.index') }}"
                       class="text-gray-600 hover:text-gray-800">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection