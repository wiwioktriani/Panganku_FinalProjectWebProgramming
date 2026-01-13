@extends('layouts.app')

@section('content')
<div class="bg-white shadow-sm rounded-lg p-6 sm:p-8 w-full">
    <h2 class="text-2xl font-bold mb-6">{{ __('Tambah Donasi Baru') }}</h2>

    <form method="POST"
          action="{{ route('donations.store') }}"
          class="space-y-6 max-w-3xl">
        @csrf

        {{-- Nama Makanan --}}
        <div>
            <x-input-label for="food_name" :value="__('Nama Makanan')" />
            <x-text-input
                id="food_name"
                name="food_name"
                type="text"
                class="mt-1 block w-full"
                :value="old('food_name')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('food_name')" class="mt-2" />
        </div>

        {{-- Kategori --}}
        <div>
            <x-input-label for="food_category_id" :value="__('Kategori')" />
            <select
                id="food_category_id"
                name="food_category_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                       focus:border-green-500 focus:ring-green-500"
                required
            >
                <option value="">{{ __('Pilih Kategori') }}</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('food_category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('food_category_id')" class="mt-2" />
        </div>

        {{-- Quantity & Expired (Responsive Grid) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="quantity" :value="__('Jumlah')" />
                <x-text-input
                    id="quantity"
                    name="quantity"
                    type="number"
                    min="1"
                    class="mt-1 block w-full"
                    :value="old('quantity')"
                    required
                />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="expired_at" :value="__('Tanggal Kadaluarsa')" />
                <x-text-input
                    id="expired_at"
                    name="expired_at"
                    type="date"
                    class="mt-1 block w-full"
                    :value="old('expired_at')"
                    required
                />
                <x-input-error :messages="$errors->get('expired_at')" class="mt-2" />
            </div>
        </div>

        {{-- Deskripsi --}}
        <div>
            <x-input-label for="description" :value="__('Deskripsi')" />
            <textarea
                id="description"
                name="description"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                       focus:border-green-500 focus:ring-green-500"
            >{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Simpan') }}
            </x-primary-button>

            <a href="{{ route('donations.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
                {{ __('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection
