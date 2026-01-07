@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6">{{ __('Buat Permintaan Makanan') }}</h2>

                <form method="POST" action="{{ route('requests.store') }}" class="space-y-6">
                    @csrf

                    <!-- Pilih Donasi -->
                    <div>
                        <x-input-label for="food_donation_id" :value="__('Pilih Donasi')" />
                        <select id="food_donation_id" name="food_donation_id"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">{{ __('Pilih donasi yang tersedia') }}</option>
                            @forelse($donations as $donation)
                                <option value="{{ $donation->id }}" {{ old('food_donation_id') == $donation->id ? 'selected' : '' }}>
                                    {{ $donation->food_name }} (Stok: {{ $donation->quantity }})
                                </option>
                            @empty
                                <option disabled>{{ __('Tidak ada donasi tersedia') }}</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('food_donation_id')" class="mt-2" />
                    </div>

                    <!-- Jumlah -->
                    <div>
                        <x-input-label for="quantity" :value="__('Jumlah yang Diminta')" />
                        <x-text-input id="quantity" name="quantity" type="number" min="1" class="mt-1 block w-full"
                                      :value="old('quantity')" required />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Kirim Permintaan') }}</x-primary-button>
                        <a href="{{ route('requests.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Batal') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
